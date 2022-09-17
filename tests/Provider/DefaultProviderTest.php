<?php

namespace Sweikenb\Library\FeatureFlags\Tests\Provider;

use PHPUnit\Framework\TestCase;
use Sweikenb\Library\FeatureFlags\Provider\DefaultProvider;

class DefaultProviderTest extends TestCase
{
    public function testAllEnabled(): void
    {
        $flags = [
            'some' => true,
            'flags' => true,
            'foo' => true,
            'bar' => true,
        ];

        $provider = new DefaultProvider($flags);

        $this->assertEquals($flags, $provider->getFlags());
    }

    public function testAllDisabled(): void
    {
        $flags = [
            'some' => false,
            'flags' => false,
            'foo' => false,
            'bar' => false,
        ];

        $provider = new DefaultProvider($flags);

        $this->assertEquals($flags, $provider->getFlags());
    }

    public function testDisabledDepsCascadeToDependants(): void
    {
        $flags = [
            'some' => true,
            'flags' => true,
            'foo' => true,
            'bar' => false,
        ];

        // "some" > "flags" > "bar" = disabled
        $deps = [
            'some' => ['flags'],
            'flags' => ['bar'],
        ];

        $provider = new DefaultProvider($flags, $deps);

        $this->assertEquals(['some' => false, 'flags' => false, 'foo' => true, 'bar' => false], $provider->getFlags());
    }
}
