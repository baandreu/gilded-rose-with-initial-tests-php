<?php

namespace GildedRose\Items;

final class BackstagePass extends MutableItem
{
    public function updateQuantity()
    {
        $this->increaseQuality();

        if ($this->legacyItem->name == 'Backstage passes to a TAFKAL80ETC concert') {
            if ($this->legacyItem->sell_in < 11) {
                $this->increaseQuality();
            }
            if ($this->legacyItem->sell_in < 6) {
                $this->increaseQuality();
            }
        }

        $this->tickDay();

        if ($this->hasExpired()) {
            $this->legacyItem->quality = $this->legacyItem->quality - $this->legacyItem->quality;
        }
    }
}
