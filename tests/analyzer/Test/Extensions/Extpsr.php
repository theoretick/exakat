<?php

namespace Test\Extensions;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class Extpsr extends Analyzer {
    /* 1 methods */

    public function testExtensions_Extpsr01()  { $this->generic_test('Extensions/Extpsr.01'); }
}
?>