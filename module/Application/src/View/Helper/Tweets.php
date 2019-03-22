<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Application\Entity\Tweet;
use Application\View\Helper\TimeElapsed;

/**
 * View Helper for rendering Tweets.
 */
class Tweets extends AbstractHelper 
{
    /**
     * @var TimeElapsed 
     */
    private $timeElapsedHelper;
    
    /**
     * @var string 
     */
    private $tweetUrlTemplate;
    
    /**
     * Setter
     * @param TimeElapsed $timeElapsedHelper
     * @return \Application\View\Helper\Tweets
     */
    public function setTimeElapsedHelper(TimeElapsed $timeElapsedHelper): Tweets
    {
        $this->timeElapsedHelper = $timeElapsedHelper;
        return $this;
    }
    
    /**
     * Check main config to see template
     * @param string $tweetUrlTemplate
     * @return \Application\View\Helper\Tweets
     */
    public function setUrlTweetTemplate(string $tweetUrlTemplate): Tweets
    {
        $this->tweetUrlTemplate = $tweetUrlTemplate;
        return $this;
    }
    
    /**
     * Renders single tweet
     * @param Tweet $tweet
     * @return string
     */
    private function renderSingleTweet(Tweet $tweet): string
    {
        $timeElapsed = $this->timeElapsedHelper
                ->setDatetime($tweet->getCreatedAt())
                ->getTimeElapsed();
        $data = [
            'text' => $tweet->getText(),
            'image' => $tweet->getImage(),
            'timeElapsed' => $timeElapsed,
            'url' => sprintf($this->tweetUrlTemplate, $tweet->getName(), $tweet->getIdStr())
        ];
        return $this->getView()->render('partial/tweets/tweet', $data);
    }

    /**
     * Renders the set of tweets
     * @param Tweets[] $arrayOfTweets
     * @return string
     */
    public function renderTweets($arrayOfTweets): string
    {
        $renderedTweets = '';
        foreach ($arrayOfTweets as $tweet) {
            $renderedTweets .= $this->renderSingleTweet($tweet);
        }
        return $renderedTweets;
    }

}
