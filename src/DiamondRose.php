<?php

namespace Runroom\GildedRose;

use Runroom\GildedRose\lib\RulesManager;

class DiamondRose
{
    private $items;

    private $manager;

    public function __construct($items)
    {
        $this->makeManager();
        $this->items = $items;
    }

    public function update_quality()
    {
        $items = $this->manager
      ->setItems($this->items)
      ->process()
      ->getItems()
    ;

        $this->items = $items;
    }

    protected function makeManager(): void
    {
        $this->manager = new RulesManager();
        $this->manager
      ->addGenericRule(
          'Rule 1',
          function (Item $item) {
          $name     = $item->name;
          $quality  = $item->quality;
          return
          ($name != 'Aged Brie' && $name != 'Backstage passes to a TAFKAL80ETC concert')
          && $quality > 0
          && $name != 'Sulfuras, Hand of Ragnaros'
        ;
      },
          function (Item $item) {
          $item->quality--;
      }
      )
      ->addGenericRule(
          'Rule 2',
          function (Item $item) {
          $name     = $item->name;
          $quality  = $item->quality;
          $sell_in  = $item->sell_in;
          return
          ($name == 'Aged Brie' || $name == 'Backstage passes to a TAFKAL80ETC concert')
          && $quality < 50
        ;
      },
          function (Item $item) {
          $item->quality++;
      }
      )
      ->addGenericRule(
          'Rule 3',
          function (Item $item) {
          $name     = $item->name;
          $quality  = $item->quality;
          $sell_in  = $item->sell_in;
          return
          ($name == 'Aged Brie' || $name == 'Backstage passes to a TAFKAL80ETC concert')
          && $quality < 50
          && $name == 'Backstage passes to a TAFKAL80ETC concert'
          && $item->sell_in < 11
        ;
      },
          function (Item $item) {
          $item->quality++;
      }
      )
      ->addGenericRule(
          'Rule 4',
          function (Item $item) {
          $name     = $item->name;
          $quality  = $item->quality;
          $sell_in  = $item->sell_in;
          return
          ($name == 'Aged Brie' || $name == 'Backstage passes to a TAFKAL80ETC concert')
          && $quality < 50
          && $name == 'Backstage passes to a TAFKAL80ETC concert'
          && $item->sell_in < 6
        ;
      },
          function (Item $item) {
          $item->quality++;
      }
      )
      ->addGenericRule(
          'Rule 5',
          function (Item $item) {
          $name = $item->name;
          return ($name != 'Sulfuras, Hand of Ragnaros') ;
      },
          function (Item $item) {
          $item->sell_in--;
      }
      )
      ->addGenericRule(
          'Rule 6',
          function (Item $item) {
          $name     = $item->name;
          $quality  = $item->quality;
          $sell_in  = $item->sell_in;
          return
          $sell_in < 0
          && ($name != 'Aged Brie' && $name != 'Backstage passes to a TAFKAL80ETC concert')
          && $quality > 0
          && $name != 'Sulfuras, Hand of Ragnaros'
        ;
      },
          function (Item $item) {
          $item->quality--;
      }
      )
      ->addGenericRule(
          'Rule 7',
          function (Item $item) {
          $name     = $item->name;
          $quality  = $item->quality;
          $sell_in  = $item->sell_in;
          return
          $sell_in < 0
          && ($name != 'Aged Brie' && $name == 'Backstage passes to a TAFKAL80ETC concert')
        ;
      },
          function (Item $item) {
          $item->quality = 0;
      }
      )
      ->addGenericRule(
          'Rule 8',
          function (Item $item) {
          $name     = $item->name;
          $quality  = $item->quality;
          $sell_in  = $item->sell_in;
          return
          $sell_in < 0
          && ($name == 'Aged Brie')
          && $quality < 50
        ;
      },
          function (Item $item) {
          $item->quality++;
      }
      )
      ;
    }
}
