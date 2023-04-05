<?php

declare(strict_types=1);

return [

    // Manage autoload migrations
    'autoload_migrations' => true,

    // Subscriptions Database Tables
    'tables' => [

        'plans' => 'plans',
        'features' => 'features',
        'feature_plan' => 'feature_plan',
        'plan_subscriptions' => 'plan_subscriptions',
        'plan_subscription_usage' => 'plan_subscription_usage',

    ],

    // Subscriptions Models
    'models' => [

        'plan' => \bliveinhack\Subscriptions\Models\Plan::class,
        'feature' => \bliveinhack\Subscriptions\Models\Feature::class,
        'plan_subscription' => \bliveinhack\Subscriptions\Models\PlanSubscription::class,
        'plan_subscription_usage' => \bliveinhack\Subscriptions\Models\PlanSubscriptionUsage::class,

    ],

];
