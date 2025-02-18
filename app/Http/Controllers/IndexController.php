<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortLinkRequest;
use App\Services\ShortLinkService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;

class IndexController extends Controller
{

    public function index(): View {
        return view('index.create_shortlink', [
            'shortUrlId' => '',
            'urlInput' => ''
        ]);
    }

    public function create(ShortLinkRequest $shortLinkRequest, ShortLinkService $linkService): View {
        $urlInput = $shortLinkRequest->get('url');
        $shortUrlId = $linkService->getShortUrlId($urlInput);

        return view('index.create_shortlink', [
            'shortUrlId' => $shortUrlId,
            'urlInput' => $urlInput
        ]);
    }

    public function followShortLink(string $shortId, ShortLinkService $linkService): RedirectResponse
    {
        try {
            $fullUrl = $linkService->getFullUrl($shortId);
            $linkService->countUrlCount($shortId);

            return redirect($fullUrl);
        }
        catch (\Exception $exception){
            return redirect('/');
        }
    }
}
