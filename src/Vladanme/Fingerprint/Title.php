<?php

namespace Vladanme\Fingerprint;

class Title extends BasicFP {
 use TitleTrait;

  public function __construct($string) {
    parent::__construct($string);
  }
}
