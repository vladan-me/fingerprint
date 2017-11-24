<?php

namespace Vladanme\Fingerprint;

class Fingerprint {
  // Core stuff.
  public $string;
  public $fingerprint = '';
  public $ngram = '';

  protected $syn = [];
  protected $syn_rem = [];
  protected $rem = [];

  // Properties to inherit and replace.
  /**
   * A list of english stopwords.
   *
   * @var array
   */
  protected $eng_rem = [];

  /**
   * Additional class specific synonyms/removals and synonym=>removal arrays.
   *
   * @var array
   */
  protected $add_syn = [];
  protected $add_rem = [];
  protected $add_syn_rem = [];

  /**
   * All (greedy) class specific synonyms/removals and synonym=>removal arrays.
   *
   * @var array
   */
  protected $all_syn = [];
  protected $all_rem = [];
  protected $all_syn_rem = [];

  public function __construct($string) {
    $this->string = $string;
    $this->rem = array_merge($this->rem, $this->eng_rem, $this->add_rem);
    $this->syn = array_merge($this->syn, $this->add_syn);
    $this->syn_rem = array_merge($this->syn_rem, $this->add_syn_rem);
  }

  public function useDefaultEnglishStopwords() {
    $en_rem = [
      'a',
      'an',
      'and',
      'are',
      'as',
      'at',
      'be',
      'but',
      'by',
      'for',
      'if',
      'in',
      'into',
      'is',
      'it',
      'no',
      'not',
      'of',
      'on',
      'or',
      'such',
      'that',
      'the',
      'their',
      'then',
      'there',
      'these',
      'they',
      'this',
      'to',
      'was',
      'will',
      'with'
    ];
    $this->rem = array_merge($this->rem, $en_rem);
  }

  public function setString($string) {
    $this->string = $string;
  }

  public function includeAllSyn() {
    $this->syn = array_merge($this->syn, $this->all_syn);
  }

  public function includeAllRem() {
    $this->rem = array_merge($this->rem, $this->all_rem);
  }

  public function getAllSynonyms() {
    return array_merge($this->syn, $this->syn_rem);
  }

  public function getAllRemovals() {
    $removals = array_merge($this->syn_rem, $this->rem);
    // Remove keys from this array, there's no need.
    return array_values(array_unique($removals));
  }

  protected function removePunct($string) {
    $string = preg_replace('/([[:punct:]])|([[:cntrl:]])|([[:space:]])/', ' ', $string);
    return $string;
  }

  protected function applySyn($string) {
    if (!empty($this->syn) || !empty($this->syn_rem)) {
      // @todo Needs to be handled better, maybe static array for each class?
      static $syn_from_pattern = [];
      static $syn_to_pattern = [];
      if (empty($syn_from_pattern)) {
        $synonyms = $this->getAllSynonyms();
        foreach ($synonyms as $from => $to) {
          $from = '/\b' . $from . '\b/';
          $syn_from_pattern[] = $from;
          $syn_to_pattern[] = $to;
        }
      }
      $string = preg_replace($syn_from_pattern, $syn_to_pattern, $string);
    }
    return $string;
  }

  public function applyRem($string) {
    if (!empty($this->syn_rem) || !empty($this->rem)) {
      // @todo Needs to be handled better, maybe static array for each class?
      static $rem_pattern = [];
      if (empty($rem_pattern)) {
        $removals = $this->getAllRemovals();
        foreach ($removals as $removal) {
          $rem_pattern[] = '/\b' . $removal . '\b/';
        }
      }
      $string = preg_replace($rem_pattern, '', $string);
    }
    return $string;
  }

  public function clean() {
    $string = $this->string;
    /**
     * Transliteration is also an option to do here, depending on text language,
     * but for English it's not useful and it's only taking additional time to execute.
     */
    // Lower string so we can match easier.
    $string = strtolower($string);

    // Before replacing all punctuation, control and space characters,
    // remove dot so it connects words that was separating.
    // The idea is to have words like U.S.,L.L.C as one word, i.e. US, LLC,
    // so it can be easier identified. Otherwise it would become U S and L L C.
    $string = str_replace('.', '', $string);

    // Remove all punctuation symbols and temporary replace with spaces.
    $string = $this->removePunct($string);

    // Apply synonyms so more matches can be found.
    $string = $this->applySyn($string);

    // Apply removals (stopwords) so it's easier to match.
    $string = $this->applyRem($string);

    // Remove all multiple spaces by creating an array and filtering it.
    $string_array = explode(' ', $string);
    $string_array = array_filter($string_array);

    // Return a clean string to be used for fingerprint/ngram algorithms.
    return $string_array;
  }

  public function fingerprint($clean = TRUE) {
    if ($clean) {
      $fingerprint = $this->clean();
    }
    else {
      $string = $this->string;
      $fingerprint = explode(' ', $string);
    }

    $fingerprint = array_unique($fingerprint);
    sort($fingerprint);
    $fingerprint = implode(' ', $fingerprint);
    $this->fingerprint = $fingerprint;
    return $this->fingerprint;
  }

  public function ngram($clean = TRUE, $size = 2) {
    if ($clean) {
      $this->string = $this->clean();
    }
    $string = $this->string;

    // Remove all blank spaces, basically merge words.
    $string = str_replace(' ', '', $string);

    $len = strlen($string);
    $ngram = [];
    for ($i = 0; $i + $size - 1 < $len; $i++) {
      $ngram[] = substr($string, $i, $size);
    }
    $ngram = array_unique($ngram);
    sort($ngram);
    $ngram = implode('', $ngram);
    $this->ngram = $ngram;
    return $ngram;
  }

  private function test() {
    // Some strings to test:
    // À noite, vovô Kowalsky vê o ímã cair no pé do pingüim   queixoso e vovó põe açúcar no chá de tâmaras do jabuti feliz.
  }
}
