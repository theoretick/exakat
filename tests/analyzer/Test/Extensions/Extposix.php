<?php

namespace Test\Extensions;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class Extposix extends Analyzer {
    /* 1 methods */

    public function testExtensions_Extposix01()  { $this->generic_test('Extensions_Extposix.01'); }
}
?>