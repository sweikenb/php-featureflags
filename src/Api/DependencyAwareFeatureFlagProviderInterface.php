<?php

namespace Sweikenb\Library\FeatureFlags\Api;

interface DependencyAwareFeatureFlagProviderInterface extends FeatureFlagProviderInterface
{
    /**
     * @param string $flag The flag that has the defined dependencies
     * @param string[] $dependencies Lif of flags the current flag is dependant of
     *
     * @return $this
     */
    public function setFeatureDependencies(string $flag, array $dependencies): self;
}
