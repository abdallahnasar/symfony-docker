<?php

namespace App\Provider;

use App\Constant\EndpointsUrls;
use App\Constant\HttpMethodTypes;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class DataProvider
 * @package App\Provider
 */
class DataProvider
{
    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * DataProvider constructor.
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $response = $this->client->request(
            HttpMethodTypes::GET,
            EndpointsUrls::GITHUB_ENDPOINT
        );

        if ($response->getStatusCode() !== 200) {
            return [
                'status' => false,
                'msg' => 'error getting data'
            ];
        }
        return $response->toArray();
    }
}
