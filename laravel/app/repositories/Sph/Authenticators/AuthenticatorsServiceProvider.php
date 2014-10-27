<?php

namespace Sph\Authenticators;

use Illuminate\Support\ServiceProvider;
use League\OAuth1\Client\Server\Twitter;
use League\OAuth2\Client\Provider\Facebook;
use League\OAuth2\Client\Provider\Google;

/**
 * Description of AuthenticatorsServiceProvider
 *
 * @author carlos
 */
class AuthenticatorsServiceProvider extends ServiceProvider
{

      public function register()
      {
            $this->registerManager();
            $this->registerTwitterAuthenticator();
            $this->registerFacebookAuthenticator();
            $this->registerGoogleAuthenticator();
            
      }

      /**
       * Inject the provders into the Manager class
       *
       * @return void
       */
      public function boot()
      {
            $this->app['auth.providers.manager']->set('twitter', $this->app['auth.providers.twitter']);
            $this->app['auth.providers.manager']->set('facebook', $this->app['auth.providers.facebook']);
            $this->app['auth.providers.manager']->set('google', $this->app['auth.providers.google']);
      }

      public function registerManager()
      {
            $this->app['auth.providers.manager'] = $this->app->share(function($app) {
                  return new Manager;
            });

            $this->app->bind('Sph\Authenticators\Manager', function($app) {
                  return $app['auth.providers.manager'];
            });
      }

      public function registerTwitterAuthenticator()
      {
            $this->app['auth.providers.twitter'] = $this->app->share(function($app) {
                  return new Twitter(array(
                        'identifier' => $app['config']->get('auth.providers.twitter.identifier'),
                        'secret' => $app['config']->get('auth.providers.twitter.secret'),
                        'callback_uri' => $app['config']->get('auth.providers.twitter.callback_uri')
                  ));
            });
      }
      
      public function registerFacebookAuthenticator()
      {
            $this->app['auth.providers.facebook'] = $this->app->share(function($app) {
                  return new Facebook(array(
                        'clientId' => $app['config']->get('auth.providers.facebook.clientId'),
                        'clientSecret' => $app['config']->get('auth.providers.facebook.clientSecret'),
                        'redirectUri' => $app['config']->get('auth.providers.facebook.redirectUri')
                  ));
            });
      }
      public function registerGoogleAuthenticator()
      {
            $this->app['auth.providers.google'] = $this->app->share(function($app) {
                  return new Google(array(
                        'clientId' => $app['config']->get('auth.providers.google.clientId'),
                        'clientSecret' => $app['config']->get('auth.providers.google.clientSecret'),
                        'redirectUri' => $app['config']->get('auth.providers.google.redirectUri')
                  ));
            });
      }
}
