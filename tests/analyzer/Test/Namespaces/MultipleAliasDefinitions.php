<?php

namespace Test\Namespaces;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class MultipleAliasDefinitions extends Analyzer {
    /* 1 methods */

    public function testNamespaces_MultipleAliasDefinitions01()  { $this->generic_test('Namespaces/MultipleAliasDefinitions.01'); }
}
?>