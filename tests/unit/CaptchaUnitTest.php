<?php
class CaptchaUnitTest extends PHPUnit_Framework_TestCase {
  function test1PlusOneEquals2() {
    $expected = "1 + One = 2";
    $captcha = new Captcha(1, 1, 1, 1);
    $actual = $captcha->toString();
    $this->assertEquals($expected, $actual);
    assertThat($captcha->getLeftOperand(),  is(equalTo('1')));
    assertThat($captcha->getOperation(),    is(equalTo('+')));
    assertThat($captcha->getRightOperand(), is(equalTo('One')));
    assertThat($captcha->getResult(),       is(equalTo('2')));
  }
}
