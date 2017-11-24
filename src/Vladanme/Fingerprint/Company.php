<?php

namespace Vladanme\Fingerprint;

class Company extends Fingerprint {
  use CompanyTrait;

  public function __construct($string) {
    parent::__construct($string);
  }

}
