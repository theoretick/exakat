<?php

namespace Test\Php;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class NoClassInGlobal extends Analyzer {
    /* 1 methods */

    public function testPhp_NoClassInGlobal01()  { $this->generic_test('Php/NoClassInGlobal.01'); }
}
?>