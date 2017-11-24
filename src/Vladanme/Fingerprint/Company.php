<?php

namespace Vladanme\Fingerprint;

class Company extends BasicFP {
  use CompanyTrait;

  public function __construct($string) {
    parent::__construct($string);
  }

}
