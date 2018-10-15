<?php

namespace Tests\Feature;

use App\User;
use \Route;
use Illuminate\Routing\RouteCollection;
use Tests\TestCase;

class AllRoutesTest extends TestCase
{
    protected $admin;

    public function setUp()
    {
        parent::setUp();
        $this->admin = User::whereTipo('admin')->first();
    }

    public function testAllRoute()
    {
        /** @var RouteCollection $routeCollection */
        $routeCollection = Route::getRoutes();
        $this->withoutEvents();
        $blacklist = [
            'url/that/not/tested',
        ];
        $dynamicReg = "/{\\S*}/"; //used for omitting dynamic urls that have {} in uri (http://laravel-tricks.com/tricks/adding-a-sitemap-to-your-laravel-application#comment-1830836789)
        $this->be($this->admin);
        foreach ($routeCollection as $route) {
            if (!preg_match($dynamicReg, $route->uri) &&
                in_array('GET', $route->methods) &&
                !in_array($route->uri, $blacklist)
            ) {
                $start = $this->microtimeFloat();
                fwrite(STDERR, print_r('test ' . $route->uri . "\n", true));
                $response = $this->call('GET', $route->uri);
                $end = $this->microtimeFloat();
                $temps = round($end - $start, 3);
                fwrite(STDERR, print_r('time: ' . $temps . "\n", true));
                $this->assertLessThan(30, $temps, "too long time for " . $route->uri);
                fwrite(STDERR, print_r('status: ' . $response->getStatusCode() . "\n", true));
                if (!in_array($response->getStatusCode(), [200,302])) {
                    $this->assertRegExp('/XLSX/', $response->getContent());
                } else {
                    $this->assertContains($response->getStatusCode(), [200, 302], $route->uri . "failed to load");
                }
            }

        }
    }

    public function microtimeFloat()
    {
        list($usec, $asec) = explode(" ", microtime());

        return ((float)$usec + (float)$asec);

    }
}