<?php

namespace App\FilterLib;

/**
 * Class FilterContext
 * @package App\FilterLib
 */
class FilterContext
{
    /**
     * @var FilterInterface
     */
    private $filterInterface;

    /**
     * FilterContext constructor.
     * @param FilterInterface $filterInterface
     */
    public function __construct(FilterInterface $filterInterface)
    {
        $this->filterInterface = $filterInterface;
    }

    /**
     * @param $items
     * @param $parameter
     * @return array
     */
    public function executeFilter($items, $parameter): array
    {
        return $this->filterInterface->filter($items, $parameter);
    }
}
