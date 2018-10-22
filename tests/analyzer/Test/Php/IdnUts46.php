<?php

namespace Test\Php;

use Test\Analyzer;

include_once dirname(__DIR__, 4).'/library/Autoload.php';
spl_autoload_register('Autoload::autoload_test');
spl_autoload_register('Autoload::autoload_phpunit');
spl_autoload_register('Autoload::autoload_library');

class IdnUts46 extends Analyzer {
    /* 1 methods */

    public function testPhp_IdnUts4601()  { $this->generic_test('Php/IdnUts46.01'); }
}
?>