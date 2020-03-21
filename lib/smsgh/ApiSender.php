<?php # $Id: ApiSender.php 0 1970-01-01 00:00:00Z mkwayisi $

class ApiSender {
	private $object;
	
	/**
	 * Primary constructor.
	 */
	public function __construct($json = null) {
		$this->object = is_object($json) ? $json : new stdClass;
	}
	
	/**
	 * Gets accountId.
	 */
	public function getAccountId() {
		return @$this->object->AccountId;
	}
	
	/**
	 * Gets address.
	 */
	public function getAddress() {
		return @$this->object->Address;
	}
	
	/**
	 * Gets id.
	 */
	public function getId() {
		return @$this->object->Id;
	}
	
	/**
	 * Gets isDeleted.
	 */
	public function isDeleted() {
		return @$this->object->IsDeleted;
	}
	
	/**
	 * Gets timeAdded.
	 */
	public function getTimeAdded() {
		return @$this->object->TimeAdded;
	}
	
	/**
	 * Gets timeDeleted.
	 */
	public function getTimeDeleted() {
		return @$this->object->TimeDeleted;
	}
	
	/**
	 * Sets address.
	 */
	public function setAddress($value) {
		if ($value === null || is_string($value)) {
			$this->object->Address = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
}
