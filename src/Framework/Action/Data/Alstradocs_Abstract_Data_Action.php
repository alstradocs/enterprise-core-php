<?php

namespace Enterprise\Framework\Action\Data;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Enterprise\Framework\Action\Alstradocs_Abstract_Action;

use Enterprise\Framework\Service\Action\Execution\ActionExecutionException;

abstract class Alstradocs_Abstract_Data_Action extends Alstradocs_Abstract_Action
{
    /**
     * @param data The data object.
     * @return mixed.
     */
    public function do_execute($data)
    {
        try {
            $params = $this->validateData($data);

            $requiredData = $this->fetchRequired($params);
            // Update the status of the Paper
            $updatedData = $this->updateData($params, $requiredData);
            // Record the payment
            $updatedData = $this->updateOtherData($updatedData, $requiredData, $params);

            return $this->prepareReturnData($updatedData, $requiredData, $params);

        } catch (ActionExecutionException $exception) {
            throw $exception;
        } catch (QueryException $exception) {
            throw new ActionExecutionException($exception->getMessage());
        } catch (ModelNotFoundException $exception) {
            throw new ActionExecutionException($exception->getMessage());
        } catch (\Exception $exception) {
            throw new ActionExecutionException($exception->getMessage());
        }
    }

    /**
     *
     * @param data
     */
    abstract protected function validateData($data);

    /**
     *
     * @param data
     */
    abstract protected function fetchRequired($params);

    /**
     *
     * @param params
     * @param requiredData
     */
    abstract protected function updateData($params, $requiredData);

    /**
     *
     * @param updatedData
     * @param requiredData
     * @param params
     */
    abstract protected function updateOtherData($updatedData, $requiredData, $params);

    /**
     *
     * @param updatedData
     * @param requiredData
     * @param params
     */
    abstract protected function prepareReturnData($updatedData, $requiredData, $params);
}
