<?php

namespace Talu\ObscenityBundle;

class Obscenity
{
    /**
     * @var.
     */
    private $blacklist = [];

    public function __construct()
    {
        $this->setDictionary('blacklist');
    }

    /**
     *  Sets the dictionar(y|ies) to use
     *  This can accept a string to a language file path,
     *  or an array of strings to multiple paths.
     *
     *  @param string/array
     *  string
     */
    public function setDictionary($dictionary = 'blacklist')
    {
        $badwords = [];

        if (file_exists(__DIR__.DIRECTORY_SEPARATOR.'dict/international.php')) {
            include __DIR__.DIRECTORY_SEPARATOR.'dict/international.php';
        }

        $this->dictionary = $dictionary;

        if (is_array($this->dictionary)) {
            for ($x = 0; $x < count($this->dictionary); ++$x) {
                if (file_exists(__DIR__.DIRECTORY_SEPARATOR.'dict/'.$this->dictionary[$x].'.php')) {
                    include __DIR__.DIRECTORY_SEPARATOR.'dict/'.$this->dictionary[$x].'.php';
                }
            }
        } elseif (is_string($this->dictionary)) {
            if (file_exists(__DIR__.DIRECTORY_SEPARATOR.'dict/'.$this->dictionary.'.php')) {
                include __DIR__.DIRECTORY_SEPARATOR.'dict/'.$this->dictionary.'.php';
            }
        }
        $this->blacklist = $badwords;

        return $this->blacklist;
    }

    /**
     *  Test word by badword.
     *
     *  @param string $text String to be profaned.
     *  bool
     */
    public function profane($text)
    {
        foreach ($this->blacklist as $foul) {
            if (preg_match("/\b$foul\b/i", $text)) {
                return true;
            }
        }

        return false;
    }
}
