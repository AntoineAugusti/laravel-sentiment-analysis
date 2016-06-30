<?php

use Antoineaugusti\LaravelSentimentAnalysis\SentimentAnalysis;

class SentimentAnalysisTest extends PHPUnit_Framework_TestCase
{
    public $sentiment;

    public function setUp()
    {
        parent::setUp();

        $this->sentiment = new SentimentAnalysis();
    }

    public function testIsPositive()
    {
        $this->assertEquals(true, $this->sentiment->isPositive('Marie was enthusiastic about the upcoming trip. Her brother was also passionate about her leaving - he would finally have the house for himself.'));
        $this->assertEquals(true, $this->sentiment->isPositive('He is very talented'));
    }

    public function testIsNeutral()
    {
        $this->assertEquals(true, $this->sentiment->isNeutral('His skills are mediocre'));
        $this->assertEquals(true, $this->sentiment->isNeutral('She is seemingly very agressive'));
    }

    public function testIsNegative()
    {
        $this->assertEquals(true, $this->sentiment->isNegative('Weather today is rubbish'));
    }

    public function testDecision()
    {
        // Positive
        $this->assertEquals('positive', $this->sentiment->decision('Marie was enthusiastic about the upcoming trip. Her brother was also passionate about her leaving - he would finally have the house for himself.'));
        $this->assertEquals('positive', $this->sentiment->decision('He is very talented'));

        // Neutral
        $this->assertEquals('neutral', $this->sentiment->decision('His skills are mediocre'));
        $this->assertEquals('neutral', $this->sentiment->decision('She is seemingly very agressive'));

        // Negative
        $this->assertEquals('negative', $this->sentiment->decision('Weather today is rubbish'));
    }

    public function testScores()
    {
        $this->assertEquals(['negative' => 0.5, 'neutral' => 0.25, 'positive' => 0.25], $this->sentiment->scores('Weather today is rubbish'));
        $this->assertEquals(['negative' => 0.33, 'neutral' => 0.33, 'positive' => 0.33], $this->sentiment->scores('To be or not to be?'));
    }

    public function testScore()
    {
        $this->assertEquals(0.5, $this->sentiment->score('Weather today is rubbish'));
        $this->assertEquals(0.33, $this->sentiment->score('To be or not to be?'));
        $this->assertEquals(0.57, $this->sentiment->score('Marie was enthusiastic about the upcoming trip. Her brother was also passionate about her leaving - he would finally have the house for himself.'));
    }
}
