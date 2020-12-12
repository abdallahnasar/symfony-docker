<?php

namespace App\FilterLib;

/**
 * Class FilterDate
 * @package App\FilterLib
 */
class FilterDate implements FilterInterface
{
    /**
     * given date return onwards top repos
     *
     * @param array $items
     * @param string $date
     * @return array
     */
    public function filter(array $items, string $date): array
    {
        $dateToFilter = new \DateTime($date);
        return array_filter($items, function ($var) use ($dateToFilter) {
            return (new \DateTime($var['created_at']) > $dateToFilter);
        });
    }
}
