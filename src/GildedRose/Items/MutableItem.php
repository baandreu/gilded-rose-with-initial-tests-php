<?php

namespace GildedRose\Items;

use GildedRose\Item;

abstract class MutableItem implements NewItem
{
    /** @var Item */
    protected $legacyItem;

    /**
     * @param Item $legacyItem
     */
    public function __construct(Item $legacyItem)
    {
        $this->legacyItem = $legacyItem;
    }

    protected function increaseQuality()
    {
        if ($this->legacyItem->quality < 50) {
            $this->legacyItem->quality = $this->legacyItem->quality + 1;
        }
    }
}
