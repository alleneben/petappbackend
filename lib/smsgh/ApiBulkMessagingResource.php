<?php # $Id: ApiBulkMessagingResource.php 0 1970-01-01 00:00:00Z mkwayisi $

class ApiBulkMessagingResource {
	private $apiHost;
	
	/**
	 * Primary constructor.
	 */
	public function __construct(SmsghApi $apiHost) {
		$this->apiHost = $apiHost;
	}
	
	/**
	 * Gets senders by page and pageSize.
	 */
	public function getSenders($page = -1, $pageSize = -1) {
		$uri = "/" . $this->apiHost->getContextPath () . "/senders/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/senders/';
		}
				
		return ApiHelper::getApiList
			($this->apiHost, $uri, $page, $pageSize);
	}
	
	/**
	 * Gets sender by ID.
	 */
	public function getSender($senderId) {
		
		$uri = "/" . $this->apiHost->getContextPath () . "/senders/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/senders/';
		}		
		if (is_numeric($senderId))
			return new ApiSender(ApiHelper::getJson
				($this->apiHost, 'GET', $uri.$senderId));
		throw new Smsgh_ApiException
			("Parameter 'senderId' must of type 'number'");
	}
	
	/**
	 * Creates an object.
	 */
	public function create($object) {
		
		if ($object instanceof ApiSender){
			$uri = "/" . $this->apiHost->getContextPath () . "/senders/";
			if ($this->apiHost->getContextPath () == "") {
				$uri = '/senders/';
			}			
			return new ApiSender(ApiHelper::getJson
				($this->apiHost, 'POST', $uri,
					ApiHelper::toJson($object)));
		}
		if ($object instanceof ApiTemplate){
			$uri = "/" . $this->apiHost->getContextPath () . "/templates/";
			if ($this->apiHost->getContextPath () == "") {
				$uri = '/templates/';
			}			
			return new ApiTemplate(ApiHelper::getJson
				($this->apiHost, 'POST', $uri,
					ApiHelper::toJson($object)));
		}
			
		throw new Smsgh_ApiException('Bad parameterized object type');
	}
	
	/**
	 * Updates object.
	 */
	public function update($object) {
		if ($object instanceof ApiSender){
			$uri = "/" . $this->apiHost->getContextPath () . "/senders/";
			if ($this->apiHost->getContextPath () == "") {
				$uri = '/senders/';
			}
				
			return new ApiSender(ApiHelper::getJson
				($this->apiHost, 'PUT', $uri . $object->getId(),
				ApiHelper::toJson($object)));
		}
			
		if ($object instanceof ApiTemplate){
			$uri = "/" . $this->apiHost->getContextPath () . "/templates/";
			if ($this->apiHost->getContextPath () == "") {
				$uri = '/templates/';
			}
				
			return new ApiTemplate(ApiHelper::getJson
				($this->apiHost, 'PUT', $uri . $object->getId(),
					ApiHelper::toJson($object)));
		}
		throw new Smsgh_ApiException('Bad parameterized object type');
	}
	
	/**
	 * Deletes sender by ID.
	 */
	public function deleteSender($senderId) {
		$uri = "/" . $this->apiHost->getContextPath () . "/senders/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/senders/';
		}
		
		if (is_numeric($senderId))
			ApiHelper::getData
				($this->apiHost, 'DELETE', $uri.$senderId);
		else throw new Smsgh_ApiException
			("Parameter 'senderId' must be of type 'number'");
	}
	
	/**
	 * Gets message templates by page and pageSize.
	 */
	public function getTemplates($page = -1, $pageSize = -1) {
		$uri = "/" . $this->apiHost->getContextPath () . "/templates/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/templates/';
		}
		
		return ApiHelper::getApiList
			($this->apiHost, $uri, $page, $pageSize);
	}
	
	/**
	 * Gets message template by ID.
	 */
	public function getTemplate($templateId) {
		$uri = "/" . $this->apiHost->getContextPath () . "/templates/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/templates/';
		}
		
		if (is_numeric($templateId))
			return new ApiTemplate(ApiHelper::getJson
				($this->apiHost, 'GET', $uri.$templateId));
		throw new Smsgh_ApiException
			("Parameter 'templateId' must be of type 'number'");
	}
	
	/**
	 * Deletes message template by ID.
	 */
	public function deleteTemplate($templateId) {
		$uri = "/" . $this->apiHost->getContextPath () . "/templates/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/templates/';
		}
		
		if (is_numeric($templateId))
			ApiHelper::getData
				($this->apiHost, 'DELETE', $uri.$templateId);
		else throw new Smsgh_ApiException
			("Parameter 'templateId' must be of type 'string'");
	}
}
