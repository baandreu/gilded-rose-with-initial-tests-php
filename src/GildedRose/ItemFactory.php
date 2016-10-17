<?php

namespace GildedRose;

use GildedRose\Items\AgedBrie;
use GildedRose\Items\BackstagePass;
use GildedRose\Items\PerishableItem;
use GildedRose\Items\NewItem;
use GildedRose\Items\Sulfuras;

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
            case 'Sulfuras, Hand of Ragnaros':
                return new Sulfuras($legacyItem);
            default:
                return new PerishableItem($legacyItem);
        }
    }
}
