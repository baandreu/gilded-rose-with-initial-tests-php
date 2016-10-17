<?php

namespace GildedRose;

use GildedRose\Items\AgedBrie;
use GildedRose\Items\BackstagePass;
use GildedRose\Items\LegacyItem;
use GildedRose\Items\NewItem;

final class ItemFactory
{
    /**
     * @param Item $legacyItem
     * @return NewItem
     */
    public static function create(Item $legacyItem)
    {
        switch ($legacyItem->name) {
            case 'Aged Brie':
                return new AgedBrie($legacyItem);
            case 'Backstage passes to a TAFKAL80ETC concert':
                return new BackstagePass($legacyItem);
            default:
                return new LegacyItem($legacyItem);
        }
    }
}
