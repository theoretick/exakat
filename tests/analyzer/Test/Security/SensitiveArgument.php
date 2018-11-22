<?php

namespace Test\Security;

use Test\Analyzer;

include_once './Test/Analyzer.php';

class SensitiveArgument extends Analyzer {
    /* 3 methods */

    public function testSecurity_SensitiveArgument01()  { $this->generic_test('Security_SensitiveArgument.01'); }
    public function testSecurity_SensitiveArgument02()  { $this->generic_test('Security/SensitiveArgument.02'); }
    public function testSecurity_SensitiveArgument03()  { $this->generic_test('Security/SensitiveArgument.03'); }
}
?>