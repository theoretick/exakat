<?php

namespace Test\Classes;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class PropertyUsedInOneMethodOnly extends Analyzer {
    /* 2 methods */

    public function testClasses_PropertyUsedInOneMethodOnly01()  { $this->generic_test('Classes/PropertyUsedInOneMethodOnly.01'); }
    public function testClasses_PropertyUsedInOneMethodOnly02()  { $this->generic_test('Classes/PropertyUsedInOneMethodOnly.02'); }
}
?>