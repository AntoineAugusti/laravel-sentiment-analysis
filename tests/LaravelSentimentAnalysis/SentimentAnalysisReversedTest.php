<?php

use Antoineaugusti\LaravelSentimentAnalysis\SentimentAnalysis;

class SentimentAnalysisReversedTest extends PHPUnit_Framework_TestCase
{
    public $sentiment;

    public function setUp()
    {
        parent::setUp();

        /*
         * The positive and negative data has been reversed.
         * Neutral/Positive/Ignore are the same.
         */
        $this->sentiment = new SentimentAnalysis(__DIR__.'/reversed/');
    }

    public function testIsPositive()
    {
        $this->assertEquals(false, $this->sentiment->isPositive('Marie was enthusiastic'));
        $this->assertEquals(false, $this->sentiment->isPositive('He is very talented'));
    }

    public function testIsNeutral()
    {
        $this->assertEquals(true, $this->sentiment->isNeutral('His views are not considerable'));
        $this->assertEquals(true, $this->sentiment->isNeutral('She is seemingly very surprising'));
    }

    public function testIsNegative()
    {
        $this->assertEquals(false, $this->sentiment->isNegative('Weather today is rubbish'));
    }

    public function testDecision()
    {
        // Positive
        $this->assertEquals('negative', $this->sentiment->decision('Marie was enthusiastic about the upcoming trip. Her brother was also passionate about her leaving - he would finally have the house for himself.'));
        $this->assertEquals('negative', $this->sentiment->decision('He is really very talented'));

        // Neutral
        $this->assertEquals('neutral', $this->sentiment->decision('His views are not reflecting'));
        $this->assertEquals('neutral', $this->sentiment->decision('She is seemingly very surprising'));

        // Negative
        $this->assertEquals('positive', $this->sentiment->decision('Weather today is very rubbish'));
    }

    public function testScores()
    {
        $this->assertEquals(['negative' => 0.25, 'neutral' => 0.25, 'positive' => 0.5], $this->sentiment->scores('Weather today is very rubbish'));
        $this->assertEquals(['negative' => 0.33, 'neutral' => 0.33, 'positive' => 0.33], $this->sentiment->scores('To be or not to be?'));
    }

    public function testScore()
    {
        $this->assertEquals(0.5, $this->sentiment->score('Weather today is very rubbish'));
        $this->assertEquals(0.33, $this->sentiment->score('To be or not to be?'));
        $this->assertEquals(0.57, $this->sentiment->score('Marie was enthusiastic about the upcoming trip. Her brother was also passionate about her leaving - he would finally have the house for himself.'));
    }
}
