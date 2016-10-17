<?php

namespace GildedRose\Items;

use GildedRose\Item;

final class Sulfuras implements NewItem
{
    /** @var Item */
    private $legacyItem;

    /**
     * @param Item $legacyItem
     */
    public function __construct(Item $legacyItem)
    {
        $this->legacyItem = $legacyItem;
    }

    public function updateQuantity()
    {
    }
}
