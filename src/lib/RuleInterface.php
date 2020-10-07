<?php

namespace Runroom\GildedRose\lib;

use Runroom\GildedRose\Item;

/**
 * Esta interfaz nos define reglas.
 *
 * El método update me modifica el objeto Item
 * El método match indica si se debe aplicar o no la modificación
 * El método applyTo aplica la modificacion al item soólo si el método match devuelve true
 */
interface RuleInterface
{


  /**
   * Define el nombre de la regla
   */
    public function getName(): string;

    /**
     * Define la descripción
     */
    public function getDescription(): string;

    /**
     * Comprueba si el item debe actualizar
     */
    public function match(Item $item): bool;

    /**
     * Actualiza el item
     */
    public function update(Item &$item): void;

    /**
     * Aplica la actualización del item solo si se cumple el match
     */
    public function applyTo(Item &$item): void;
}
