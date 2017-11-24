<?php

namespace Vladanme\Fingerprint;

class Title extends Fingerprint {
 use TitleTrait;

  public function __construct($string) {
    parent::__construct($string);
  }
}
