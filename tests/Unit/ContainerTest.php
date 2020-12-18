<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\App;
use Enterprise\Framework\Action\Execution\ActionExecutionServiceFacade;
use Enterprise\Framework\Action\Execution\ActionExecutionService;
use Enterprise\Framework\Action\Execution\ActionExecutionServiceInterface;
use Enterprise\Framework\Action\Execution\ActionExecutionServiceProvider;
use Enterprise\Framework\Action\Resolver\ActionResolverServiceProvider;
use Enterprise\Framework\Database\DatabaseServiceProvider;

use Enterprise\Framework\EnterpriseApplication;

include __DIR__ . "/../../config/controller-actions.php";

class ContainerTest extends TestCase
{
    protected $app;
    
    protected function setUp(): void
    {
        global $controllerActions;
        $this->app = new EnterpriseApplication($controllerActions);
        $this->app->boot();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStoreAndRetrieveStringValue()
    {   
        $dbName = 'testdb';

        $this->app->instance('database.name', $dbName);
        $db_name = $this->app->make('database.name');
        
        $this->assertEquals($dbName, $db_name);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testActionExecutionServiceFacade()
    {   
        Facade::setFacadeApplication($this->app);

        $requestMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['get_method', 'get_param', 'get_params'])
            ->getMock();

        $requestMock->method('get_method')->willReturn('GET');
        $requestMock->method('get_param')
            ->with('code')
            ->willReturn('blitzdocument@gmail.com');
        $requestMock->method('get_params')->willReturn(['code'=> 'blitzdocument@gmail.com']);

        ActionExecutionServiceFacade::execute('userController', $requestMock);
        $this->assertTrue(true);
    }

    /**
     *
     * @return void
     */
    public function testControllerActionGetAll()
    {   
        $actionExecutionService = $this->app->make(ActionExecutionServiceInterface::class);

        $requestMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['get_method', 'get_param', 'get_params'])
            ->getMock();

        $requestMock->method('get_method')->willReturn('GET');
        $requestMock->method('get_param')
            ->with('code')
            ->willReturn('blitzdocument@gmail.com');

        $requestMock->method('get_params')->willReturn([]);

        $result = $actionExecutionService->execute('userController', $requestMock);

        $this->assertTrue(true);
    }


    /**
     *
     * @return void
     */
    public function testControllerActionCreate()
    {   
        $actionExecutionService = $this->app->make(ActionExecutionServiceInterface::class);

        $requestMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['get_method', 'get_body_params'])
            ->getMock();

        $requestMock->method('get_method')->willReturn('POST');
        $requestMock->method('get_body_params')
            ->willReturn([
                'userName' => 'mandrax@gmail.com',
                'password' => 'Netfilter@2019',
                'email' => 'blitzdocument@gmail.com',
            ]);

        $result = $actionExecutionService->execute('userController', $requestMock);

        $this->assertTrue(true);
    }

    /**
     *
     * @return void
     */
    public function testControllerActionUpdate()
    {   
        $actionExecutionService = $this->app->make(ActionExecutionServiceInterface::class);

        $requestMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['get_method', 'get_param', 'get_body_params'])
            ->getMock();

        $requestMock->method('get_method')->willReturn('PUT');

        $requestMock->method('get_param')
            ->with('code')
            ->willReturn('blitzdocument@gmail.com');

        $requestMock->method('get_body_params')
            ->willReturn([
                'userName' => 'mandrax@gmail.com',
                'password' => 'Mandrake@2019',
                'email' => 'blitzdocument@gmail.com',
            ]);

        $result = $actionExecutionService->execute('userController', $requestMock);

        $this->assertTrue(true);
    }

    /**
     *
     * @return void
     */
    public function testControllerActionDelete()
    {   
        $actionExecutionService = $this->app->make(ActionExecutionServiceInterface::class);

        $requestMock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['get_method', 'get_param'])
            ->getMock();

        $requestMock->method('get_method')->willReturn('DELETE');

        $requestMock->method('get_param')
            ->with('code')
            ->willReturn('blitzdocument@gmail.com');

        $result = $actionExecutionService->execute('userController', $requestMock);

        $this->assertTrue(true);
    }
}
