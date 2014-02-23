<?php
class CaptchaUnitTest extends PHPUnit_Framework_TestCase {
  function testFirstPattern1PlusOneEquals2() {
    $expected = "1 + One = 2";
    $captcha = new Captcha([
      'pattern' => 1, 'leftOperand' => 1, 'operator' => 1, 'rightOperand' => 1
    ]);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('1')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('One')));
    assertThat($captcha->getResult(),       is(equalTo('2')));
  }
  
  function testFirstPattern1PlusTwoEquals3() {
    $expected = "1 + Two = 3";
    $captcha = new Captcha([
      'pattern' => 1, 'leftOperand' => 1, 'operator' => 1, 'rightOperand' => 2
    ]);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('1')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('Two')));
    assertThat($captcha->getResult(),       is(equalTo('3')));
  }

  function testFirstPattern1PlusNineEquals10() {
    $expected = "1 + Nine = 10";
    $captcha = new Captcha([
      'pattern' => 1, 'leftOperand' => 1, 'operator' => 1, 'rightOperand' => 9
    ]);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('1')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('Nine')));
    assertThat($captcha->getResult(),       is(equalTo('10')));
  }

  function testFirstPattern7PlusEightEquals15() {
    $expected = "7 + Eight = 15";
    $captcha = new Captcha([
      'pattern' => 1, 'leftOperand' => 7, 'operator' => 1, 'rightOperand' => 8      
    ]);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('7')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('Eight')));
    assertThat($captcha->getResult(),       is(equalTo('15')));
  }

  function testFirstPatternNineMultiply9Equals81() {
    $expected = "9 * Nine = 81";
    $captcha = new Captcha([
      'pattern' => 1, 'leftOperand' => 9, 'operator' => 2, 'rightOperand' => 9
    ]);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('9')));
    assertThat($captcha->getOperator(),    is(equalTo('*')));
    assertThat($captcha->getRightOperand(), is(equalTo('Nine')));
    assertThat($captcha->getResult(),       is(equalTo('81')));
  }

  function testSecondPatternOnePlus1Equals2() {
    $expected = "One + 1 = 2";
    $captcha = new Captcha([
      'pattern' => 2, 'leftOperand' => 1, 'operator' => 1, 'rightOperand' => 1
    ]);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('One')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('1')));
    assertThat($captcha->getResult(),       is(equalTo('2')));
  }

  function testSecondPatternOnePlus2Equals3() {
    $expected = "One + 2 = 3";
    $captcha = new Captcha([
      'pattern' => 2, 'leftOperand' => 1, 'operator' => 1, 'rightOperand' => 2
    ]);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('One')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('2')));
    assertThat($captcha->getResult(),       is(equalTo('3')));
  }

  function testSecondPatternNinePlus9Equals18() {
    $expected = "Nine + 9 = 18";
    $captcha = new Captcha([
      'pattern' => 2, 'leftOperand' => 9, 'operator' => 1, 'rightOperand' => 9
    ]);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('Nine')));
    assertThat($captcha->getOperator(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('9')));
    assertThat($captcha->getResult(),       is(equalTo('18')));
  }

  function testSecondPatternNineMultiply9Equals81() {
    $expected = "Nine * 9 = 81";
    $captcha = new Captcha([
      'pattern' => 2, 'leftOperand' => 9, 'operator' => 2, 'rightOperand' => 9
    ]);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('Nine')));
    assertThat($captcha->getOperator(),    is(equalTo('*')));
    assertThat($captcha->getRightOperand(), is(equalTo('9')));
    assertThat($captcha->getResult(),       is(equalTo('81')));
  }
}
