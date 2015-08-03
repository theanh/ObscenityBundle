<?php

namespace Talu\ObscenityBundle\Tests;

$file = __DIR__.'/../vendor/autoload.php';
if (!file_exists($file)) {
    throw new RuntimeException('Install dependencies to run test suite.');
}
$autoload = require_once $file;

require_once __DIR__ . '/../src/Obscenity.php';

use Talu\ObscenityBundle\Obscenity;

class ObscenityTest extends \PHPUnit_Framework_TestCase
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
