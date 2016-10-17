<?php

namespace GildedRose\Items;

use GildedRose\Item;

final class LegacyItem implements NewItem
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
        if ($this->legacyItem->name != 'Aged Brie' and $this->legacyItem->name != 'Backstage passes to a TAFKAL80ETC concert') {
            if ($this->legacyItem->quality > 0) {
                if ($this->legacyItem->name != 'Sulfuras, Hand of Ragnaros') {
                    $this->legacyItem->quality = $this->legacyItem->quality - 1;
                }
            }
        } else {
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
        }

        if ($this->legacyItem->name != 'Sulfuras, Hand of Ragnaros') {
            $this->legacyItem->sell_in = $this->legacyItem->sell_in - 1;
        }

        if ($this->legacyItem->sell_in < 0) {
            if ($this->legacyItem->name != 'Aged Brie') {
                if ($this->legacyItem->name != 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($this->legacyItem->quality > 0) {
                        if ($this->legacyItem->name != 'Sulfuras, Hand of Ragnaros') {
                            $this->legacyItem->quality = $this->legacyItem->quality - 1;
                        }
                    }
                } else {
                    $this->legacyItem->quality = $this->legacyItem->quality - $this->legacyItem->quality;
                }
            } else {
                if ($this->legacyItem->quality < 50) {
                    $this->legacyItem->quality = $this->legacyItem->quality + 1;
                }
            }
        }
    }
}
