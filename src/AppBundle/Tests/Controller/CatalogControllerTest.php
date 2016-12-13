<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CatalogControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testByauthor()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/par-auteur');
    }

    public function testBytag()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/par-categorie');
    }

    public function testDetails()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/details');
    }

    public function testSearch()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/recherche');
    }

}
