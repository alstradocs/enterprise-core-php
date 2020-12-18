<?php

namespace Enterprise\Framework\Endpoint;

use Illuminate\Container\Container;

use Enterprise\Framework\Action\MethodNotSupportException;
use Enterprise\Framework\Database\DatabaseServiceInterface;

/**
 * A controller action.
 *
 * @author Edward Banfa
 */
abstract class AbstractWP_REST_RequestControllerAction implements ControllerActionInterface {

    protected static $CODE_PARAM = 'code';
    /**
     *
	 * @param request The request object.
	 * @return WP_REST_Response.
     */
    public function execute($request) {
        if($request->get_method() === 'GET') {
            return $this->executeGet($request);
        }
        elseif($request->get_method() === 'POST') {
            return $this->executePost($request);
        }
        elseif($request->get_method() === 'PUT') {
            $code = $request->get_param(AbstractWP_REST_RequestControllerAction::$CODE_PARAM);
            return $this->executePut($code, $request);
        }
        elseif($request->get_method() === 'DELETE') {
            $code = $request->get_param(AbstractWP_REST_RequestControllerAction::$CODE_PARAM);
            return $this->executeDelete($code, $request);
        }
        elseif($request->get_method() === 'HEAD') {
            return $this->executeHead($request);
        }
        else {
            return $this->methodNotSupported($request);
        }
    }

    /**
     *
	 * @param request The request object.
	 * @return WP_REST_Response.
     */
    protected function executeGet($request) {
        if(array_key_exists(AbstractWP_REST_RequestControllerAction::$CODE_PARAM, $request->get_params())) {

            $code = $request->get_param(AbstractWP_REST_RequestControllerAction::$CODE_PARAM);
            return $this->executeGetSingle($code, $request);

        } else {

            return $this->executeGetAll($request);

        }
    }

    /**
     *
	 * @param request The request object.
	 * @return WP_REST_Response.
     */
    protected function executeGetSingle($code, $request) {
        $this->methodNotSupported($request);
    }

    /**
     *
	 * @param request The request object.
	 * @return WP_REST_Response.
     */
    protected function executeGetAll($request) {
        $this->methodNotSupported($request);
    }

    /**
     *
	 * @param request The request object.
	 * @return WP_REST_Response.
     */
    protected function executePost($request) {
        $this->methodNotSupported($request);
    }

    /**
     *
	 * @param request The request object.
	 * @return WP_REST_Response.
     */
    protected function executePut($code, $request) {
        $this->methodNotSupported($request);
    }

    protected function executeDelete($code, $request) {
        $this->methodNotSupported($request);
    }

    /**
     *
	 * @param request The request object.
	 * @return WP_REST_Response.
     */
    protected function executeHead($request) {
        $this->methodNotSupported($request);
    }

    protected function methodNotSupported($request) {
        throw new MethodNotSupportException('HTTP Method not supported');
    }
}
