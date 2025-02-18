<?php

namespace App\Services;

use App\Models\ShortLink;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ShortLinkService
{
    public const SHORT_URL_LENGTH = 9;
    public const RANDOM_BYTES = 32;

    public function getFullUrl(string $shortUrl): string {
        return $this->getShortLink($shortUrl)->url;
    }

    protected function getShortLink(string $shortUrl): ShortLink {
        $shortLinkModel = ShortLink::where('short_id', $shortUrl)->first();
        if(empty($shortLinkModel)){
            throw new ModelNotFoundException('Короткая ссылка не найдена');
        }
        return $shortLinkModel;
    }

    public function countUrlCount(string $shortUrl): void {
        $shortLink = $this->getShortLink($shortUrl);
        $shortLink->call_count = $shortLink->call_count + 1;
        $shortLink->save();
    }

    public function getShortUrlId(string $fullUrl): string {
        $shortLinkModel = ShortLink::where('url', $fullUrl)->first();
        if(empty($shortLinkModel)){
            $shortLinkModel = new ShortLink();
            $shortLinkModel->url = $fullUrl;
            $shortLinkModel->short_id = $this->generateLink($fullUrl);
            $shortLinkModel->save();
        }
        return $shortLinkModel->short_id;
    }



    /**
     * @throws \Exception
     */
    public function generateLink(string $urlInput): string {
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

    public function updateShortLink(ShortLink $shortLink, string $newUrl, string $newShortId): void
    {
        $shortLink->url = $newUrl;
        $shortLink->short_id = $newShortId;
        $shortLink->save();
    }
}
