<?php

namespace Sweikenb\Library\FeatureFlags\Provider;

class DefaultDepsCacheProvider extends DefaultProvider
{
    /**
     * @var array<string, bool>|null
     */
    private ?array $depsCache = null;

    /**
     * @inheritDoc
     */
    public function getFlags(): array
    {
        if ($this->depsCache === null) {
            $this->depsCache = parent::getFlags();
        }
        return $this->depsCache;
    }
}
