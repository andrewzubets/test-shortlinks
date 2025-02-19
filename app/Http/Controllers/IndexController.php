<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShortLinkRequest;
use App\Services\ShortLinkService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Controller for home page with creating and viewing of short links.
 */
class IndexController extends Controller
{

    /**
     * Gets home page.
     */
    public function index(): View {
        return view('index.create_shortlink', [
            'shortUrlId' => '',
            'urlInput' => ''
        ]);
    }

    /**
     * Creates short link.
     *
     * @throws Exception
     */
    public function create(CreateShortLinkRequest $shortLinkRequest, ShortLinkService $linkService): View {
        $urlInput = $shortLinkRequest->get('url');
        $shortUrlId = $linkService->getOrCreateShortUrlId($urlInput);

        return view('index.create_shortlink', [
            'shortUrlId' => $shortUrlId,
            'urlInput' => $urlInput
        ]);
    }

    /**
     * Searches for short link and redirects to full url.
     */
    public function followShortLink(string $shortId, ShortLinkService $linkService): RedirectResponse
    {
        try {
            $fullUrl = $linkService->getFullUrl($shortId);
            $linkService->increaseUrlFollowCounter($shortId);

            return redirect($fullUrl);
        }
        catch (Exception){
            return redirect('/');
        }
    }
}
