<?php

namespace App\Http\Resources;

use App\Models\ShortLink;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortLinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (is_null($this->resource) || is_array($this->resource)) {
            return parent::toArray($request);
        }

        if($this->resource instanceof CursorPaginator){
            return [
                'data' => $this->formatItems($this->resource->items()),
                'per_page' => $this->resource->perPage(),
                'next_page_url'=>$this->resource->nextPageUrl(),
                'prev_page_url'=>$this->resource->previousPageUrl(),
            ];
        }

        if($this->resource instanceof ShortLink) {
            static::withoutWrapping();
            return $this->formatItem($this->resource);
        }

        return parent::toArray($request);
    }

    private function formatItems(array $items): array
    {
        $formattedItems = [];
        foreach ($items as $item){
            $formattedItems[] = $this->formatItem($item);
        }
        return $formattedItems;
    }

    private function formatItem(array|ShortLink $item): array
    {
        if(is_array($item)){
            return $item;
        }
        return [
            'id' => $item->id,
            'short_id' => $item->short_id,
            'url' => $item->url,
            'short_url' => $item->short_url,
        ];

    }
}
