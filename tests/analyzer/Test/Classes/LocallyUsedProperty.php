<?php

namespace Test\Classes;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class LocallyUsedProperty extends Analyzer {
    /* 7 methods */

    public function testClasses_LocallyUsedProperty01()  { $this->generic_test('Classes_LocallyUsedProperty.01'); }
    public function testClasses_LocallyUsedProperty02()  { $this->generic_test('Classes_LocallyUsedProperty.02'); }
    public function testClasses_LocallyUsedProperty03()  { $this->generic_test('Classes_LocallyUsedProperty.03'); }
    public function testClasses_LocallyUsedProperty04()  { $this->generic_test('Classes/LocallyUsedProperty.04'); }
    public function testClasses_LocallyUsedProperty05()  { $this->generic_test('Classes/LocallyUsedProperty.05'); }
    public function testClasses_LocallyUsedProperty06()  { $this->generic_test('Classes/LocallyUsedProperty.06'); }
    public function testClasses_LocallyUsedProperty07()  { $this->generic_test('Classes/LocallyUsedProperty.07'); }
}
?>