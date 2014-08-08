<?php

/**
 * Communicator Class
 * @author tmay
 * 
 * This class establishes protocals to communicate with the FRED database, FRED api, as well as any other websites necessary to process
 * this data.
 */

class Communicator {
	
	private $proxy;
	private $useragent;
	private $ch;
	
	public function set_proxy() {
		$proxy = "http://resproxy.stlouisfed.org:8080";
	}
	
	public function set_useragent() {
		$useragent = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:24.0) Gecko/20100101 Firefox/24.0";
	}
	
	public function set_curl_handler() {
		$ch = curl_init();
	}
	
	public function get_proxy() {
		return $this->proxy;
	}
	
	public function get_useragent() {
		return $this->useragent;
	}
	
	public function get_curl_handler() {
		return $this->$ch;
	}
			
	public function downloader () {
		
		curl_setopt($this->ch, CURLOPT_URL, $this->request);
		curl_setopt($this->ch, CURLOPT_USERAGENT, get_useragent());
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		if (var_dump(PHP_OS) == grep('/Linux/')) {
			curl_setopt($this->ch, CURLOPT_PROXY, get_proxy());
		}
	} 
	
}

?>