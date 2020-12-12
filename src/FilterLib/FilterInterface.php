<?php

namespace App\FilterLib;

/**
 * Interface FilterInterface
 * @package App\FilterLib
 */
interface FilterInterface
{
    /**
     * @param array $items
     * @param string $parameter
     * @return array
     */
    public function filter(array $items, string $parameter): array;
}
