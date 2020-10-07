<?php

namespace Runroom\GildedRose\lib;

use Closure;
use Runroom\GildedRose\Item;

class GenericRule implements RuleInterface
{
  
  protected $name;
  protected $description;
  protected $match;
  protected $update;

  public function __construct(string $name, callable $match, callable $update, ?string $description = null)
  {
    $this->name           = $name;
    $this->match          = $match;
    $this->update         = $update;
    $this->description    = $description;
  }
  public function getName(): string
  {
    return $this->name;
  }

  public function getDescription(): string
  {
    return 'The Generic Rule';
  }

  public function match(Item $item): bool
  {
    return call_user_func_array($this->match, [$item]);
  }

  public function update(Item &$item): void
  {
    call_user_func_array($this->update, [$item]);
  }

  public function applyTo(Item $item): void
  {
    if(true === $this->match($item)){

      $this->update($item);
    }
  }
}