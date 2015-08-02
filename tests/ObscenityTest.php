<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once Talu\ObscenityBundle\Obscenity;

// require_once __DIR__ . '/../src/Obscenity.php';

class ObscenityTest extends PHPUnit_Framework_TestCase
{
    public function testProfane()
    {
        $ob = new Obscenity();
        $arrTestCases = [
            [null => false],
            ['hell??' => true],
            ['??hell..//' => true],
            ['fuck' => true],
            ['hello' => false]
        ];
        foreach ($arrTestCases as $testCase) {
            foreach($testCase as $key => $val)
            {
                $this->assertEquals($val, $ob->profane($key));
            }
        }
    }
}
