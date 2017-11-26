<?php
/**
 * @author ruslan.shv@gmail.com
 */
class DB {
	private $driver;
	private $log;
	private $long_query_time = 0.001;
	private $long_query_alltime = 0.001;

	private $log_slow_queries = 'slow.log';
	private $all_time = 0;
	private $count_queries = 0;
	private $files = array();

	public function __construct($driver, $hostname, $username, $password, $database) {
		if (file_exists(DIR_DATABASE . $driver . '.php')) {
			require_once(VQMod::modCheck(DIR_DATABASE . $driver . '.php'));
		} else {
			exit('Error: Could not load database file ' . $driver . '!');
		}
				
		$this->driver = new $driver($hostname, $username, $password, $database);

		$this->log = new Log($this->log_slow_queries);
	}

	public function __destruct() {
		if ($this->all_time > $this->long_query_alltime) {

		    $sort = array();
		    foreach ($this->files as $file => $data) {
			    $sort[$file] = $data['time'];
		    }
		    array_multisort($this->files, $sort);

		    $this->log->write(str_repeat("-", 20));
		    foreach ($this->files as $file => $data) {			
			    $this->log->write(sprintf ("%05.5f: %d: %s", $data['time'], $data['count'], $file ));
		    }
		}

		$this->log->write(sprintf ("all_time: %05.5f; count_queries: %05d %s", $this->all_time, $this->count_queries, $_SERVER['REQUEST_URI'] ));
	}
		
  	public function query($sql) {
		$time_start = microtime(true);

		$query = $this->driver->query($sql);

		$time_end = microtime(true);
		$time = $time_end - $time_start;

		$this->all_time += $time;
		$this->count_queries ++;
		if ($time >= $this->long_query_time) {
			$this->log->write(sprintf ("%05.5f %s", $time, $sql));
		}

 		$stacktrace = debug_backtrace();
		if (isset($stacktrace[1])) {
			$node = $stacktrace[1];
			$val = $node['file'] . "(" . $node['line'] . ")";

			if (isset($this->files[$val])) {
			    $this->files[$val]['time'] += $time;
			    $this->files[$val]['count']++;
			} else {
			    $this->files[$val] = array('time' => $time, 'count'=>1);
			}
		}

		return $query;
  	}
	
	public function escape($value) {
		return $this->driver->escape($value);
	}
	
  	public function countAffected() {
		return $this->driver->countAffected();
  	}

  	public function getLastId() {
		return $this->driver->getLastId();
  	}	
}
?>