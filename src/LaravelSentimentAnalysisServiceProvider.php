<?php

namespace Antoineaugusti\LaravelSentimentAnalysis;

use Illuminate\Support\ServiceProvider;

class LaravelSentimentAnalysisServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['sentimentanalysis'] = $this->app->singleton('LaravelSentimentAnalysisServiceProvider', function ($app) {
            return new SentimentAnalysis();
        });
    }
}
