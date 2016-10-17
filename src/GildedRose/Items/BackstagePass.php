<?php

namespace GildedRose\Items;

final class BackstagePass extends MutableItem
{
    public function updateQuantity()
    {
        $this->increaseQuality();

        $isWithin10days = $this->legacyItem->sell_in < 11;
        $isWithin5days = $this->legacyItem->sell_in < 6;

        if ($isWithin10days) {
            $this->increaseQuality();
        }

        if ($isWithin5days) {
            $this->increaseQuality();
        }

        $this->tickDay();

        if ($this->hasExpired()) {
            $this->legacyItem->quality = $this->legacyItem->quality - $this->legacyItem->quality;
        }
    }
}
