<?php

namespace Sweikenb\Library\FeatureFlags\Provider;

use Sweikenb\Library\FeatureFlags\Api\FeatureFlagProviderInterface;

/**
 * Chaos-Monkey provider which turns on/off provided features randomly.
 */
class ChaosMonkeyProvider extends SimpleProvider implements FeatureFlagProviderInterface
{
    /**
     * @param bool[] $flags
     */
    public function __construct(array $flags = [])
    {
        $chaosFlags = [];
        foreach ($flags as $flag => $void) {
            $chaosFlags[$flag] = (bool)mt_rand(0, 1);
        }
        parent::__construct($chaosFlags);
    }
}