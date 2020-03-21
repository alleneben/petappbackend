<?php # $Id: ApiCampaign.php 0 1970-01-01 00:00:00Z mkwayisi $

class ApiCampaign {
	private $object;

	/**
	 * Primary constructor.
	 */
	public function __construct($json = null) {
		$this->object = is_object($json) ? $json : new stdClass;
		
		$arr = array();
		if (isset($this->object->Actions))
			foreach ($this->object->Actions as $o)
				$arr[] = new ApiAction($o);
		$this->object->Actions = $arr;
		
		$arr = array();
		if (isset($this->object->MoKeyWords))
			foreach ($this->object->MoKeyWords as $o)
				$arr[] = new ApiMoKeyWord($o);
		$this->object->MoKeyWords = $arr;
	}
	
	/**
	 * Gets accountId.
	 */
	public function getAccountId() {
		return @$this->object->AccountId;
	}
	
	/**
	 * Gets actions.
	 */
	public function getActions() {
		return @$this->object->Actions;
	}
	
	/**
	 * Gets brief.
	 */
	public function getBrief() {
		return @$this->object->Brief;
	}
	
	/**
	 * Gets campaignId.
	 */
	public function getCampaignId() {
		return @$this->object->CampaignId;
	}
	
	/**
	 * Gets dateCreated.
	 */
	public function getDateCreated() {
		return @$this->object->DateCreated;
	}
	
	/**
	 * Gets dateEnded.
	 */
	public function getDateEnded() {
		return @$this->object->DateEnded;
	}
	
	/**
	 * Gets description.
	 */
	public function getDescription() {
		return @$this->object->Description;
	}
	
	/**
	 * Gets enabled.
	 */
	public function getEnabled() {
		return @$this->object->Enabled;
	}
	
	/**
	 * Gets isDefault.
	 */
	public function isDefault() {
		return @$this->object->IsDefault;
	}
	
	/**
	 * Gets moKeyWords.
	 */
	public function getMoKeyWords() {
		return @$this->object->MoKeyWords;
	}
	
	/**
	 * Gets pendingApproval.
	 */
	public function getPendingApproval() {
		return @$this->object->PendingApproval;
	}
	
	/**
	 * Sets brief.
	 */
	public function setBrief($value) {
		if ($value === null || is_string($value)) {
			$this->object->Brief = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
	
	/**
	 * Sets dateCreated.
	 */
	public function setDateCreated($value) {
		if ($value === null || is_string($value)) {
			$this->object->DateCreated = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
	
	/**
	 * Sets dateEnded.
	 */
	public function setDateEnded($value) {
		if ($value === null || is_string($value)) {
			$this->object->DateEnded = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
	
	/**
	 * Sets description.
	 */
	public function setDescription($value) {
		if ($value === null || is_string($value)) {
			$this->object->Description = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
}
