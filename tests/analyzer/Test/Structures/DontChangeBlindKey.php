<?php

namespace Test\Structures;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class DontChangeBlindKey extends Analyzer {
    /* 1 methods */

    public function testStructures_DontChangeBlindKey01()  { $this->generic_test('Structures/DontChangeBlindKey.01'); }
}
?>