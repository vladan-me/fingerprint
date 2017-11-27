<?php

namespace Vladanme\Fingerprint;

class Company extends FingerprintType
{
    // English stopwords that make sense for company names.
    protected $eng_rem = ['and', 'at', 'by', 'for', 'in', 'of', 'on', 'the'];

    protected $add_rem = ['pc', 'llc', 'llp', 'lp', 'plc', 'pllc'];
    protected $add_syn = [
      'acad'   => 'academy',
      'assn'   => 'association',
      'inst'   => 'institute',
      'dept'   => 'department',
      'fed'    => 'federal',
      'assoc'  => 'associates',
      'natl'   => 'national',
      'univ'   => 'university',
      'schl'   => 'school',
      'schls'  => 'schools',
      'supt'   => 'superintedent',
      'dist'   => 'district',
      'ctr'    => 'center',
      'centre' => 'center',
      'mgmt'   => 'management',
      'svc'    => 'service',
      'med'    => 'medical',
      'tech'   => 'technology',
      'co op'  => 'cooperative',
      'mid'    => 'middle',
      'mfg'    => 'manufacturing',
      'ofc'    => 'office',
    ];
    protected $add_syn_rem = [
      'corp' => 'corporation',
      'co'   => 'company',
      'cu'   => 'credit union',
      'intl' => 'international',
      'inc'  => 'incorporated',
      'ltd'  => 'limited',
      'na'   => 'north america',
      'us'   => 'united states',
      'usa'  => 'united states',
    ];
}
