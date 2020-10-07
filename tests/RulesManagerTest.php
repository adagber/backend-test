<?php

namespace Runroom\GildedRose\Tests;

use Runroom\GildedRose\Item;
use PHPUnit\Framework\TestCase;
use Runroom\GildedRose\lib\GenericRule as Rule;
use Runroom\GildedRose\lib\RulesManager;

class RulesManagerTest extends TestCase
{
    
    protected $manager;

    protected function setUp(): void
    {
      $this->manager = new RulesManager();
      $this->manager
        ->addGenericRule(
        'Rule 1', 
        function(Item $item){
          
          $name     = $item->name;
          $quality  = $item->quality;
          return 
            ( $name != 'Aged Brie' && $name != 'Backstage passes to a TAFKAL80ETC concert' )
            && $quality > 0
            && $name != 'Sulfuras, Hand of Ragnaros'
          ;
        },
        function(Item $item){
        
          $item->quality--;
        })
        ->addGenericRule(
        'Rule 2', 
        function(Item $item){
          $name     = $item->name;
          $quality  = $item->quality;
          $sell_in  = $item->sell_in;
          return 
            ( $name == 'Aged Brie' || $name == 'Backstage passes to a TAFKAL80ETC concert' )
            && $quality < 50
          ;
        },
        function(Item $item){
          
          $item->quality++;
        })
        ->addGenericRule(
        'Rule 3', 
        function(Item $item){
          $name     = $item->name;
          $quality  = $item->quality;
          $sell_in  = $item->sell_in;
          return 
            ( $name == 'Aged Brie' || $name == 'Backstage passes to a TAFKAL80ETC concert' )
            && $quality < 50
            && $name == 'Backstage passes to a TAFKAL80ETC concert'
            && $item->sell_in < 11 
          ;
        },
        function(Item $item){
          $item->quality++;
        })
        ->addGenericRule(
        'Rule 4', 
        function(Item $item){
          $name     = $item->name;
          $quality  = $item->quality;
          $sell_in  = $item->sell_in;
          return 
            ( $name == 'Aged Brie' || $name == 'Backstage passes to a TAFKAL80ETC concert' )
            && $quality < 50
            && $name == 'Backstage passes to a TAFKAL80ETC concert'
            && $item->sell_in < 6 
          ;
        },
        function(Item $item){
          $item->quality++;
        })
        ->addGenericRule(
        'Rule 5', 
        function(Item $item){
          $name = $item->name;
          return ( $name != 'Sulfuras, Hand of Ragnaros' ) ;
        },
        function(Item $item){
          $item->sell_in--;
        })
        ->addGenericRule(
        'Rule 6', 
        function(Item $item){
          $name     = $item->name;
          $quality  = $item->quality;
          $sell_in  = $item->sell_in;
          return 
            $sell_in < 0
            && ( $name != 'Aged Brie' && $name != 'Backstage passes to a TAFKAL80ETC concert' )
            && $quality > 0
            && $name != 'Sulfuras, Hand of Ragnaros'
          ;
        },
        function(Item $item){
          $item->quality--;
        })
        ->addGenericRule(
        'Rule 7', 
        function(Item $item){
          $name     = $item->name;
          $quality  = $item->quality;
          $sell_in  = $item->sell_in;
          return 
            $sell_in < 0
            && ( $name != 'Aged Brie' && $name == 'Backstage passes to a TAFKAL80ETC concert' )
          ;
        },
        function(Item $item){
          $item->quality = 0;
        })
        ->addGenericRule(
        'Rule 8', 
        function(Item $item){
          $name     = $item->name;
          $quality  = $item->quality;
          $sell_in  = $item->sell_in;
          return 
            $sell_in < 0
            && ( $name == 'Aged Brie' )
            && $quality < 50
          ;
        },
        function(Item $item){
          $item->quality++;
        })
        ;
    }

    /**
     * @test
     */
    public function process()
    {
      $items = [new Item('', 1, 5)];

      $items = $this->manager
        ->setItems($items)
        ->process()
        ->getItems()
      ;
      
      $this->assertEquals(4, $items[0]->quality);
  	}

}
