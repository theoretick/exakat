<?php

namespace Test\Php;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class DeclareEncoding extends Analyzer {
    /* 1 methods */

    public function testPhp_DeclareEncoding01()  { $this->generic_test('Php/DeclareEncoding.01'); }
}
?>