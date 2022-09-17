<?php

namespace Sweikenb\Library\FeatureFlags\Service;

use Sweikenb\Library\FeatureFlags\Api\FeatureFlagProviderInterface;

/**
 * The actual service that checks the flags status
 */
class FeatureFlagsService
{
    private ?FeatureFlagProviderInterface $provider;
    private bool $defaultPolicy;

    /**
     * @param FeatureFlagProviderInterface|null $provider
     * @param bool $defaultPolicy
     */
    public function __construct(?FeatureFlagProviderInterface $provider = null, bool $defaultPolicy = false)
    {
        $this->defaultPolicy = $defaultPolicy;
        $this->provider = $provider;
    }

    /**
     * Sets/updates the flags provider
     *
     * @param FeatureFlagProviderInterface $provider
     */
    public function setProvider(FeatureFlagProviderInterface $provider): void
    {
        $this->provider = $provider;
    }

    /**
     * Checks if the given flag is active, calls the optional callback if provided a feature is active and returns the
     * status of the flag.
     *
     * @param string $flag
     * @param callable|null $callback
     *
     * @return bool
     */
    public function isActive(string $flag, ?callable $callback = null): bool
    {
        $flags = [];
        if ($this->provider) {
            $flags = $this->provider->getFlags();
        }

        if (isset($flags[$flag])) {
            $isActive = $flags[$flag] === true;
        } else {
            $isActive = $this->defaultPolicy === true;
        }

        if ($isActive && $callback) {
            call_user_func($callback);
        }

        return $isActive;
    }
}
