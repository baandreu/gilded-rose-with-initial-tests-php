<?php

namespace GildedRose\Items;

final class PerishableItem extends MutableItem
{
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
