<?php

namespace Tests\Acceptance;

use GildedRose\GildedRose;
use GildedRose\Item;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function sulfuras_is_immutable()
    {
        $sulfuras = new Item("Sulfuras, Hand of Ragnaros", 0, 80);
        $gildedRose = $this->aGildedRoseWithItems($sulfuras);

        $this->afterDays(10, $gildedRose);

        $this->assertItemsQuality(80, $sulfuras);
        $this->assertEquals(0, $sulfuras->sell_in);
    }

    /** @test */
    public function sell_in_decreases_by_one_each_day()
    {
        $notSulfuras = new Item("notSulfuras", 2, 0);
        $gildedRose = $this->aGildedRoseWithItems($notSulfuras);

        $this->afterDays(10, $gildedRose);

        $this->assertEquals(-8, $notSulfuras->sell_in);
    }

    /** @test */
    public function aged_brie_quality_increases_by_one_each_day_before_sell_date()
    {
        $agedBrie = new Item("Aged Brie", 2, 0);
        $gildedRose = $this->aGildedRoseWithItems($agedBrie);

        $this->afterDays(2, $gildedRose);

        $this->assertItemsQuality(2, $agedBrie);
    }

    /** @test */
    public function aged_brie_quality_increases_by_two_each_day_after_sell_date()
    {
        $agedBrie = new Item("Aged Brie", 0, 0);
        $gildedRose = $this->aGildedRoseWithItems($agedBrie);

        $this->afterDays(2, $gildedRose);

        $this->assertItemsQuality(4, $agedBrie);
    }

    /** @test */
    public function quality_Cannot_be_more_than_fifty()
    {
        $agedBrie = new Item("Aged Brie", 2, 0);
        $gildedRose = $this->aGildedRoseWithItems($agedBrie);

        $this->afterDays(300, $gildedRose);

        $this->assertItemsQuality(50, $agedBrie);
    }

    /** @test */
    public function backstage_passes_quality_increases_by_one_each_day_before_ten_days_to_sell_date()
    {
        $backstagePasses = new Item("Backstage passes to a TAFKAL80ETC concert", 15, 0);
        $gildedRose = $this->aGildedRoseWithItems($backstagePasses);

        $this->afterDays(5, $gildedRose);

        $this->assertItemsQuality(5, $backstagePasses);
    }

    /** @test */
    public function backstage_passes_quality_increases_by_two_each_day_between_ten_and_five_days_before_sell_date()
    {
        $backstagePasses = new Item("Backstage passes to a TAFKAL80ETC concert", 15, 0);
        $gildedRose = $this->aGildedRoseWithItems($backstagePasses);

        $this->afterDays(7, $gildedRose);

        $this->assertItemsQuality(9, $backstagePasses);
    }

    /** @test */
    public function backstage_passes_quality_increases_by_three_each_day_between_five_days_and_the_sell_date()
    {
        $backstagePasses = new Item("Backstage passes to a TAFKAL80ETC concert", 15, 0);
        $gildedRose = $this->aGildedRoseWithItems($backstagePasses);

        $this->afterDays(15, $gildedRose);

        $this->assertItemsQuality(30, $backstagePasses);
    }

    /** @test */
    public function backstage_passes_quality_Is_zero_after_the_sell_date()
    {
        $backstagePasses = new Item("Backstage passes to a TAFKAL80ETC concert", 15, 20);
        $gildedRose = $this->aGildedRoseWithItems($backstagePasses);

        $this->afterDays(16, $gildedRose);

        $this->assertItemsQuality(0, $backstagePasses);
    }

    /** @test */
    public function perishable_items_quality_decreases_by_one_each_day_before_sell_date()
    {
        $regularItem = new Item("+5 Dexterity Vest", 10, 20);
        $gildedRose = $this->aGildedRoseWithItems($regularItem);

        $this->afterDays(10, $gildedRose);

        $this->assertItemsQuality(10, $regularItem);
    }

    /** @test */
    public function perishable_items_quality_decreases_by_two_each_day_after_sell_date()
    {
        $perishableItem = new Item("+5 Dexterity Vest", 10, 20);
        $gildedRose = $this->aGildedRoseWithItems($perishableItem);

        $this->afterDays(15, $gildedRose);

        $this->assertItemsQuality(0, $perishableItem);
    }

    /** @test */
    public function perishable_items_quality_cannot_be_less_than_zero()
    {
        $perishableItem = new Item("+5 Dexterity Vest", 10, 20);
        $gildedRose = $this->aGildedRoseWithItems($perishableItem);

        $this->afterDays(200, $gildedRose);

        $this->assertItemsQuality(0, $perishableItem);
    }

    //---[ Helpers ]--------------------------------------------------------------------//

    /**
     * @param int        $numberOfDays
     * @param GildedRose $gildedRose
     */
    private function afterDays($numberOfDays, GildedRose $gildedRose)
    {
        for ($i = 0; $i < $numberOfDays; ++$i) {
            $gildedRose->update_quality();
        }
    }

    /**
     * @param int $quality
     * @param Item $item
     */
    private function assertItemsQuality($quality, Item $item)
    {
        $this->assertEquals($quality, $item->quality);
    }

    /**
     * @param Item[] ...$items
     * @return GildedRose
     */
    private function aGildedRoseWithItems(Item... $items)
    {
        return new GildedRose($items);
    }
}
