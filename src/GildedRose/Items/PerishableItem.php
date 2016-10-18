<?php

namespace GildedRose\Items;

final class PerishableItem extends MutableItem
{
    public function updateQuantity()
    {
        $this->decreaseQuality();

        $this->tickDay();

        if ($this->hasExpired()) {
            $this->decreaseQuality();
        }
    }
}
