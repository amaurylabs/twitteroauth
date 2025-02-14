<?php

declare(strict_types=1);

namespace Amaurylabs\TwitterOAuth\Tests;

use PHPUnit\Framework\TestCase;

abstract class AbstractSignatureMethodTest extends TestCase
{
    protected $name;

    /**
     * @return SignatureMethod
     */
    abstract public function getClass();

    abstract protected function signatureDataProvider();

    public function testGetName()
    {
        $this->assertEquals($this->name, $this->getClass()->getName());
    }

    /**
     * @dataProvider signatureDataProvider
     */
    public function testBuildSignature($expected, $request, $consumer, $token)
    {
        $this->assertEquals(
            $expected,
            $this->getClass()->buildSignature($request, $consumer, $token),
        );
    }

    protected function getRequest()
    {
        return $this->getMockBuilder(\Amaurylabs\TwitterOAuth\Request::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function getConsumer(
        $key = null,
        $secret = null,
        $callbackUrl = null,
    ) {
        return $this->getMockBuilder(\Amaurylabs\TwitterOAuth\Consumer::class)
            ->setConstructorArgs([$key, $secret, $callbackUrl])
            ->getMock();
    }

    protected function getToken($key = null, $secret = null)
    {
        return $this->getMockBuilder(\Amaurylabs\TwitterOAuth\Token::class)
            ->setConstructorArgs([$key, $secret])
            ->getMock();
    }
}
