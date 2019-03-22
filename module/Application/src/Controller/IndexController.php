<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Library\Api;
use Application\Hydrator\Factory\HydratorFactory;
use Zend\Stdlib\ArrayObject;
use Zend\View\HelperPluginManager;

class IndexController extends AbstractActionController
{
    const JSON_STATUS_INIT = 0;
    const JSON_STATUS_SUCCESS = 1;
    const JSON_STATUS_ERROR = 2;
    
    private $config;
    private $viewHelperManager;
    
    public function __construct(array $config, HelperPluginManager $viewHelperManager)
    {
        $this->config = $config;
        $this->viewHelperManager = $viewHelperManager;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    /**
     * Gets user timeline
     * Action to be called from frontend
     * @return JsonModel
     */
    public function getUserTimelineAction(): JsonModel
    {
        $data = [
            'status' => self::JSON_STATUS_INIT,
            'message' => '',
            'userName' => ''
        ];
        
        // get posted data
        if ($this->getRequest()->isPost()) {
            $userName = $this->getRequest()->getPost()->userName;
        }
        
        // load default user
        if (empty($userName)) {
            $userName = $this->config['twitter']['default_user']['name'];
        }
        
        // get tweets
        $api = new Api($this->config);
        if ($api->isUser($userName) && $api->isAuthorizedToUserTimeline($userName)) {
            $data = $api->getUserTimeline($userName, 3);
        
            // hydrate data to objects
            $storage = new ArrayObject();
            $hydratorFactory = new HydratorFactory($storage);
            $tweetHydrator = $hydratorFactory->getTweetHydrator();
            $tweets = $tweetHydrator->hydrate($data);

            // render objects
            $timeElapsedHelper = $this->viewHelperManager->get('timeElapsed');
            $viewHelper = $this->viewHelperManager->get('tweets');
            $renderedTweets = $viewHelper
                    ->setTimeElapsedHelper($timeElapsedHelper)
                    ->setUrlTweetTemplate($this->config['twitter']['tweet_url_template'])
                    ->renderTweets($tweets);
            
            $data = [
                'status' => self::JSON_STATUS_SUCCESS,
                'message' => $renderedTweets,
                'userName' => $userName
            ];
        } else {
            $data = [
                'status' => self::JSON_STATUS_ERROR,
                'message' => 'No user matches for specified name.',
                'userName' => $userName
            ];
        }

        return new JsonModel($data);
    }
}
