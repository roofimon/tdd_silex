<?php
class CaptchaUnitTest extends PHPUnit_Framework_TestCase {
  function testFirstPattern1PlusOneEquals2() {
    $expected = "1 + One = 2";
    $captcha = new Captcha(1, 1, 1, 1);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('1')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('One')));
    assertThat($captcha->getResult(),       is(equalTo('2')));
  }

  function testFirstPattern1PlusNineEquals10() {
    $expected = "1 + Nine = 10";
    $captcha = new Captcha(1, 1, 1, 9);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('1')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('Nine')));
    assertThat($captcha->getResult(),       is(equalTo('10')));
  }

  function testFirstPattern7PlusEightEquals15() {
    $expected = "7 + Eight = 15";
    $captcha = new Captcha(1, 7, 1, 8);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('7')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('Eight')));
    assertThat($captcha->getResult(),       is(equalTo('15')));
  }

  function testFirstPatternNineMultiply9Equals81() {
    $expected = "9 * Nine = 81";
    $captcha = new Captcha(1, 9, 2, 9);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('9')));
    assertThat($captcha->getOperator(),    is(equalTo('*')));
    assertThat($captcha->getRightOperand(), is(equalTo('Nine')));
    assertThat($captcha->getResult(),       is(equalTo('81')));
  }

  function testSecondPatternOnePlus1Equals2() {
    $expected = "One + 1 = 2";
    $captcha = new Captcha(2, 1, 1, 1);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('One')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('1')));
    assertThat($captcha->getResult(),       is(equalTo('2')));
  }

  function testSecondPatternOnePlus2Equals3() {
    $expected = "One + 2 = 3";
    $captcha = new Captcha(2, 1, 1, 2);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('One')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('2')));
    assertThat($captcha->getResult(),       is(equalTo('3')));
  }

  function testSecondPatternNinePlus9Equals18() {
    $expected = "Nine + 9 = 18";
    $captcha = new Captcha(2, 9, 1, 9);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('Nine')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('9')));
    assertThat($captcha->getResult(),       is(equalTo('18')));
  }

  function testSecondPatternNineMultiply9Equals81() {
    $expected = "Nine * 9 = 81";
    $captcha = new Captcha(2, 9, 2, 9);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('Nine')));
    assertThat($captcha->getOperator(),    is(equalTo('*')));
    assertThat($captcha->getRightOperand(), is(equalTo('9')));
    assertThat($captcha->getResult(),       is(equalTo('81')));
  }
}
