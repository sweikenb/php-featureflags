<?php

use Sweikenb\Library\FeatureFlags\Provider\DefaultProvider;
use Sweikenb\Library\FeatureFlags\Service\FeatureFlagsService;

require __DIR__ . '/../vendor/autoload.php';

$myApplicationFlags = [
    'login' => true,
    'registration' => true,
    'emails' => true,
    'search' => true,
    'captcha' => false,
];

$myFeatureDependencies = [
    'registration' => ['emails', 'captcha'],
    'login' => ['captcha'],
];

$provider = new DefaultProvider($myApplicationFlags, $myFeatureDependencies);
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

$featureFlags->isActive('captcha', function () {
    echo "Captcha is working\n";
});

/*
 * HEADS UP:
 * This will return "Emails are working" and "Search is working" only even though the "login" and "registration" flags
 * are enabled. This is because they depend on the disabled "captcha" flag, so they get disabled themselves too.
 */
