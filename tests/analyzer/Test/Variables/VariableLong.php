<?php

namespace Test\Variables;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class VariableLong extends Analyzer {
    /* 2 methods */

    public function testVariables_VariableLong01()  { $this->generic_test('Variables_VariableLong.01'); }
    public function testVariables_VariableLong02()  { $this->generic_test('Variables/VariableLong.02'); }
}
?>