<?php

namespace Antoineaugusti\LaravelSentimentAnalysis\Facades;

use Illuminate\Support\Facades\Facade;

class SentimentAnalysis extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sentimentanalysis';
    }
}
