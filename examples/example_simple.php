<?php

use Sweikenb\Library\FeatureFlags\Provider\DefaultProvider;
use Sweikenb\Library\FeatureFlags\Service\FeatureFlagsService;

require __DIR__ . '/../vendor/autoload.php';

/*
 * Define your features as simple array
 */
$myApplicationFlags = [
    'login' => true,
    'registration' => true,
    'emails' => true,
    'search' => false,
];

$defaultPolicy = false;

$provider = new DefaultProvider($myApplicationFlags);
$featureFlags = new FeatureFlagsService($provider, $defaultPolicy);

/*
 * Simple check
 */
if ($featureFlags->isActive('emails')) {
    echo "E-Mails enabled, do something!\n";
}

/*
 * Check with callback
 */
$featureFlags->isActive(
    'search',
    function () {
        echo "Search enabled, do something!\n";
    }
);

/*
 * Unknown flag
 */
if ($featureFlags->isActive('unknown_flag')) {
    echo "Unknown flag enabled, do something!\n";
}
