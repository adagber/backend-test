<?php

namespace Runroom\GildedRose\Tests;

use Runroom\GildedRose\Item;
use PHPUnit\Framework\TestCase;
use Runroom\GildedRose\lib\GenericRule;

class GenericRuleTest extends TestCase
{
    
    protected $rule;

    protected function setUp(): void
    {
      $this->rule = new GenericRule(
        'test  generic rule', 
        function(Item $item){
          return empty($item->name);
        },
        function(Item $item){
          $item->quality--;
        }
      );
    }

    /**
     * @test
     */
    public function match()
    {

      $item = new Item('', 1, 5);

      $this->assertEquals('test  generic rule', $this->rule->getName());
      $this->assertTrue($this->rule->match($item));
  	}

    /**
     * @test
     */
    public function applyTo()
    {
      $item = new Item('', 1, 5);
      $itemWithName = new Item('My name', 1, 5);
      
      $this->rule->applyTo($item);
      $this->rule->applyTo($itemWithName);

      $this->assertEquals(4,$item->quality);
      $this->assertEquals(5,$itemWithName->quality);
  	}

}
