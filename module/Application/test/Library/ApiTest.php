<?php

namespace ApplicationTest\Library;

use Application\Library\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    private $config;
    
    public function setUp()
    {
        $this->config = include __DIR__.'/../../../../config/autoload/development.global.php';
        parent::setUp();
    }
    
    public function testCheckIfDevelopmentCredentialsValid()
    {
        $api = new Api($this->config);        
        $this->assertTrue($api->verifyCredentials());
    }
    
    public function testCheckIfDefaultUserReturnsAnArrayOfTweets()
    {
        $api = new Api($this->config);
        $data = $api->getUserTimeline($this->config['twitter']['default_user']['name'], 2);
        $this->assertInternalType('array', $data);
    }
}