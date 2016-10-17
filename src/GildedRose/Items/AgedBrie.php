<?php

namespace GildedRose\Items;

final class AgedBrie extends MutableItem
{
    public function updateQuantity()
    {
        $this->increaseQuality();

        $this->tickDay();

        if ($this->hasExpired()) {
            $this->increaseQuality();
        }
    }
}
