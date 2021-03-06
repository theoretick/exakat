<?php
/*
 * Copyright 2012-2019 Damien Seguy – Exakat SAS <contact(at)exakat.io>
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


namespace Exakat\Analyzer;

use Exakat\Analyzer\Analyzer;
use AutoloadExt;

class Themes {
    private $main   = null;
    private $ext    = null;
    private $extra  = array();

    static private $instanciated = array();

    public function __construct($path, AutoloadExt $ext, array $extra_themes = array()) {
        $this->main  = new ThemesMain($path);
        $this->ext   = new ThemesExt($ext);
        $this->extra = new ThemesExtra($extra_themes);
    }

    public function __destruct() {
        unset($this->main);
        unset($this->ext);
        unset($this->extra);
    }
    
    public function getThemeAnalyzers($theme = null) {
        $main  = $this->main ->getThemeAnalyzers($theme);
        $extra = $this->extra->getThemeAnalyzers($theme);
        $ext   = $this->ext  ->getThemeAnalyzers($theme);
        
        return array_merge($main, $extra, $ext);
    }

    public function getThemeForAnalyzer($analyzer) {
        $main = $this->main->getThemeForAnalyzer($analyzer);
        $extra = $this->extra->getThemeForAnalyzer($analyzer);
        $ext   = $this->ext  ->getThemeForAnalyzer($analyzer);

        return array_merge($main, $extra, $ext);
    }

    public function getThemesForAnalyzer($list = null) {
        $main  = $this->main ->getThemesForAnalyzer($list);
        $extra = $this->extra->getThemesForAnalyzer($list);
        $ext   = $this->ext  ->getThemesForAnalyzer($list);
        
        return array_merge($main, $extra, $ext);
    }

    public function getSeverities() {
        $main = $this->main->getSeverities();
        
        return array_merge($main);
    }

    public function getTimesToFix() {
        $main = $this->main->getTimesToFix();
        
        return array_merge($main);
    }

    public function getFrequences() {
        $main = $this->main->getFrequences();
        
        return array_merge($main);
    }
    
    public function listAllAnalyzer($folder = null) {
        $main = $this->main->listAllAnalyzer($folder);
        $extra = $this->extra->listAllAnalyzer($folder);
        $ext = $this->ext->listAllAnalyzer($folder);
        
        return array_merge($main, $extra, $ext);
    }

    public function listAllThemes($theme = null) {
        $main = $this->main->listAllThemes($theme);
        $extra = $this->extra->listAllThemes($theme);
        $ext = $this->ext->listAllThemes($theme);
        
        return array_merge($main, $extra, $ext);
    }

    public function getClass($name) {
        if ($class = $this->main->getClass($name)) {
            return $class;
        }

        if ($class = $this->extra->getClass($name)) {
            return $class;
        }

        if ($class = $this->ext->getClass($name)) {
            return $class;
        }
        
        return false;
    }

    public function getSuggestionThema($thema) {
        $main  = $this->main->getSuggestionThema($thema);
        $extra = $this->extra->getSuggestionThema($thema);
        $ext   = $this->ext->getSuggestionThema($thema);
        
        return array_merge($main, $extra, $ext);
    }
    
    public function getSuggestionClass($name) {
        $main  = $this->main->getSuggestionClass($name);
        $extra = $this->extra->getSuggestionClass($name);
        $ext   = $this->ext->getSuggestionClass($name);
        
        return array_merge($main, $extra, $ext);
    }

    public static function resetCache() {
        self::$instanciated = array();
    }
    
    public function getInstance($name, $gremlin = null, $config = null) {
        if ($analyzer = $this->getClass($name)) {
            if (!isset(self::$instanciated[$analyzer])) {
                self::$instanciated[$analyzer] = new $analyzer($gremlin, $config);
            }
            return self::$instanciated[$analyzer];
        } else {
            display("No such class as '$name'");
            return null;
        }
    }

}
?>
