<?php

namespace GildedRose\Items;

final class BackstagePass extends MutableItem
{
    public function updateQuantity()
    {
        $isCloseToDate = $this->legacyItem->sell_in < 11;
        $isVeryCloseToDate = $this->legacyItem->sell_in < 6;

        if ($isVeryCloseToDate) {
            $this->increaseQualityBy(3);
        } elseif ($isCloseToDate) {
            $this->increaseQualityBy(2);
        } else {
            $this->increaseQualityBy(1);
        }

        $this->tickDay();

        if ($this->hasExpired()) {
            $this->legacyItem->quality = $this->legacyItem->quality - $this->legacyItem->quality;
        }
    }
}
