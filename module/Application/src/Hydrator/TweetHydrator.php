<?php

namespace Application\Hydrator;

use Application\Entity\Tweet;

/**
 * Convenient way for creating small, well known entities
 */
class TweetHydrator
{
    /**
     * Single hydration
     * @param \stdClass $data
     * @param Tweet $object
     */
    private function hydrateSingle(\stdClass $data, Tweet $object)
    {
        $object->setName($data->user->screen_name);
        $object->setId($data->id);
        $object->setIdStr($data->id_str);
        $object->setText($data->text);
        $object->setCreatedAt($data->created_at);
        $object->setImage($data->user->profile_image_url);
    }
    
    /**
     * Hydrate thru an array of \stdClass
     * Functional programming approach
     * @param array $data
     * @return array
     */
    public function hydrate(array $data): array
    {
        $entities = array_map(
            function($tweetData) {
                $tweetEntity = new Tweet();
                $this->hydrateSingle($tweetData, $tweetEntity);
                return $tweetEntity;
            },
            $data
        );
        return $entities;
    }
}
