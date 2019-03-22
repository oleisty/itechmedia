<?php

namespace ApplicationTest\Library;

use Application\Library\Api;
use Application\Hydrator\Factory\HydratorFactory;
use Application\Entity\Tweet;
use Zend\Stdlib\ArrayObject;
use PHPUnit\Framework\TestCase;

class TweetHydratorTest extends TestCase
{
    private $config;
    
    public function setUp()
    {
        $this->config = include __DIR__.'/../../../../config/autoload/development.global.php';
        parent::setUp();
    }
    
    /**
     * Checks wheter processed data is as expected type
     */
    public function testCheckIfHydratorReturnsArrayOfTweetEntities()
    {
        $userName = $this->config['twitter']['default_user']['name'];
        $api = new Api($this->config);
        $data = $api->getUserTimeline($userName, 3);
        $this->assertInternalType('array', $data);
        foreach ($data as $tweetData) {
            $this->assertInstanceOf(\stdClass::class, $tweetData);
        }
        $storage = new ArrayObject();
        $hydratorFactory = new HydratorFactory($storage);
        $tweetHydrator = $hydratorFactory->getTweetHydrator();
        $tweets = $tweetHydrator->hydrate($data);
        $this->assertInternalType('array', $tweets);
        foreach ($tweets as $tweetEntity) {
            $this->assertInstanceOf(Tweet::class, $tweetEntity);
        }
    }
}