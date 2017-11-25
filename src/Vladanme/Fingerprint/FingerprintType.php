<?php

namespace Vladanme\Fingerprint;


class FingerprintType {
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

  public function getEngRem() {
    return $this->eng_rem;
  }
  public function getAddSyn() {
    return $this->add_syn;
  }
  public function getAddRem() {
    return $this->add_rem;
  }
  public function getAddSynRem() {
    return $this->add_syn_rem;
  }

  public function getAllSyn() {
    return $this->all_syn;
  }
  public function getAllRem() {
    return $this->all_rem;
  }
  public function getAllSynRem() {
    return $this->all_syn_rem;
  }
}
