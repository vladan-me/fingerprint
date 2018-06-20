<?php

namespace tests;

use Vladanme\Fingerprint\Fingerprint;
use Vladanme\Fingerprint\FingerprintType;
use Vladanme\Fingerprint\City;
use Vladanme\Fingerprint\Title;
use PHPUnit\Framework\TestCase;

class FingerprintTest extends TestCase
{

    public function testInit()
    {
        $expectedResult = [];

        $class = new FingerprintType();

        $actualResult = $class->getEngRem();

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testProp()
    {
        $expectedResult = ['the'];

        $class = new City();

        $actualResult = $class->getEngRem();

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testSetString()
    {
        $fp = new Fingerprint('Quick brown fox jumps over the lazy dog', new FingerprintType());
        $fp->setString('brown dog fox jumps lazy over quick the');

        $this->assertEquals('brown dog fox jumps lazy over quick the', $fp->fingerprint());
    }

    public function testFingerprintWithNoClean()
    {
        $fp = new Fingerprint('Quick brown fox jumps over the lazy dog', new FingerprintType());
        $fp->setString('brown dog fox jumps lazy over quick the');

        $this->assertEquals('brown dog fox jumps lazy over quick the', $fp->fingerprint(false));
    }

    public function testNgram()
    {
        $fingerPrint = new Fingerprint('Quick#brown fox jumps over the lazy dog', new FingerprintType());
        $this->assertEquals('azbrckdoelerfoheicjukblampnfogovowoxpsqurortsothuiumvewnxjydzy', $fingerPrint->ngram());

        $fingerPrint = new Fingerprint('Quick#brown fox jumps over the lazy dog', new FingerprintType());
        $this->assertEquals('#bQuazbrckdoelerfoheicjuk#lampnfogovowoxpsrortsothuiumvewnxjydzy', $fingerPrint->ngram(false));
    }

    public function testFingerprintBasic()
    {
        $strings = [
          'Quick brown fox jumps over the lazy dog',
          'qUick Brown FOX jumps over lazy dog',
        ];
        $expectedResult = [
          'brown dog fox jumps lazy over quick the',
          'brown dog fox jumps lazy over quick'
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

    public function testFingerprintCity()
    {
        $expectedResult = array_fill(0, 10, 'louis saint');
        $strings = [
          'St Louis',
          'Saint Louis',
          'St. Louis',
          'SAINT LOUIS',
          'St. Louis,',
          'ST LOUIS',
          'Saint louis',
          'St-louis',
          'ST. Louis',
          'St-Louis'
        ];
        $actualResult = [];

        $type = new City();
        foreach ($strings as $string) {
            $fp = new Fingerprint($string, $type);
            $actualResult[] = $fp->fingerprint();
        }
        $this->assertEquals($expectedResult, $actualResult);

        $expectedResult = [];
        $actualResult = [];
        $actualResultWithAllSyn = [];

        $expectedResult = array_fill(0, 10, 'elk grove village');
        $strings = [
          'Elk Grove Vlg',
          'Elk Grove Village',
          'ELK GROVE VILLAGE',
          'ELK GROVE VLG',
          'Elk Grove Vlg.',
          'elk grove village',
          '/Elk Grove Village',
          'Elk Grove village',
          'Elk grove Village',
          'Elk grove village'
        ];

        $type = new City();
        foreach ($strings as $string) {
            $fp = new Fingerprint($string, $type);
            $actualResult[] = $fp->fingerprint();
            // Include all synonyms, here because of 'vlg'.
            $fp->includeAllSyn();
            $actualResultWithAllSyn[] = $fp->fingerprint();
        }
        // Not including all synonyms results in failure.
        $this->assertnotEquals($expectedResult, $actualResult);

        $this->assertEquals($expectedResult, $actualResultWithAllSyn);

    }


    public function testFingerprintTitle()
    {
        $expectedResult = array_fill(0, 16, 'client manager services');
        $strings = [
          'Manager Client Services',
          'Client Services Manager',
          'Client Service Manager',
          'Manager, Client Services',
          'Manager of Client Services',
          'Manager Client Services',
          'Manager , Client Services',
          'Manager-Client Services',
          'Manager Client Service',
          'Manager - Client Services',
          'Manager, Global Client Services',
          'Manager, Client Service',
          'Client Service Manager II',
          'Client Services Manager II',
          'Manager-Client Service',
          'Manager of Client Service'
        ];
        $actualResult = [];
        $actualResultWithSynAndRem = [];

        $type = new Title();
        foreach ($strings as $string) {
            $fp = new Fingerprint($string, $type);
            $actualResult[] = $fp->fingerprint();
            $fp->includeAllSyn();
            $fp->includeAllRem();
            $actualResultWithSynAndRem[] = $fp->fingerprint();

        }
        $this->assertnotEquals($expectedResult, $actualResult);
        $this->assertEquals($expectedResult, $actualResultWithSynAndRem);

    }
}
