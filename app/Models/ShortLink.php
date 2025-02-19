<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\CursorPaginator;

/**
 * Short link model.
 *
 * @method static CursorPaginator cursorPaginate(int $int)
 * @method static where(string $column, string $value)
 *
 * @property int|null $id
 *   Id.
 * @property int $call_count
 *   Short link follow count.
 * @property string $url
 *   Full url.
 * @property string $short_id
 *   Short url id.
 * @property string $short_url
 *   Short url.
 */
class ShortLink extends Model
{
    protected $appends = ['short_url'];

    /**
     * Gets short url.
     */
    public function getShortUrlAttribute(): string {
        return route('index.follow_shortlink', [
            'shortId' => $this->short_id
        ]);
    }
}
