<?php
class Captcha {
  public function getLeftOperand() {
    return "1";
  }

  public function getRightOperand() {
    return "One";
  }

  public function getOperation() {
    return "+";
  }

  public function getResult() {
    return "2";
  }

  public function toString() {
    return "1 + One = 2";
  }
}
