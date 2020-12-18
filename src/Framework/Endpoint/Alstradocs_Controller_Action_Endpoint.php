<?php

namespace Enterprise\Framework\Endpoint;

use Enterprise\Framework\Alstradocs_Application;
use Enterprise\Framework\Service\Action\Resolver\ActionNotFoundException;
use Enterprise\Framework\Service\Action\Execution\ActionExecutionException;
use Enterprise\Framework\Service\Action\Execution\ActionExecutionServiceInterface;

/**
 * WordPress REST API Controller.
 *
 * @since 1.0.0
 */
class Alstradocs_Controller_Action_Endpoint extends \WP_REST_Controller
{
    protected $app;
    protected $executionService;

    /**
     * The base to use in the API route.
     *
     * @var string
     */
    protected $base = 'controller';

    /**
     * The namespace for these routes.
     *
     * @var string
     */
    protected $namespace = 'enterprise/v2';

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $alstradocs_writing       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->executionService = $app->make(ActionExecutionServiceInterface::class);
    }

    /**
     * Register the routes for the objects of the controller.
     */
    public function register_routes()
    {

        // Register the general endpoint route.
        register_rest_route($this->namespace, "/{$this->base}/(?P<name>[a-zA-Z]+)", array(
            array(
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => array( $this, 'execute' ),
                'permission_callback' => '__return_true'
            ),
            array(
                'methods'             => \WP_REST_Server::CREATABLE,
                'callback'            => array( $this, 'execute' ),
                'permission_callback' => '__return_true'
            ),
        ));

        // Register the individual object endpoint route.
        register_rest_route($this->namespace, "/{$this->base}/(?P<name>[a-zA-Z]+)/(?P<code>[^/]+)", array(
            array(
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => array( $this, 'execute' ),
                'permission_callback' => '__return_true'
            ),
            array(
                'methods'              => \WP_REST_Server::EDITABLE,
                'callback'             => array( $this, 'execute' ),
                'permission_callback' => '__return_true'
            ),
            array(
                'methods'             => \WP_REST_Server::DELETABLE,
                'callback'            => array( $this, 'execute' ),
                'permission_callback' => '__return_true'
            ),
        ));
    }

    /**
     * Get a collection of items.
     *
     * @param WP_REST_Request $request Full data about the request.
     *
     * @return WP_Error|WP_REST_Response
     */
    public function execute($request)
    {
        try {
            $return = $this->executionService->execute($request->get_param('name'), $request);
            return rest_ensure_response($this->prepare_item_for_response($return, $request));
        } catch (ActionNotFoundException $e) {
            return $this->actionNotFound();
        } catch (ActionExecutionException $e) {
            return $this->onActionExecutionException($e);
        } catch (DatabaseException $e) {
            return $this->databaseExceptionFound($e);
        }
    }

    protected function actionNotFound()
    {
        return new \WP_Error(
            'rest_controller_error',
            __('Controller not found.', 'rest-api-link-manager'),
            array( 'status' => 404 )
        );
    }

    protected function onActionExecutionException($e)
    {
        return new \WP_Error(
            'rest_controller_error',
            __($e->getMessage(), 'rest-api-link-manager'),
            array( 'status' => 409 )
        );
    }

    protected function databaseExceptionFound($e)
    {
		$message = '';
        // Split string by '(' to remove the database information
        $messages = explode("(", $e->getMessage());
        if(!empty($messages)) {
            $message = $messages[0];
        }
        return new \WP_Error(
            'rest_controller_error',
            __($message, 'rest-api-link-manager'),
            array( 'status' => 404 )
        );
    }

    /**
     * Check if a given request has access to get items.
     *
     * @param WP_REST_Request $request Full data about the request.
     *
     * @return WP_Error|bool
     */
    public function get_items_permissions_check($request)
    {
        if (! $this->check_can_manage_artifact($request)) {
            return new \WP_Error(
                'rest_forbidden_context',
                __('Sorry, you are not allowed to edit links.', 'rest-api-link-manager'),
                array( 'status' => 403 )
            );
        }

        return true;
    }

    /**
     * Check if a given request has access to get a specific item.
     *
     * @param WP_REST_Request $request Full data about the request.
     *
     * @return WP_Error|bool
     */
    public function get_item_permissions_check($request)
    {
        if (! $this->check_can_manage_artifact($request)) {
            return new \WP_Error(
                'rest_forbidden_context',
                __('Sorry, you are not allowed to edit links.', 'rest-api-link-manager'),
                array( 'status' => 403 )
            );
        }

        return true;
    }

    /**
     * Determine if the current user can manage links.
     *
     * @param WP_REST_Request $request
     *
     * @return bool
     */
    public function manage_artifact_check($request)
    {
        return true;
    }

    /**
     * Prepare the item for create or update operation.
     *
     * @param WP_REST_Request $request Request object.
     *
     * @return WP_Error|array $prepared_item
     */
    protected function prepare_item_for_database($request)
    {
        $prepared_item = array();
        return $prepared_item;
    }

    /**
     * Prepare the item for the REST response.
     *
     * @param stdClass        $item    WordPress representation of the item.
     * @param WP_REST_Request $request Request object.
     *
     * @return mixed
     */
    public function prepare_item_for_response($item, $request)
    {
        $data = array( );
        return $item;
    }


    /**
     * Check whether the current user can manage artifact.
     *
     * This only applies to the 'edit' context. For all other contexts, this will simply
     * return true.
     *
     * @param WP_REST_Request $request Full data about the request.
     *
     * @return bool
     */
    public function check_can_manage_artifact($request)
    {
        if ('edit' === $request['context']) {
            return $this->manage_artifact_check($request);
        }

        return true;
    }


    /**
     * Get the route base.
     *
     * @return string
     */
    public function get_base()
    {
        return $this->base;
    }

    /**
     * Check the post_date_gmt or modified_gmt and prepare any post or
     * modified date for single post output.
     *
     * @param string|null $date
     *
     * @return string|null ISO8601/RFC3339 formatted datetime.
     */
    protected function prepare_date_response($date)
    {   
        // Can this function be extended to support 
        // additional date functions
        if ('0000-00-00 00:00:00' === $date) {
            return null;
        }
        
        return mysql_to_rfc3339($date);
    }
}
