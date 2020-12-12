<?php

namespace App\Service;

use App\Constant\Filters;
use App\FilterLib\FilterContext;
use App\Provider\DataProvider;

/**
 * Class ReposService
 * @package App\Service
 */
class ReposService extends BaseService
{
    /**
     * @var DataProvider
     */
    private $dataProvider;

    /**
     * ReposService constructor.
     * @param DataProvider $dataProvider
     */
    public function __construct(DataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @param $params
     * @return array
     */
    public function list(array $params): array
    {

        // get data
        $data = $this->dataProvider->getAll();

        // sort by number of stars
        $data = $this->sortBy($data, 'stargazers_count');

        // filter by date and language
        $filters = Filters::getFilters();
        $filters = array_combine($filters, $filters);
        $appliedFilters = array_intersect_key($params, $filters);

        foreach ($appliedFilters as $key => $value) {
            $filterClass = 'App\FilterLib\Filter'.ucfirst($key);
            $filterContext = new FilterContext(new $filterClass());
            $data['items'] = $filterContext->executeFilter($data['items'], $value);
        }

        // filter top n repositories
        if (isset($params['top']) && count($data['items']) > $params['top']) {
            $data['items'] = array_slice($data['items'], 0, $params['top']);
        }

        return [
            'total_count' => count($data['items']),
            'items' => array_values($data['items']),
        ];
    }
}
