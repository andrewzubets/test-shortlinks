<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateShortLinkRequest;
use App\Models\ShortLink;
use App\Services\ShortLinkService;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shortLinks = ShortLink::cursorPaginate(10);
        return view('shortlink.index', [
            'shortLinks' => $shortLinks,
            'message' => $this->getStatusMessage($request->get('messageId')),
        ]);
    }

    protected function getStatusMessage(?string $messageId): ?array {
        return match ($messageId) {
            'record-updated' => [
                'type' => 'success',
                'message' => 'Ссылка обновлена',
            ],
            'record-destroyed' => [
                'type' => 'warning',
                'message' => 'Ссылка удалена',
            ],
            default => null
        };
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShortLink $shortLink)
    {
        return view('shortlink.edit', ['shortLink' => $shortLink]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShortLinkRequest $request, ShortLinkService $linkService, ShortLink $shortLink)
    {
        $newUrl = $request->get('url');
        $newShortId = $request->get('short_id');
        $linkService->updateShortLink($shortLink, $newUrl, $newShortId);
        return redirect(route('shortlink.index').'?messageId=record-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShortLink $shortLink)
    {
        $shortLink->delete();

        return redirect(route('shortlink.index').'?messageId=record-destroyed');
    }
}
