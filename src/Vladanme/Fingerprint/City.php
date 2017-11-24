<?php

namespace Vladanme\Fingerprint;

class City extends BasicFP {
  use CityTrait;

  public function __construct($string) {
    parent::__construct($string);
  }
}
