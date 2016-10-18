<?php

namespace GildedRose;

use GildedRose\Items\MutableItem;

class GildedRose {

    private $items;

    function __construct($items) {
        $this->items = $items;
    }

    function update_quality(){
        foreach ($this->mutableItems() as $item) {
            $item->updateQuantity();
        }
    }

    /**
     * @return MutableItem[]
     */
    private function mutableItems()
    {
        return array_filter(
            array_map(function (Item $legacyItem) { return ItemFactory::createMutable($legacyItem); }, $this->items)
        );
    }
}
