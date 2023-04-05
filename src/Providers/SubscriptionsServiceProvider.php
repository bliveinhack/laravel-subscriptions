<?php

declare(strict_types=1);

namespace bliveinhack\Subscriptions\Providers;

use bliveinhack\Subscriptions\Models\Plan;
use Illuminate\Support\ServiceProvider;
use bliveinhack\Support\Traits\ConsoleTools;
use bliveinhack\Subscriptions\Models\Feature;
use bliveinhack\Subscriptions\Models\PlanSubscription;
use bliveinhack\Subscriptions\Models\PlanSubscriptionUsage;
use bliveinhack\Subscriptions\Console\Commands\MigrateCommand;
use bliveinhack\Subscriptions\Console\Commands\PublishCommand;
use bliveinhack\Subscriptions\Console\Commands\RollbackCommand;

class SubscriptionsServiceProvider extends ServiceProvider
{
    use ConsoleTools;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        MigrateCommand::class => 'command.bliveinhack.subscriptions.migrate',
        PublishCommand::class => 'command.bliveinhack.subscriptions.publish',
        RollbackCommand::class => 'command.bliveinhack.subscriptions.rollback',
    ];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(realpath(__DIR__.'/../../config/config.php'), 'bliveinhack.subscriptions');

        // Bind eloquent models to IoC container
        $this->registerModels([
            'bliveinhack.subscriptions.plan' => Plan::class,
            'bliveinhack.subscriptions.plan_feature' => Feature::class,
            'bliveinhack.subscriptions.plan_subscription' => PlanSubscription::class,
            'bliveinhack.subscriptions.plan_subscription_usage' => PlanSubscriptionUsage::class,
        ]);

        // Register console commands
        $this->registerCommands($this->commands);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publish Resources
        $this->publishesConfig('bliveinhack/laravel-subscriptions');
        $this->publishesMigrations('bliveinhack/laravel-subscriptions');
        ! $this->autoloadMigrations('bliveinhack/laravel-subscriptions') || $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
}
