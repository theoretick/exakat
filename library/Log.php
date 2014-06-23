<?php

class Log {
    private $name = null;
    private $log = null;
    private $begin = 0;
    
    public function __construct($name = null) {
        $this->name = $name;

        $this->log = fopen('log/'.$this->name.'.log', 'w+');
        $this->log($this->name." created on ".date('r'));

        $this->begin = microtime(true);
    }

    public function __destruct() {
        $this->log("Duration : ".number_format(1000 * (microtime(true) - $this->begin), 2, '.', ''));
        $this->log($this->name." closed on ".date('r'));
        
        if (!is_null($this->log)) {
            fclose($this->log);
            unset($this->log);
        } else {
            print "Log already destroyed.";
        }

    }
    
    public function log($message) {
        if (is_null($this->log)) { return true; }
        
        fwrite($this->log, $message."\n");
    }

    public function report($script, $info) {
        $user = 'exakat';
        $pass = 'exakat';
        
        $mysql = new PDO('mysql:host=127.0.0.1;dbname=exakat', $user, $pass);
        if (!$mysql) { return false; }
        
        $values = array('project' => $info['project'],
                        'time' => (microtime(true) - $this->begin) * 1000,
                        );
                        
        $query = "DESCRIBE `$script`";
        $res = $mysql->query($query);
        while($row = $res->fetch()) {
            if (isset($info[$row['Field']])) {
                $values[$row['Field']] = $info[$row['Field']];
            }
        }

        $query = "INSERT INTO `$script` (".join(", ", array_keys($values)).") VALUES ('".join("', '", array_values($values))."')";
        $mysql->query($query);
        
        return true;
    }
}

?>