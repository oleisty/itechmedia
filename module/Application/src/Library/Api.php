<?php

namespace Application\Library;

use ZendService\Twitter\Twitter;

class Api
{
    const CODE_OK = 200;
    const CODE_NOT_FOUND = 404;

    /**
     * @var ZendService\Twitter\Twitter
     */
    private $twitter;
    
    /**
     * Api constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->twitter = new Twitter([
            'access_token' => [
                'token' => $config['twitter']['api']['oauth_access_token'],
                'secret' => $config['twitter']['api']['oauth_access_token_secret'],
            ],
            'oauth_options' => [
                'consumerKey' => $config['twitter']['api']['consumer_key'],
                'consumerSecret' => $config['twitter']['api']['consumer_secret'],
            ],
        ]);
    }

    /**
     * Checks if credentials are correct
     * @return bool
     */
    public function verifyCredentials(): bool
    {
        $response = $this->twitter->accountVerifyCredentials();
        return $response->isSuccess();
    }
    
    /**
     * Checks if there is a User with provided name
     * @param string $userName
     * @return bool
     */
    public function isUser(string $userName): bool
    {
        $response = $this->twitter->usersLookup($userName);
        return $response->isSuccess();
    }
    
    /**
     * Check before calling the timeline
     * I've noticed that Twitter API often returns authorization issues
     * i.e. for users named 'd' or 'e'
     * This method is to check access to timeline right before the get
     * I know that this is inefficient, but Twitter lacks of better method
     * @param string $userName
     * @return bool
     */
    public function isAuthorizedToUserTimeline(string $userName): bool
    {
        $options = [
            'screen_name' => $userName,
            'count' => 1,
        ];
        $response = $this->twitter->statusesUserTimeline($options);
        return $response->isSuccess();
    }

    /**
     * Gets user timeline
     * @param string $userName
     * @param int $countTweets The quantity
     * @return \stdClass[]
     */
    public function getUserTimeline(string $userName, int $countTweets): array
    {
        $options = [
            'screen_name' => $userName,
            'count' => $countTweets,
        ];
        $response = $this->twitter->statusesUserTimeline($options);
        return $response->toValue();
    }
}