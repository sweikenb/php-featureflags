<?php

namespace Sweikenb\Library\FeatureFlags\Provider;

use Sweikenb\Library\FeatureFlags\Api\DependencyAwareFeatureFlagProviderInterface;

class DefaultProvider implements DependencyAwareFeatureFlagProviderInterface
{
    /**
     * @var array<string, bool>
     */
    private array $flags;

    /**
     * @var array<string, string[]>
     */
    private array $dependencies = [];

    /**
     * @param array<string, bool> $flags
     * @param array<string, string[]> $dependencies
     */
    public function __construct(array $flags = [], array $dependencies = [])
    {
        $this->flags = $flags;
        foreach ($dependencies as $flag => $dependantOf) {
            $this->setFeatureDependencies($flag, $dependantOf);
        }
    }

    /**
     * @inheritDoc
     */
    public function getFlags(): array
    {
        $flags = $this->flags;
        if (!empty($this->dependencies)) {
            // inverse dependency definitions for easier processing
            $inverseDeps = [];
            foreach ($this->dependencies as $flag => $dependencies) {
                foreach ($dependencies as $dependency) {
                    if (!isset($inverseDeps[$dependency])) {
                        $inverseDeps[$dependency] = [];
                    }
                    $inverseDeps[$dependency][] = $flag;
                }
            }

            // resolve the flags based on dependencies until we have no changes left
            do {
                $hadChanges = false;
                foreach ($flags as $flag => $isEnabled) {
                    if (!$isEnabled && isset($inverseDeps[$flag])) {
                        foreach ($inverseDeps[$flag] as $dependantFlag) {
                            if ($flags[$dependantFlag] ?? false) {
                                $flags[$dependantFlag] = false;
                                $hadChanges = true;
                            }
                        }
                    }
                }
            } while ($hadChanges);
        }
        return $flags;
    }

    /**
     * @inheritDoc
     */
    public function setFeatureDependencies(string $flag, array $dependencies): DependencyAwareFeatureFlagProviderInterface
    {
        $this->dependencies[$flag] = $dependencies;
        return $this;
    }
}
