<?php

namespace Antoineaugusti\LaravelSentimentAnalysis;

use PHPInsight\Sentiment;

class SentimentAnalysis
{
    /**
     * @var \PHPInsight\Sentiment
     */
    private $sentiment;

    const NEGATIVE = 'negative';
    const NEUTRAL = 'neutral';
    const POSITIVE = 'positive';

    /**
     * Class constructor.
     *
     * @param bool|string $dataFolder base folder for custom dictionaries
     */
    public function __construct($dataFolder = false)
    {
        $this->sentiment = new Sentiment($dataFolder);
    }

    /**
     * Get the sentiment of a phrase.
     *
     * @param string $string The given sentence
     *
     * @return string Possible values: negative|neutral|positive
     */
    public function decision($string)
    {
        // Do not call functions so that we'll compute only one time
        $dominantClass = $this->sentiment->categorise($string);

        switch ($dominantClass) {
            case 'neg':
                return self::NEGATIVE;

            case 'neu':
                return self::NEUTRAL;

            case 'pos':
                return self::POSITIVE;
        }
    }

    /**
     * Get scores for each decision.
     *
     * @param string $string The original string
     *
     * @return array An array containing keys 'negative', 'neutral' and 'positive' with a float. The closer to 1, the better
     *
     * @example ['negative' => 0.5, 'neutral' => 0.25, 'positive' => 0.25]
     */
    public function scores($string)
    {
        $scores = $this->sentiment->score($string);
        $array = [];

        // The original keys are 'neg' / 'neu' / 'pos'
        // We will remap to 'negative' / 'neutral' / 'positive' and round with 2 digits
        foreach ([self::NEGATIVE, self::NEUTRAL, self::POSITIVE] as $value) {
            $array[$value] = round($scores[substr($value, 0, 3)], 2);
        }

        return $array;
    }

    /**
     * Get the confidence of a decision for a result. The closer to 1, the better.
     *
     * @param string $string The given sentence
     *
     * @return float The confidence of a decision for a result. The close to 1, the better
     */
    public function score($string)
    {
        $scores = $this->scores($string);

        return max($scores);
    }

    /**
     * Tells if a sentence is positive.
     *
     * @param string $string The given sentence
     *
     * @return bool
     */
    public function isPositive($string)
    {
        return $this->decision($string) == self::POSITIVE;
    }

    /**
     * Tells if a sentence is negative.
     *
     * @param string $string The given sentence
     *
     * @return bool
     */
    public function isNegative($string)
    {
        return $this->decision($string) == self::NEGATIVE;
    }

    /**
     * Tells if a sentence is neutral.
     *
     * @param string $string The given sentence
     *
     * @return bool
     */
    public function isNeutral($string)
    {
        return $this->decision($string) == self::NEUTRAL;
    }
}
