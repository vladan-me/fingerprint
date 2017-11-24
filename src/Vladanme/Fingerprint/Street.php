<?php

namespace Vladanme\Fingerprint;

class Street extends Fingerprint {
  use StreetTrait;

  public function __construct($string) {
    parent::__construct($string);
  }
}
