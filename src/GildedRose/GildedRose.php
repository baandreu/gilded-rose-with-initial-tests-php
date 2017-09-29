<?php

namespace GildedRose;

class GildedRose {

    private $items;

    function __construct($items) {
        $this->items = $items;
    }

    function update_quality() {

        foreach ($this->items as $item) {

            // Sulfuras és inmutable
            if($item->name == 'Sulfuras, Hand of Ragnaros') continue;

            switch($item->name) {

                case 'Aged Brie':
                    
                    $item->sell_in = $item->sell_in - 1;
                    $this->icrease_quality_if_not_maximum($item);
                    if ($item->sell_in < 0) {
                        $this->icrease_quality_if_not_maximum($item);
                    }
                    break;

                case 'Backstage passes to a TAFKAL80ETC concert':
                    $this->increase_quality_depending_on_sell_in($item);
                    $this->decrease_sell_in($item);
                    break;

                default:
                    $item->sell_in = $item->sell_in - 1;
                    if ($item->sell_in < 0) {
                        $this->decrease_quality_if_not_minimum($item, 2);
                    }
                    $this->decrease_quality_if_not_minimum($item);
                    break;
            }

        }

    }

    /**
     * @param $item
     * @param $amount
     */
    private function icrease_quality_if_not_maximum($item, $amount=1)
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + $amount;
        }
    }

    /**
     * @param $item
     * @param $amount
     */
    private function decrease_quality_if_not_minimum($item, $amount=1)
    {
        if ($item->quality > 0 && $amount> 0 ) {
            $item->quality = $item->quality - 1;
            self::decrease_quality_if_not_minimum($item, $amount-1);
        }
    }

    /**
     * @param $item
     */
    protected function decrease_sell_in($item)
    {
        $item->sell_in = $item->sell_in - 1;
        if ($item->sell_in < 0) {
            $item->quality = 0;
        }
    }

    /**
     * @param $item
     */
    protected function increase_quality_depending_on_sell_in($item)
    {
        if ($item->sell_in < 6) {
            $this->icrease_quality_if_not_maximum($item, 3);
        } elseif ($item->sell_in < 11) {
            $this->icrease_quality_if_not_maximum($item, 2);
        } else {
            $this->icrease_quality_if_not_maximum($item);
        }
    }

}
