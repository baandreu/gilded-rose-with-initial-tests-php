<?php

namespace GildedRose\Items;

use GildedRose\Item;

abstract class MutableItem implements NewItem
{
    const MIN_QUALITY = 0;
    const MAX_QUALITY = 50;

    /** @var Item */
    protected $legacyItem;

    /**
     * @param Item $legacyItem
     */
    public function __construct(Item $legacyItem)
    {
        $this->legacyItem = $legacyItem;
    }

    protected function increaseQuality()
    {
        if ($this->legacyItem->quality < self::MAX_QUALITY) {
            $this->legacyItem->quality = $this->legacyItem->quality + 1;
        }
    }

    protected function decreaseQuality()
    {
        if ($this->legacyItem->quality > self::MIN_QUALITY) {
            $this->legacyItem->quality = $this->legacyItem->quality - 1;
        }
    }

    /**
     * @return bool
     */
    protected function hasExpired()
    {
        return $this->legacyItem->sell_in < 0;
    }

    protected function tickDay()
    {
        $this->legacyItem->sell_in = $this->legacyItem->sell_in - 1;
    }
}
