<?php

namespace Vladanme\Fingerprint;

trait StreetTrait {
  // English stopwords that make sense for street names.
  protected $eng_rem = [];
  protected $add_rem = [];
  protected $add_syn = [
    'ste'    => 'suite',
    'rd'     => 'road',
    'st'     => 'street',
    'ave'    => 'avenue',
    'dr'     => 'drive',
    'blvd'   => 'boulevard',
    'pkwy'   => 'parkway',
    'hwy'    => 'highway',
    'cir'    => 'circle',
    'ln'     => 'lane',
    'sq'     => 'square',
    'n'      => 'north',
    'w'      => 'west',
    's'      => 'south',
    'e'      => 'east',
    'nw'     => 'northwest',
    'sw'     => 'southwest',
    'ne'     => 'northeast',
    'se'     => 'southeast',
    'c'      => 'center',
    'ctr'    => 'center',
    'centre' => 'center',
    'ct'     => 'court',
    'pl'     => 'place',
    'fl'     => 'floor',
    'plz'    => 'plaza',
    'p o'    => 'po',
    'expy'   => 'expressway',
    'ext'    => 'extension',
    'fwy'    => 'freeway',
    'ter'    => 'terrace',
    'trl'    => 'trail',
    'tpke'   => 'turnpike',
  ];

  protected $add_syn_rem = [];

  protected $all_rem = [];
  protected $all_syn = [
    'boul'  => 'boulevard',
    'av'    => 'ave',
    'aven'  => 'ave',
    'avenu' => 'ave',
    'hts'   => 'heights',
    'vly'   => 'valley',
    'vlg'   => 'village',
    'cty'   => 'city',
    'afb'   => 'air force base',
    'ft'    => 'fort',
    'mt'    => 'mount',
    'aly'   => 'alley',
    'anx'   => 'annex',
    'arc'   => 'arcade',
    'bch'   => 'beach',
    'bnd'   => 'bend',
    'byp'   => 'bypass',
    'cyn'   => 'canyon',
    'cmn'   => 'common',
    'cor'   => 'corner',
    'cv'    => 'cove',
    'crk'   => 'creek',
    'cres'  => 'crescent',
    'xing'  => 'crossing',
    'fry'   => 'ferry',
    'gtwy'  => 'gateway',
    'grn'   => 'green',
    'hl'    => 'hill',
    'ky'    => 'kye',
    'lk'    => 'lake',
    'lndg'  => 'landing',
    'pt'    => 'point',
    'rdg'   => 'ridge',
    'rte'   => 'route',
    'sta'   => 'station',
    'trce'  => 'trace',
    'via'   => 'viaduct',
    'vw'    => 'view',
    'vis'   => 'vista',
  ];

}