<?php # $Id: ApiTemplate.php 0 1970-01-01 00:00:00Z mkwayisi $

class ApiTemplate {
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
	 * Gets dateCreated.
	 */
	public function getDateCreated() {
		return @$this->object->DateCreated;
	}
	
	/**
	 * Gets id.
	 */
	public function getId() {
		return @$this->object->Id;
	}
	
	/**
	 * Gets name.
	 */
	public function getName() {
		return @$this->object->Name;
	}
	
	/**
	 * Gets text.
	 */
	public function getText() {
		return @$this->object->Text;
	}
	
	/**
	 * Sets name.
	 */
	public function setName($value) {
		if ($value === null || is_string($value)) {
			$this->object->Name = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
	
	/**
	 * Sets text.
	 */
	public function setText($value) {
		if ($value === null || is_string($value)) {
			$this->object->Text = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
}
