<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReposControllerTest extends WebTestCase
{
    /** @test */
    public function testListAction()
    {
        $client = $this->createClient();
        $client->request('GET', 'api/v1/repos');
        $this->checkJsonResponse($client);
        $response = $client->getResponse()->getContent();
        $dataArray = json_decode($response, true);
        $this->checkSortedByStarsDesc($dataArray);
    }

    /** @test */
    public function testTopN()
    {
        $tops = [10,50,100];
        foreach ($tops as $top) {
            $this->checkTopNumber($top);
        }
    }

    /** @test */
    public function testDateFilter()
    {
        $client = $this->createClient();
        $client->request('GET', 'api/v1/repos?date=1-1-2018');
        $response = $client->getResponse()->getContent();
        $this->checkJsonResponse($client);
        $dataArray = json_decode($response, true);
        $this->assertGreaterThan(
            new \DateTime('1-1-2018'),
            new \DateTime($dataArray['items'][rand(1, $dataArray['total_count']-1)]['created_at'])
        );
    }

    /** @test */
    public function testLanguageFilter()
    {
        $client = $this->createClient();
        $client->request('GET', 'api/v1/repos?language=Python');
        $response = $client->getResponse()->getContent();
        $this->checkJsonResponse($client);
        $dataArray = json_decode($response, true);
        $this->assertEquals(
            $dataArray['items'][rand(0, $dataArray['total_count']-1)]['language'],
            'Python'
        );
    }

    /** @test */
    public function testDateAndLanguageFilter()
    {
        $client = $this->createClient();
        $client->request('GET', 'api/v1/repos?date=1-1-2018&language=Python');
        $response = $client->getResponse()->getContent();
        $this->checkJsonResponse($client);
        $dataArray = json_decode($response, true);
        $this->assertGreaterThan(
            new \DateTime('1-1-2018'),
            new \DateTime($dataArray['items'][rand(1, $dataArray['total_count']-1)]['created_at'])
        );

        $this->assertEquals(
            $dataArray['items'][rand(0, $dataArray['total_count']-1)]['language'],
            'Python'
        );
    }

    /**
     * @param KernelBrowser $client
     */
    private function checkJsonResponse(KernelBrowser $client): void
    {
        $this->assertEquals('200', $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->headers->contains('Content-Type', 'application/json'));
    }

    /**
     * @param array $dataArray
     */
    private function checkSortedByStarsDesc(array $dataArray): void
    {
        // check sorted by stars desc
        $this->assertGreaterThan(
            $dataArray['items'][rand(1, $dataArray['total_count']-1)]['stargazers_count'],
            $dataArray['items'][0]['stargazers_count']
        );
    }

    /**
     * @param int $number
     */
    private function checkTopNumber(int $number): void
    {
        $client = $this->createClient();
        $client->request('GET', 'api/v1/repos?top='. $number);
        $response = $client->getResponse()->getContent();
        $this->checkJsonResponse($client);
        $dataArray = json_decode($response, true);
        $this->assertEquals($number, $dataArray['total_count']);
        $this->ensureKernelShutdown();
    }

}
