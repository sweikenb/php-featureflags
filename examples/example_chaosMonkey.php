<?php

use Sweikenb\Library\FeatureFlags\Provider\ChaosMonkeyProviderDeps;
use Sweikenb\Library\FeatureFlags\Service\FeatureFlagsService;

require __DIR__ . '/../vendor/autoload.php';

$myApplicationFlags = [
    'login' => true,
    'registration' => true,
    'emails' => true,
    'search' => false,
];

$provider = new ChaosMonkeyProviderDeps($myApplicationFlags);
$featureFlags = new FeatureFlagsService($provider);

$featureFlags->isActive('login', function () {
    echo "Login is working\n";
});

$featureFlags->isActive('registration', function () {
    echo "Registration is working\n";
});

$featureFlags->isActive('emails', function () {
    echo "Emails are working\n";
});

$featureFlags->isActive('search', function () {
    echo "Search is working\n";
});
