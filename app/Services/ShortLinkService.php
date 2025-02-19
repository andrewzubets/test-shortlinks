<?php

namespace App\Services;

use App\Models\ShortLink;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Service used to handle short links.
 */
class ShortLinkService
{
    public const SHORT_URL_LENGTH = 9;
    public const RANDOM_BYTES = 32;

    /**
     * Gets full url for short id.
     *
     * @throws ModelNotFoundException
     *   In case if no full url for short id.
     */
    public function getFullUrl(string $shortId): string {
        return $this->getShortLink($shortId)->url;
    }

    /**
     * Gets short link model class for shortId.
     *
     * @param string $shortId
     *   Short id.
     * @return ShortLink
     *   Short link model.
     *
     * @throws ModelNotFoundException
     *   In case if no model for short id.
     */
    protected function getShortLink(string $shortId): ShortLink {
        $shortLinkModel = ShortLink::where('short_id', $shortId)->first();
        if(empty($shortLinkModel)){
            throw new ModelNotFoundException('Короткая ссылка не найдена');
        }

        return $shortLinkModel;
    }

    /**
     * Increases url follow counter for short id.
     *
     * @param string $shortId
     *   Short link id.
     *
     * @return void
     */
    public function increaseUrlFollowCounter(string $shortId): void {
        $shortLink = $this->getShortLink($shortId);
        $shortLink->call_count = $shortLink->call_count + 1;
        $shortLink->save();
    }

    /**
     * Gets short url id or creates it.
     *
     * @param string $fullUrl
     *   Full url to get short url id from.
     *
     * @throws Exception
     */
    public function getShortUrlId(string $fullUrl): string {
        $shortLinkModel = ShortLink::where('url', $fullUrl)->first();
        if(empty($shortLinkModel)){
            $shortLinkModel = new ShortLink();
            $shortLinkModel->url = $fullUrl;
            $shortLinkModel->short_id = $this->generateShortLinkId();
            $shortLinkModel->save();
        }

        return $shortLinkModel->short_id;
    }

    /**
     * Generates short link id.
     *
     * @throws Exception
     */
    public function generateShortLinkId(): string {
        return substr(
            base64_encode(
                sha1(
                    uniqid(
                        random_bytes(self::RANDOM_BYTES),
                        true
                    )
                )
            ),
            0,
            self::SHORT_URL_LENGTH
        );
    }
}
