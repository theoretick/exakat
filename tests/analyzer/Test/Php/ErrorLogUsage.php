<?php

namespace Test\Php;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class ErrorLogUsage extends Analyzer {
    /* 1 methods */

    public function testPhp_ErrorLogUsage01()  { $this->generic_test('Php/ErrorLogUsage.01'); }
}
?>