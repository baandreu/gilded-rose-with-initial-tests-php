<?php

namespace GildedRose\Items;

final class AgedBrie extends MutableItem
{
    public function updateQuantity()
    {
        $this->increaseQuality();

        $this->legacyItem->sell_in = $this->legacyItem->sell_in - 1;

        if ($this->hasExpired()) {
            $this->increaseQuality();
        }
    }

    /**
     * @return bool
     */
    private function hasExpired()
    {
        return $this->legacyItem->sell_in < 0;
    }
}
