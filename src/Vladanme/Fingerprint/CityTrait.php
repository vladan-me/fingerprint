<?php

namespace Vladanme\Fingerprint;

trait CityTrait {
  // English stopwords that make sense for city names.
  protected $eng_rem = ['the'];
  protected $add_rem = [];
  protected $add_syn = [
    'st'  => 'saint',
    'ft'  => 'fort',
    'mt'  => 'mount',
    's'   => 'south',
    'n'   => 'north',
    'w'   => 'west',
    'e'   => 'east',
    'bch' => 'beach',
  ];
  protected $add_syn_rem = [

  ];

  protected $all_rem = ['a', 'of', 'on'];
  protected $all_syn = [
    'fls'  => 'falls',
    'hts'  => 'heights',
    'hgts' => 'heights',
    'hls'  => 'hills',
    'vly'  => 'valley',
    'vlg'  => 'village',
    'cty'  => 'city',
    'afb'  => 'air force base',
  ];
}
