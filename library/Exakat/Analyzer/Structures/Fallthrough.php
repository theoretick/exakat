<?php
/*
 * Copyright 2012-2017 Damien Seguy – Exakat Ltd <contact(at)exakat.io>
 * This file is part of Exakat.
 *
 * Exakat is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Exakat is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Exakat.  If not, see <http://www.gnu.org/licenses/>.
 *
 * The latest code can be found at <http://exakat.io/>.
 *
*/

namespace Exakat\Analyzer\Structures;

use Exakat\Analyzer\Analyzer;

class Fallthrough extends Analyzer {
    public function analyze() {
        // switch($x) { case 1 : /* no break but something done */; case 2 }
        $this->atomIs('Switch')
             ->outIs('CASES')
             ->outIs('EXPRESSION')
             ->savePropertyAs('fullcode', 'theCase')
             ->outIs('CODE')
             ->hasOut('EXPRESSION')
             ->noAtomInside(array('Break', 'Continue', 'Return', 'Throw', 'Goto'))
             ->back('first')
             ->outIs('CASES')
             ->outWithRank('EXPRESSION', 'last')
             ->notSamePropertyAs('fullcode', 'theCase')
             ->back('first');
        $this->prepareQuery();
    }
}

?>
