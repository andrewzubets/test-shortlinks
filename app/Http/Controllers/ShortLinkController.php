<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateShortLinkRequest;
use App\Models\ShortLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

/**
 * Short link controller for user use.
 */
class ShortLinkController extends Controller
{
    /**
     * Display list of short links.
     */
    public function index(): View
    {
        $shortLinks = ShortLink::cursorPaginate(10);

        return view('shortlink.index', [
            'shortLinks' => $shortLinks
        ]);
    }

    /**
     * Show the form for editing the specified short link.
     */
    public function edit(ShortLink $shortLink): View
    {
        return view('shortlink.edit', ['shortLink' => $shortLink]);
    }

    /**
     * Update the specified shortlink in storage.
     */
    public function update(UpdateShortLinkRequest $request, ShortLink $shortLink): RedirectResponse
    {
        $shortLink->url = $request->get('url');
        $shortLink->short_id = $request->get('short_id');
        $shortLink->save();

        return redirect(route('shortlink.index').'?messageId=record-updated');
    }

    /**
     * Remove the specified shortlink from storage.
     */
    public function destroy(ShortLink $shortLink): RedirectResponse
    {
        $shortLink->delete();

        return redirect(route('shortlink.index').'?messageId=record-destroyed');
    }
}
