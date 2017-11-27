Fingerprint
===========

[Fingerprint](https://github.com/OpenRefine/OpenRefine/wiki/Clustering-In-Depth#fingerprint) is an algorithm that was developed by Google Refine
(later OpenRefine). The (optional) improvement over original algorithm
 is bolded.

* remove leading and trailing whitespace
* change all characters to their lowercase representation
* remove all punctuation and control characters
* ~~normalize extended western characters to their
 ASCII representation (for example "gödel" → "godel")~~
* **apply synonyms** 
* **apply removals** 
* split the string into whitespace-separated tokens
* sort the tokens and remove duplicates
* join the tokens back together

Transliteration is the slowest part of original algorithm
and if you dealing mostly with English language it is a waste of time.
The original algorithm has limitations because it misses all
synonyms and removals. Synonyms and removals are based on English
language so it has limited appliance in languages other than English.
Consider titles like:

* VP Sales and Marketing
* Vice President Marketing & Sales
* Vice President of Sales and Marketing
* Vice President - Sales and Marketing
...
(+100 more ways to write that title, literally)

Use cases
---------
* Simple and fast clustering of data.
* Standardization and grouping similar values in the database.
* Situations where you have users typing city/company/street/title in so
 many ways and you're slowly dying inside with so many combinations...

Documentation
-------------
Initialize Fingerprint type and pass it as a parameter in Fingerprint.

```php
    $type = new FingerprintType();
    $string1 = 'Quick brown fox jumps over lazy dog';    
    $fp = new Fingerprint($string1, $type);
    $fingerprintResult1 = $fp->fingerprint();
    // Outputs 'brown dog fox jumps lazy over quick'.
    
    $string2 = 'qUick Brown FOX jumps over lazy dog.';
    $fp = new Fingerprint($string2, $type);
    $fingerprintResult2 = $fp->fingerprint();
    // Outputs 'brown dog fox jumps lazy over quick'.
    // Also $fingerpintResult1 == $fingerprintResult2

```

More advanced usage is for specific types, for example:

```php
    $type = new City();
    $string1 = 'Elk Grove Vlg';    
    $fp = new Fingerprint($string1, $type);
    // Include all available synonyms for city type.
    $fp->includeAllSyn();
    $fingerprintResult1 = $fp->fingerprint();
    // Outputs 'elk grove village'.
    
    $string2 = '/Elk Grove Village';
    $fp = new Fingerprint($string2, $type);
    // Include all available synonyms for city type.
    $fp->includeAllSyn();
    $fingerprintResult2 = $fp->fingerprint();
    // Outputs 'elk grove village'.
    // Also $fingerpintResult1 == $fingerprintResult2

```

Please look at tests for common usage.

Synonyms and Removals
-------

They are broken down in two categories, basic synonyms/removals that
have the most common ones and all other possible combinations that can
be heavier for computation. For the fastest usage, you don't need all
synonyms/removals. All of them are handpicked based on a clusters from
large dataset. Of course, there are a lot more but only ones that make
sense are listed.
In some cases there are synonyms and removals in the same time,
for example, for Company type:

'corp' first becomes 'corporation' and then is removed completely.

System Requirements
-------

You need **PHP >= 5.4.0**.

Install
-------

Install `fingerprint` using Composer.

```
$ composer require vladan-me/fingerprint
```

Additional Notes
----------------

There's another package named [fingerprint-elasticsearch](https://github.com/vladan-me/fingerprint-elasticsearch) that fully prepares Elasticsearch
analyzer and filters to use this version of fingerprint algorithm.
This project currently also has ngram implementation that
should likely be separated at some point. 

Contributing
-------

Contributions are welcome and will be fully credited. Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

License
-------

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
