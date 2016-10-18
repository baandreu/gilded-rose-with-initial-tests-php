<?php

namespace GildedRose;

use GildedRose\Items\AgedBrie;
use GildedRose\Items\BackstagePass;
use GildedRose\Items\MutableItem;
use GildedRose\Items\PerishableItem;

final class ItemFactory
{
    /**
     * @param Item $legacyItem
     * @return MutableItem|null
     */
    public static function create(Item $legacyItem)
    {
        switch ($legacyItem->name) {
            case self::isImmutable($legacyItem):
                return null;
            case 'Aged Brie':
                return new AgedBrie($legacyItem);
            case 'Backstage passes to a TAFKAL80ETC concert':
                return new BackstagePass($legacyItem);
            default:
                return new PerishableItem($legacyItem);
        }
    }

    /**
     * @param Item $legacyItem
     * @return string
     */
    private static function isImmutable(Item $legacyItem)
    {
        return $legacyItem->name === 'Sulfuras, Hand of Ragnaros';
    }
}
