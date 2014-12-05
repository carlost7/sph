<?php

return array(
    'providers' => array(
        'twitter' => array(
            'identifier' => $_ENV['TWITTER_IDENTIFIER'],
            'secret' => $_ENV['TWITTER_SECRET'],
            'callback_uri' => $_ENV['TWITTER_CALLBACK_URI']
        ),
        'facebook' => array(
            'clientId' => $_ENV['FACEBOOK_IDENTIFIER'],
            'clientSecret' => $_ENV['FACEBOOK_SECRET'],
            'redirectUri' => $_ENV['FACEBOOK_CALLBACK_URI']
        ),
        'google' => array(
            /*'clientId' => $_ENV['GOOGLE_IDENTIFIER'],
            'clientSecret' => $_ENV['GOOGLE_SECRET'],
            'redirectUri' => $_ENV['GOOGLE_CALLBACK_URI']*/
        )
    )
);
