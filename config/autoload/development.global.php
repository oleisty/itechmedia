<?php
/**
 * Local Configuration Override for DEVELOPMENT MODE.
 *
 * This configuration override file is for providing configuration to use while
 * in development mode. Run:
 *
 * <code>
 * $ composer development-enable
 * </code>
 *
 * from the project root to copy this file to development.local.php and enable
 * the settings it contains.
 *
 * You may also create files matching the glob pattern `{,*.}{global,local}-development.php`.
 */

return [
    'view_manager' => [
        'display_exceptions' => true,
    ],
    
    'twitter' => [
        'api' => [
            'consumer_key' => 'VfUHSMZCFJV2KzZRw7b20RAZj',
            'consumer_secret' => 'FJWbDcWIfPG6SyKC64CK7NCNmZJYVS1q9Tp066ZfQ9OM3Gz8y2',
            'oauth_access_token' => '1108723051577913346-1H9MbQzGqsLwJxBKZz9krvaD8DvAiv',
            'oauth_access_token_secret' => 'p9IutK5fUhha9c5dlHHfU8voNGluxCJm29ZJpk4X6s0CU'
        ],
        'default_user' => [
            'name' => 'UkSportsTvGuide'
        ],
        'tweet_url_template' => "https://twitter.com/%s/status/%s"
    ],
];
