<?php namespace Antoineaugusti\LaravelSentimentAnalysis;

use Illuminate\Support\ServiceProvider;

class LaravelSentimentAnalysisServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('antoineaugusti/laravel-sentiment-analysis');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['sentimentanalysis'] = $this->app->share(function($app) {
            return new SentimentAnalysis;
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
