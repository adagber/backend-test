<?php

namespace Runroom\GildedRose\lib;

use Runroom\GildedRose\Item;
use Runroom\GildedRose\lib\GenericRule;
use Runroom\GildedRose\lib\RuleInterface;

class RulesManager
{
    protected $rules = [];

    protected $items = [];

    public function __construct(array $rules = [])
    {
        foreach ($rules as $rule) {
            $this->addRule($rule);
        }
    }

    public function addGenericRule(string $name, callable $match, callable $update, string $description = null): self
    {
        $this->addRule(new GenericRule(
            $name,
            $match,
            $update,
            $description
        ));
    
        return $this;
    }

    public function addRule(RuleInterface $rule): self
    {
        $this->rules[] = $rule;
        return $this;
    }

    public function addItem(Item $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    public function setItems(array $items): self
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function process(): self
    {
        foreach ($this->getItems() as &$item) {
            foreach ($this->rules as $rule) {
                $rule->applyTo($item);
            }
        }

        return $this;
    }
}
