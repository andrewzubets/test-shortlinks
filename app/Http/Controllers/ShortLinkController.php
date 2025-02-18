<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortLinkRequest;
use App\Services\ShortLinkService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;

class ShortLinkController extends Controller
{

    public function index(): View {
        return view('shortlink.index', ['urlInput' => '']);
    }

    public function create(ShortLinkRequest $shortLinkRequest, ShortLinkService $linkService): View {
        $urlInput = $shortLinkRequest->get('url_input');
        $urlShortLink = $linkService->getShortUrl($urlInput);

        return view('shortlink.index', [
            'urlShortLink' => url('/s/' . $urlShortLink),
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
