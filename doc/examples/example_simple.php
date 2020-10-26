<?php

use Sweikenb\Library\FeatureFlags\Provider\SimpleProvider;
use Sweikenb\Library\FeatureFlags\Service\FetureFlagsService;

require __DIR__ . '/../../vendor/autoload.php';

/*
 * Define your featurs as simple array
 */
$myApplicationFlags = [
    'login' => true,
    'registation' => true,
    'emails' => true,
    'search' => false,
];

/*
 * Initialize the service
 */
$provider = new SimpleProvider($myApplicationFlags);
$featureFlags = new FetureFlagsService($provider);

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
