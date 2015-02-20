<?php
/*
 * Copyright 2012-2015 Damien Seguy – Exakat Ltd <contact(at)exakat.io>
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


class Config {
    static private $singleton = null;
           private $configFile = array();
           private $commandline = array();
           private $argv = array();
           private $projectConfig = array();
        
           private $options = array();
     
    private function __construct($argv) {
        $this->argv = $argv;
        
        $this->configFile = parse_ini_file(dirname(__DIR__).'/config/config.ini');

        // then read the config from the commandline (if any)
        $this->readCommandline();
        
        // then read the config for the project in its folder
        if (isset($this->commandline['project'])) {
            $this->readProjectConfig($this->commandline['project']);
        } 
        
        // build the actual config. Project overwrite commandline overwrites config, if any.
        $this->options = array_merge($this->configFile, $this->commandline, $this->projectConfig);
    }
    
    static public function factory($argv = array()) {
        if (self::$singleton === null) {
            self::$singleton = new Config($argv);
        }
        
        return self::$singleton;
    }

    public function __isset($name) {
        return isset($this->options[$name]);
    }
    
    public function __get($name) {
        if (isset($this->options[$name])) {
            $return = $this->options[$name];
        } else if ($name == 'mysql_exakat_pdo') {
            $return = 'mysql:host='.$this->options['mysql_host'].';dbname='.$this->options['mysql_exakat_db'];
        } else {
            $return = null;
        }
        
        return $return;
    }
    
    public function __set($name, $value) {
        print "It is not possible to modify configuration $name with value '$value'\n";
    }

    private function readProjectConfig($project) {
        if (!file_exists('./projects/'.$project.'/config.ini')) {
            return null;
        }
        
        $this->projectConfig = parse_ini_file('./projects/'.$project.'/config.ini');
        
        foreach($this->projectConfig as &$value) {
            if (is_array($value) && empty($value[0])) {
                unset($value[0]);
            }
        }
        unset($value);
        
        // check and default values
        $defaults = array( 'ignore_dirs'        => array('tests', 'test', 'Tests'),
                           'other_php_versions' => array('53', '54', '55', '56'));
        
        foreach($defaults as $name => $value) {
            if (!isset($this->projectConfig[$name])) {
                $this->projectConfig[$name] = $value;
            }
        }
        
        return null;
    }

    private function readCommandline() {
        $args = $this->argv;
        unset($args[0]);

        if (empty($args)) {
            return null;
        }
        
        $optionsBoolean = array(
                                 '-v'      => array('verbose',    false),
                                 '-h'      => array('help',       false),
                                 '-r'      => array('recursive',  false),
                                 '-u'      => array('update',     false),
                                 '-D'      => array('delete',     false),
                                 '-l'      => array('lint',       false),
                                 '-json'   => array('json',       false),
                                 '-ss'     => array('ss',         false),
                                 '-sm'     => array('sm',         false),
                                 '-sl'     => array('sl',         false),
                                 '-nodep'  => array('noDependencies', false),
                                 '-norefresh' => array('noRefresh', false),
                                 '-today'  => array('today',      false),
                                 '-none'   => array('none',       false),
                                 '-table'  => array('table',      false),
                                 '-text'   => array('text',       false),
                                 '-o'      => array('output',     false),
                                 '-doctor' => array('doctor',     false),
                                 );

        foreach($optionsBoolean as $key => $config) {
            if (($id = array_search($key, $args)) !== false) {
                $this->commandline[$config[0]] = true;

                unset($args[$id]);
            } else {
                $this->commandline[$config[0]] = $config[1];
            }
        }
                                 
        $optionsValue   = array('-f' => array('filename',    null),
                                '-d' => array('dirname',     null),
                                '-p' => array('project',     'default'),
                                '-P' => array('program',     null),
                                '-R' => array('repository',  false),
                                '-T' => array('thema',       null),
                                '-report' => array('report',     'Premier'),
                                '-format' => array('format',     'Text'),
                                '-file' => array('file',     'report'),
//                                '-q' => array('loader',   'Load\Csv'),
                                 );

        foreach($optionsValue as $key => $config) {
            if ( ($id = array_search($key, $args)) !== false) {
                $this->commandline[$config[0]] = $args[$id + 1];

                unset($args[$id]);
                unset($args[$id + 1]);
            } else {
                $this->commandline[$config[0]] = $config[1];
            }
        }
        
        if (count($args) != 0) {
            print "Found ".count($args)." arguments that are not understood.\n\n\"".join('", "', $args)."\"\n\nIgnoring them all\n";
        }
    }
}

?>
