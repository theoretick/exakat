<?php

namespace Test\Classes;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class DynamicConstantCall extends Analyzer {
    /* 1 methods */

    public function testClasses_DynamicConstantCall01()  { $this->generic_test('Classes_DynamicConstantCall.01'); }
}
?>