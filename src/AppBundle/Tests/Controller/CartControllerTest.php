<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/index');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/supprimer');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouter');
    }

    public function testDeleteall()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/vider');
    }

    public function testRecalc()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/recalculer');
    }

}
