<?php

namespace Test\Functions;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class HardcodedPasswords extends Analyzer {
    /* 4 methods */

    public function testFunctions_HardcodedPasswords01()  { $this->generic_test('Functions_HardcodedPasswords.01'); }
    public function testFunctions_HardcodedPasswords02()  { $this->generic_test('Functions/HardcodedPasswords.02'); }
    public function testFunctions_HardcodedPasswords03()  { $this->generic_test('Functions/HardcodedPasswords.03'); }
    public function testFunctions_HardcodedPasswords04()  { $this->generic_test('Functions/HardcodedPasswords.04'); }
}
?>