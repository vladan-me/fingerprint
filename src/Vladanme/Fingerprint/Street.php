<?php

namespace Vladanme\Fingerprint;

class Street extends BasicFP {
  use StreetTrait;

  public function __construct($string) {
    parent::__construct($string);
  }
}
