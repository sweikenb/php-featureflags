<?php

namespace Sweikenb\Library\FeatureFlags\Api;

interface FeatureFlagProviderInterface
{
    /**
     * Returns an associative array with flag-code as key and the status (enabled/disabled) as value.
     *
     * @return array<string, bool>
     */
    public function getFlags(): array;
}
