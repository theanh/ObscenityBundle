<?php

namespace Talu\ObscenityBundle;

class Obscenity
{
    private $blacklist = [];
    private $whitelist = [];

    public function __construct() {
		// $this->replacer = '*';
		// $this->setDictionary('en-us');
	}

	/**
	 *  Sets the dictionar(y|ies) to use
	 *  This can accept a string to a language file path,
	 *  or an array of strings to multiple paths
	 *
	 *  @param		string/array
	 *  string
	 */
	public function setDictionary($dictionary = 'blacklist') {
        $badwords = array();

        if (file_exists(__DIR__ . DIRECTORY_SEPARATOR .'dict/international.php')) {
            include(__DIR__ . DIRECTORY_SEPARATOR .'dict/international.php');
        } else {
            // if the file isn't in the dict directory,
            // it's probably a custom user library
            include('international.php');
        }

		$this->dictionary = $dictionary;

		if (is_array($this->dictionary)) {
			for ($x=0; $x < count($this->dictionary); $x++) {
				if (file_exists(__DIR__ . DIRECTORY_SEPARATOR .'dict/'.$this->dictionary[$x].'.php')) {
					include(__DIR__ . DIRECTORY_SEPARATOR .'dict/'.$this->dictionary[$x].'.php');
				} else {
					// if the file isn't in the dict directory,
					// it's probably a custom user library
					include($this->dictionary[$x]);
				}

			}

		// just a single string, not an array
		} elseif (is_string($this->dictionary)) {
			if (file_exists(__DIR__ . DIRECTORY_SEPARATOR .'dict/'.$this->dictionary.'.php')) {
				include(__DIR__ . DIRECTORY_SEPARATOR .'dict/'.$this->dictionary.'.php');
			} else {
				include($this->dictionary);
			}
		}
		$this->blacklist = $badwords;

        return $this->blacklist;
	}

	/**
	 *  Test word by badword.
	 *  @param string $text String to be profaned.
	 *  bool
	 */
    public function profane($text){
        // if($text.length() < )3
        //     return false;

        foreach($this->blacklist as $foul){
            if(preg_match('/\b'.$foul.'\b/i', $text))
                return true;
        }

        return false;
    }
}

$ob = new Obscenity();
print_r($ob->setDictionary());
