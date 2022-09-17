<?php

namespace Sweikenb\Library\FeatureFlags\Provider;

use Sweikenb\Library\FeatureFlags\Api\FeatureFlagProviderInterface;

/**
 * Simple config-based provider
 */
class SimpleProvider implements FeatureFlagProviderInterface
{
    private array $flags;

    /**
     * @param bool[] $flags
     */
    public function __construct(array $flags = [])
    {
        $this->flags = $flags;
    }

    /**
     * @inheritDoc
     */
    public function getFlags(): array
    {
        return $this->flags;
    }
}
