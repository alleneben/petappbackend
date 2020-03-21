<?php # $Id: ApiResponse.php 224 2013-08-27 10:25:03Z mkwayisi $

class ApiResponse {
	
	/**
	 * Data fields.
	 */
	private $rawData;
	private $status;
	private $reason;
	private $headers;
	private $body;
	
	/**
	 * Primary constructor.
	 */
	public function __construct() {
		$this->status = 0;
		$this->headers = array();
	}
	
	/**
	 * Gets status.
	 */
	public function getStatus() {
		return $this->status;
	}
	
	/**
	 * Sets status.
	 */
	public function setStatus($value) {
		if (is_int($value)) {
			$this->status = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'int'");
	}
	
	/**
	 * Gets reason.
	 */
	public function getReason() {
		return $this->reason;
	}
	
	/**
	 * Sets reason.
	 */
	public function setReason($value) {
		if (is_string($value)) {
			$this->reason = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
	
	/**
	 * Gets rawData.
	 */
	public function getRawData() {
		return $this->rawData;
	}
	
	/**
	 * Sets rawData.
	 */
	public function setRawData($value) {
		if (is_string($value)) {
			$this->rawData = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
	
	/**
	 * Gets header by name.
	 */
	public function getHeader($name) {
		if (is_string($name)) {
			$name = strtolower($name);
			return isset($this->headers[$name]) ?
				$this->headers[$name] : null;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
	
	/**
	 * Adds header.
	 */
	public function addHeader($name, $value) {
		if (is_string($name) && is_string($value)) {
			$name = strtolower($name);
			$this->headers[$name] = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Both parameter values must be of type 'string'");
	}
	
	/**
	 * Gets body.
	 */
	public function getBody() {
		return $this->body;
	}
	
	/**
	 * Sets body.
	 */
	public function setBody($value) {
		if (is_string($value)) {
			$this->body = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
}
