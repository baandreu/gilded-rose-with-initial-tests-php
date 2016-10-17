<?php

namespace GildedRose;

use GildedRose\Items\NewItem;
use GildedRose\Items\LegacyItem;

class GildedRose {

    private $items;

    function __construct($items) {
        $this->items = $items;
    }

    function update_quality() {
        foreach ($this->newItems() as $item) {
            $item->updateQuantity();
        }
    }

    /**
     * @return NewItem[]
     */
    private function newItems()
    {
        return array_map(function (Item $legacyItem) {
            return new LegacyItem($legacyItem);
        }, $this->items);
    }
}
