<?php

namespace Test\Exceptions;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class MultipleCatch extends Analyzer {
    /* 1 methods */

    public function testExceptions_MultipleCatch01()  { $this->generic_test('Exceptions/MultipleCatch.01'); }
}
?>