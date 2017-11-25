<?php

namespace tests;

use Vladanme\Fingerprint\Fingerprint;
use Vladanme\Fingerprint\FingerprintType;

class FingerprintTest extends \PHPUnit_Framework_TestCase {

  public function testFingerprintBasic() {
    $expectedResult = [
      'brown dog fox jumps lazy over quick the',
      'brown dog fox jumps lazy over quick'
    ];
    $strings = [
      'Quick brown fox jumps over the lazy dog',
      'qUick Brown FOX jumps over lazy dog',
    ];
    $actualResult = [];

    $type = new FingerprintType();
    foreach ($strings as $string) {
      $fp = new Fingerprint($string, $type);
      $actualResult[] = $fp->fingerprint();
    }

    $this->assertEquals($expectedResult, $actualResult);

    // Include english stopwords.
    $actualResult = [];

    foreach ($strings as $string) {
      $fp = new Fingerprint($string, $type);
      $fp->useDefaultEnglishStopwords();
      $actualResult[] = $fp->fingerprint();
    }

    // In this case, they should be equal.
    $this->assertEquals($actualResult[0], $actualResult[1]);

  }

}
