<?php

namespace Application\Hydrator\Factory;

use Application\Hydrator\TweetHydrator;

use Zend\Stdlib\ArrayObject;

class HydratorFactory
{
    /**
     * @var ArrayObject
     */
    private $storage;

    public function __construct(ArrayObject $storage)
    {
        $this->storage = $storage;
    }
    
    /**
     * @return TweetHydrator
     */
    public function getTweetHydrator(): TweetHydrator
    {
        return $this->getSimpleClassInstance(TweetHydrator::class);
    }
    
    /**
     * Class to ensure that there is s single instance of a class at a time
     * @param string $class
     * @return TweetHydrator
     */
    private function getSimpleClassInstance(string $class): TweetHydrator
    {
        $existingClass = $this->storage->offsetGet($class);
        if ($existingClass) {
            return $existingClass;
        }

        $newClass = new $class();
        $this->storage->offsetSet($class, $newClass);

        return $newClass;
    }
}
