<?php

namespace Vladanme\Fingerprint;

class City extends Fingerprint {
  use CityTrait;

  public function __construct($string) {
    parent::__construct($string);
  }
}
