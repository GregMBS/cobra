<?php

use PHPUnit\Framework\TestCase;
use Slim\Factory\AppFactory;
use Slim\Psr7\Environment;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ActivateRouteTest extends TestCase
{
    private $app;

    protected function setUp(): void
    {
        // Initialize Slim app
        require __DIR__ . '/../index.php';
        $this->app = $app;
    }

    public function testActivateRouteWithValidData()
    {
        $environment = Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/activate',
        ]);

        $request = Request::createFromEnvironment($environment)
            ->withParsedBody(['data' => 'account1,account2,account3']);

        $response = new Response();

        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Cuentas están activadas', (string) $response->getBody());
    }

    public function testActivateRouteWithNoData()
    {
        $environment = Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/activate',
        ]);

        $request = Request::createFromEnvironment($environment)
            ->withParsedBody([]);

        $response = new Response();

        $response = $this->app->handle($request);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringContainsString('No data provided', (string) $response->getBody());
    }
}
