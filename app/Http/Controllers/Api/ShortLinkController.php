<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateShortLinkRequest;
use App\Http\Requests\UpdateShortLinkRequest;
use App\Http\Resources\ShortLinkResource;
use App\Models\ShortLink;
use App\Services\ShortLinkService;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ShortLinkController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): ShortLinkResource
    {
        return new ShortLinkResource(ShortLink::cursorPaginate(100));
    }

    /**
     * Store a newly created short link in storage.
     *
     * @throws Exception
     */
    public function store(CreateShortLinkRequest $shortLinkRequest, ShortLinkService $linkService): ShortLinkResource
    {
        $urlInput = $shortLinkRequest->get('url');

        return new ShortLinkResource($linkService->getOrCreateShortLink($urlInput));
    }

    /**
     * Display the short link.
     */
    public function show(ShortLink $shortLink): ShortLinkResource
    {
        return new ShortLinkResource($shortLink);
    }

    /**
     * Update the short link in storage.
     */
    public function update(UpdateShortLinkRequest $request, ShortLink $shortLink): ShortLinkResource
    {
        $shortLink->short_id = $request->get('short_id');
        $shortLink->url = $request->get('url');
        $shortLink->save();

        return new ShortLinkResource($shortLink);
    }

    /**
     * Remove the short link from storage.
     */
    public function destroy(ShortLink $shortLink): Response
    {
        $shortLink->delete();
        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
