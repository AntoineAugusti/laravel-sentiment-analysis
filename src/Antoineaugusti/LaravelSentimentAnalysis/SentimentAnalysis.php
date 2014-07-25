<?php namespace Antoineaugusti\LaravelSentimentAnalysis;

use PHPInsight\Sentiment;

class SentimentAnalysis {

	private $sentiment;
	const NEGATIVE = 'negative';
	const NEUTRAL  = 'neutral';
	const POSITIVE = 'positive';

	public function __construct()
	{	
		$this->sentiment = new Sentiment();
	}

	/**
	 * Get the sentiment of a phrase
	 * @param  string $string The given sentence
	 * @return string Possible values: negative|neutral|positive
	 */
	public function decision($string)
	{
		// Do not call functions so that we'll compute only one time
		$dominantClass = $this->sentiment->categorise($string);
		
		switch ($dominantClass) {
			case 'neg':
				return self::NEGATIVE;
				break;

			case 'neu':
				return SELF::NEUTRAL;
				break;

			case 'pos':
				return SELF::POSITIVE;
				break;
		}
	}

	/**
	 * Get the confidence of a decision for a result. The closer to 1, the better
	 * @param  string $string The given sentence
	 * @return float The confidence of a decision for a result. The close to 1, the better
	 */
	public function score($string)
	{
		$scores = $this->sentiment->score($string);
		return $scores[$this->sentiment->categorise($string)];
	}

	/**
	 * Tells if a sentence is positive
	 * @param  string $string The given sentence
	 * @return boolean
	 */
	public function isPositive($string)
	{
		return $this->decision($string) == SELF::POSITIVE;
	}

	/**
	 * Tells if a sentence is negative
	 * @param  string $string The given sentence
	 * @return boolean
	 */
	public function isNegative($string)
	{
		return $this->decision($string) == self::NEGATIVE;
	}

	/**
	 * Tells if a sentence is neutral
	 * @param  string $string The given sentence
	 * @return boolean
	 */
	public function isNeutral($string)
	{
		return $this->decision($string) == SELF::NEUTRAL;
	}
}