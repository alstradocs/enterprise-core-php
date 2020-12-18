<?php

namespace Enterprise\Framework\Provider;

use Illuminate\Support\ServiceProvider;

/**
 *
 * @author  Edward Banfa <ebanfa@alstradocs.com>
 */
abstract class Alstradocs_Abstract_Module_Provider extends ServiceProvider
{


      /**
       * Register the action resolver services.
       *
       * @return void
       */
      public function register()
      {
          $this->register_common();
          if(is_admin()) {
              $this->register_admin();
          } else {
              $this->register_public();
          }

      }

      /**
       * Register admin facing components and services.
       *
       * @return void
       */
      protected abstract function register_admin();

      /**
       * Register frontend facing components and services.
       *
       * @return void
       */
      protected abstract function register_public();

      /**
       * Register frontend facing components and services.
       *
       * @return void
       */
      protected abstract function register_common();

      /**
       * Register .
       * @param token
       * @param instanceClass
       */
      public function register_action($token, $instanceClass)
      {
            $this->app->bind($token, function ($app) use($instanceClass) { return new $instanceClass($app); });
      }

      /**
       * Register
       * @param token
       * @param instanceClass
       */
      public function register_controller($token, $instanceClass)
      {
            $this->app->bind($token, function ($app) use($instanceClass) { return new $instanceClass($app); });
            $controller = $this->app->make($token);
            $controller->register($this->app, $this->app->loader);
      }

      /**
       * Register .
       * @param token
       * @param instanceClass
       */
      public function register_template($token, $instanceClass)
      {
            $this->app->bind($token, function ($app) use($instanceClass) { return new $instanceClass($app); });
      }

      /**
       * Register .
       * @param token
       * @param instanceClass
       */
      public function register_form($token, $instanceClass)
      {
            $this->app->bind($token, function ($app) use($instanceClass) { return new $instanceClass($app); });
      }

      /**
       * Register .
       * @param token
       * @param instanceClass
       */
      public function register_query_filter($token, $instanceClass)
      {
            $this->app->bind($token, function ($app) use($instanceClass) { return new $instanceClass($app); });
      }

      /**
       * Register .
       * @param token
       * @param instanceClass
       */
      public function register_data_provider($token, $instanceClass)
      {
            $this->app->bind($token, function ($app) use($instanceClass) { return new $instanceClass($app); });
      }

}
