<?php

namespace App\FilterLib;

/**
 * Class FilterLanguage
 * @package App\FilterLib
 */
class FilterLanguage implements FilterInterface
{
    /**
     * @param array $items
     * @param string $language
     * @return array
     */
    public function filter(array $items, string $language): array
    {
        return array_filter($items, function ($var) use ($language) {
            return $var['language'] == $language;
        });
    }
}
