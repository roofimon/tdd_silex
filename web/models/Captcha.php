<?php
class Captcha {
  private $NUMBER_OPERATOR_TEXT = 1; 
  private $TEXT_OPERATOR_NUMBER = 2;
  private $captchaString = [1=>"One", 2=>"Two", 3=>"Three", 4=>"Four", 5=>"Five", 6=>"Six", 7=>"Seven", 8=>"Eight", 9=>"Nine"];
    
  public function __construct($options) {
    $this->pattern = $options['pattern'];
    $this->leftOperand = $options['leftOperand'];
    $this->operator = $options['operator'];
    $this->rightOperand = $options['rightOperand'];
  }
  
  public function getLeftOperand() {
    if ($this->pattern == $this->TEXT_OPERATOR_NUMBER) {
      return $this->captchaString[$this->leftOperand];
    } else {
      return $this->leftOperand;
    }
  }

  public function getRightOperand() {
    if ($this->pattern == $this->TEXT_OPERATOR_NUMBER) {
      return $this->rightOperand;
    } else {
      return $this->captchaString[$this->rightOperand];
    }
  }

  public function getOperator() {
    if ($this->operator == 2) {
      return "*";
    } else {
      return "+";
    }
  }

  public function getResult() {
    if ($this->operator == 2) {
      return $this->leftOperand*$this->rightOperand;
    } else {
      return $this->leftOperand+$this->rightOperand;
    }
  }

  public function toString() {
    $left = $this->getLeftOperand();
    $operator = $this->getOperator();
    $right = $this->getRightOperand();
    $result = $this->getResult();
    return "$left $operator $right = $result";
  }
}
