Laravel Sentiment Analysis
===============


[![Build Status](https://img.shields.io/travis/AntoineAugusti/laravel-sentiment-analysis/master.svg?style=flat)](https://travis-ci.org/AntoineAugusti/laravel-sentiment-analysis)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-brightgreen.svg?style=flat)](LICENSE.md)
[![Latest Version](https://img.shields.io/github/release/AntoineAugusti/laravel-sentiment-analysis.svg?style=flat)](https://github.com/AntoineAugusti/laravel-sentiment-analysis/releases)
![Packagist](https://img.shields.io/packagist/dt/AntoineAugusti/laravel-sentiment-analysis?style=flat-square)

## Introduction
A Laravel wrapper for [phpInsight](https://github.com/JWHennessey/phpInsight).

## Installation

[PHP](https://php.net) 7.2+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Sentiment Analysis, run the command `composer require antoineaugusti/laravel-sentiment-analysis`.

You can register the SentimentAnalysis facade in the `aliases` key of your `config/app.php` file if you like.

```php
'SentimentAnalysis' => Antoineaugusti\LaravelSentimentAnalysis\SentimentAnalysis::class,
```

#### Looking for a Laravel 5 compatible version?
Checkout the [1.2 version](https://github.com/AntoineAugusti/laravel-sentiment-analysis/releases/tag/v2.2), installable by requiring `"antoineaugusti/laravel-sentiment-analysis": "2.2"`.

#### Looking for a Laravel 4 compatible version?
Checkout the [1.2 version](https://github.com/AntoineAugusti/laravel-sentiment-analysis/releases/tag/v1.2), installable by requiring `"antoineaugusti/laravel-sentiment-analysis": "1.2"`.

## Usage
Sentences can be classified as **negative**, **neutral** or **positive**. The only supported language for the moment is **English**.

## Custom Dictionary
You can provide a custom dictionary by providing the path the folder when you create a new `SentimentAnalysis` object.

`$analysis = new SentimentAnalysis(storage_path('custom_dictionary/'));`

Please look at [the PHPInsight data files](https://github.com/JWHennessey/phpInsight/tree/master/lib/PHPInsight/data) to see how you should name and structure your files.

### SentimentAnalysis::isNegative($sentence)
Returns a boolean telling if the given `$sentence` is classified as negative.

### SentimentAnalysis::isNeutral($sentence)
Returns a boolean telling if the given `$sentence` is classified as neutral.

### SentimentAnalysis::isPositive($sentence)
Returns a boolean telling if the given `$sentence` is classified as positive.

### SentimentAnalysis::decision($sentence)
Get the sentiment of a sentence. Will return `negative`, `neutral` or `positive`

### SentimentAnalysis::score($sentence)
Get the confidence of a decision for a result. The closer to 1, the better!

### SentimentAnalysis::scores($sentence)
Get the score value for each decision. Returns an array. The closer to 1, the better! Return example:

	['negative' => 0.5, 'neutral' => 0.25, 'positive' => 0.25]
