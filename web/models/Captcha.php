<?php
class Captcha {
  private $NUMBER_OPERATOR_TEXT = 1; 
  private $TEXT_OPERATOR_NUMBER = 2;
  private $captchaString = array(1=>"One", 2=>"Two");

  public function __construct($pattern, $leftOperand, $operator, $rightOperand) {
    $this->pattern = $pattern;
    $this->leftOperand = $leftOperand;
    $this->operator = $operator;
    $this->rightOperand = $rightOperand;
  }

  public function getLeftOperand() {
    if($this->pattern == $this->TEXT_OPERATOR_NUMBER) return $this->captchaString[$this->leftOperand]; 
    return $this->leftOperand;
  }

  public function getRightOperand() {
    if($this->pattern == $this->TEXT_OPERATOR_NUMBER) return $this->rightOperand;
    return $this->captchaString[$this->rightOperand];
  }

  public function getOperation() {
    return "+";
  }

  public function getResult() {
    return $this->leftOperand+$this->rightOperand;
  }

  public function toString() {
    return $this->getLeftOperand()." + ".$this->getRightOperand()." = ".$this->getResult();
  }
}
