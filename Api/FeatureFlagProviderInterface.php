<?php

namespace Sweikenb\Library\FeatureFlags\Api;

/**
 * Interface FeatureFlagProviderInterface
 *
 * @api
 */
interface FeatureFlagProviderInterface
{
    /**
     * Returns an associative array with flag-code as key and the status (enabled/disabled) as value.
     *
     * @return bool[]
     */
    public function getFlags(): array;
}