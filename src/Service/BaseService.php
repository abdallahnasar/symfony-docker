<?php

namespace App\Service;

use App\Provider\DataProvider;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Class BaseService
 * @package App\Service
 */
class BaseService
{

    /**
     * function sort data by specific param
     * @param array $data
     * @param string $type
     * @return array
     */
    protected function sortBy(array $data, string $type): array
    {
        $keys = array_column($data['items'], $type);
        array_multisort($keys, SORT_DESC, $data['items']);
        return $data;
    }
}
