<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Short link model.
 *
 * @method static cursorPaginate(int $int)
 * @method static where(string $column, string $value)
 *
 * @property int $call_count
 *   Short link follow count.
 * @property string $url
 *   Full url.
 * @property string $short_id
 *   Short url id.
 */
class ShortLink extends Model
{

}
