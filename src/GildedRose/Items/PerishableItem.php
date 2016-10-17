<?php

namespace GildedRose\Items;

final class PerishableItem extends MutableItem
{
    public function updateQuantity()
    {
        $this->decreaseQuality();

        $this->tickDay();

        if ($this->legacyItem->sell_in < 0) {
            $this->decreaseQuality();
        }
    }
}
