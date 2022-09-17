<?php

namespace Sweikenb\Library\FeatureFlags\Provider;

class ChaosMonkeyProviderDeps extends DefaultDepsCacheProvider
{
    /**
     * @param array<string, bool> $flags
     * @param array<string, string[]> $dependencies
     */
    public function __construct(array $flags = [], array $dependencies = [])
    {
        $chaosFlags = [];
        foreach ($flags as $flag => $void) {
            $chaosFlags[$flag] = (bool)mt_rand(0, 1);
        }
        parent::__construct($chaosFlags, $dependencies);
    }
}
