<?php

namespace Test\Extensions;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class Exttidy extends Analyzer {
    /* 1 methods */

    public function testExtensions_Exttidy01()  { $this->generic_test('Extensions_Exttidy.01'); }
}
?>