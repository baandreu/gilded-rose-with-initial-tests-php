<?php

namespace GildedRose\Items;

use GildedRose\Item;

final class BackstagePass implements NewItem
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
        if ($this->legacyItem->quality < 50) {
            $this->legacyItem->quality = $this->legacyItem->quality + 1;
            if ($this->legacyItem->name == 'Backstage passes to a TAFKAL80ETC concert') {
                if ($this->legacyItem->sell_in < 11) {
                    if ($this->legacyItem->quality < 50) {
                        $this->legacyItem->quality = $this->legacyItem->quality + 1;
                    }
                }
                if ($this->legacyItem->sell_in < 6) {
                    if ($this->legacyItem->quality < 50) {
                        $this->legacyItem->quality = $this->legacyItem->quality + 1;
                    }
                }
            }
        }

        $this->legacyItem->sell_in = $this->legacyItem->sell_in - 1;

        if ($this->legacyItem->sell_in < 0) {
            $this->legacyItem->quality = $this->legacyItem->quality - $this->legacyItem->quality;
        }
    }
}
