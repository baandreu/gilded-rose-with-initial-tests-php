<?php

namespace GildedRose\Items;

use GildedRose\Item;

final class PerishableItem implements NewItem
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
        $this->decreaseQuality();

        $this->legacyItem->sell_in = $this->legacyItem->sell_in - 1;

        if ($this->legacyItem->sell_in < 0) {
            $this->decreaseQuality();
        }
    }

    private function decreaseQuality()
    {
        if ($this->legacyItem->quality > 0) {
            $this->legacyItem->quality = $this->legacyItem->quality - 1;
        }
    }
}
