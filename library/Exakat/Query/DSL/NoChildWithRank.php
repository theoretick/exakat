<?php
/*
 * Copyright 2012-2018 Damien Seguy – Exakat Ltd <contact(at)exakat.io>
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


namespace Exakat\Query\DSL;

use Exakat\Query\Query;

class NoChildWithRank extends DSL {
    public function run() {
        list($edgeName, $rank) = func_get_args();
        if (is_int($rank)) {
            return new Command('not( where( __.out('.$this->SorA($edgeName).').has("rank", ***) ) )', array(abs($rank)));
        } else {
            return new Command('not( where( __.out('.$this->SorA($edgeName).').filter{it.get().value("rank") == ***; } ) )', array($rank));
        }
    }
}
?>