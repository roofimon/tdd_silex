<?php
class CaptchaUnitTest extends PHPUnit_Framework_TestCase {
  function testFirstPattern1PlusOneEquals2() {
    $expected = "1 + One = 2";
    $captcha = new Captcha(1, 1, 1, 1);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('1')));
    assertThat($captcha->getOperation(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('One')));
    assertThat($captcha->getResult(),       is(equalTo('2')));
  }

  function testSecondPatternOnePlus1Equals2() {
    $expected = "One + 1 = 2";
    $captcha = new Captcha(2, 1, 1, 1);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('One')));
    assertThat($captcha->getOperation(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('1')));
    assertThat($captcha->getResult(),       is(equalTo('2')));
  }

  function testSecondPatternOnePlus2Equals3() {
    $expected = "One + 2 = 3";
    $captcha = new Captcha(2, 1, 1, 2);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('One')));
    assertThat($captcha->getOperation(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('2')));
    assertThat($captcha->getResult(),       is(equalTo('3')));
  }
}
