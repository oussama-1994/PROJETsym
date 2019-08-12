<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EditControllerTest extends WebTestCase
{
    public function testUseredit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/useredit');
    }

    public function testProedit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/proedit');
    }

}
