<?php
namespace SCTV;

use PHPUnit\Framework\TestCase;
use Mockery as M;

class BugsnagTest extends \Mockery\Adapter\Phpunit\MockeryTestCase
{
    public function testGetInstance()
    {
        $instance = Bugsnag::getInstance();
        $this->assertTrue($instance instanceof Bugsnag);
    }

    public function testGetClient()
    {
        $client = Bugsnag::getInstance()->getClient();
        $this->assertNull($client);

        $handlerMock = M::mock('alias:Bugsnag\Handler');
        $handlerMock->shouldReceive('register')->times(1);

        $bugsnagClient = M::mock('alias:Bugsnag\Client');
        $bugsnagClient->shouldReceive('make')->times(1)->andReturn('clientMock');

        $client = Bugsnag::getInstance()->createClient('apikey');
        $this->assertEquals('clientMock', $client);
        $this->assertEquals($client, Bugsnag::getInstance()->getClient());
    }
}
