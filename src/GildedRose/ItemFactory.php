<?php

namespace GildedRose;

use GildedRose\Items\LegacyItem;

final class ItemFactory
{
    /**
     * @param Item $legacyItem
     * @return LegacyItem
     */
    public static function create(Item $legacyItem)
    {
        return new LegacyItem($legacyItem);
    }
}
