<?php

namespace App\Http\Transformers\API;

abstract class Transformer
{
    /**
     * Transform a collection of items.
     *
     * @param $items
     *
     * @return array
     */
    public function transformCollection($items)
    {
        if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $items->item = collect($items->items())->map([$this, 'transform']);
        } else {
            $items = collect($items)->map([$this, 'transform']);
        }

        return $items;
    }

    abstract public function transform($item, $key);
}
