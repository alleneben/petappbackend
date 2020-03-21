<?php # $Id: ApiContactsResource.php 0 1970-01-01 00:00:00Z mkwayisi $

class ApiContactsResource {
	private $apiHost;
	
	/**
	 * Primary constructor.
	 */
	public function __construct(SmsghApi $apiHost) {
		$this->apiHost = $apiHost;
	}
	
	/**
	 * Gets contact by ID.
	 */
	public function get($idNumber) {
		$uri = "/" . $this->apiHost->getContextPath () . "/contacts/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/contacts/';
		}
		
		if (!is_numeric($idNumber))
			throw new Smsgh_ApiException
				("Parameter value must be of type 'number'");
		return new ApiContact(ApiHelper::getJson
			($this->apiHost, 'GET', $uri . $idNumber));
	}
	
	/**
	 * Gets contacts by groupId, filter, page and pageSize.
	 */
	public function gets
		($groupId = -1, $filter = null, $page = -1, $pageSize = -1) {
		$uri = "/" . $this->apiHost->getContextPath () . "/contacts/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/contacts/';
		}
		
		if (!is_numeric($groupId))
			throw new Smsgh_ApiException
				("Parameter 'groupId' must be of type 'number'");
		if (!($filter === null || is_string($filter)))
			throw new Smsgh_ApiException
				("Parameter 'filter' must be of type 'string'");
		//$uri = '/v3/contacts';
		if ($groupId > 0)
			$uri .= '?GroupId=' . $groupId;
		if ($filter !== null)
			$uri .= ($groupId > 0 ? '&' : '?') . 'Filter=' . urlencode($filter);
		return ApiHelper::getApiList
			($this->apiHost, $uri, $page, $pageSize, strpos($uri, '&') !== false);
	}
	
	/**
	 * Creates new object.
	 */
	public function create($object) {
		if ($object instanceof ApiContact) {
			$uri = "/" . $this->apiHost->getContextPath () . "/contacts/";
			if ($this->apiHost->getContextPath () == "") {
				$uri = '/contacts/';
			}
				
			return new ApiContact(ApiHelper::getJson
				($this->apiHost, 'POST', $uri,
					ApiHelper::toJson($object)));
		}
		
		else if ($object instanceof ApiContactGroup) {
			$uri = "/" . $this->apiHost->getContextPath () . "/contacts/";
			if ($this->apiHost->getContextPath () == "") {
				$uri = '/contacts/';
			}
				
			return new ApiContactGroup(ApiHelper::getJson
				($this->apiHost, 'POST', $uri.'groups/',
					ApiHelper::toJson($object)));
		}
		
		else throw new Smsgh_ApiException('Bad parameter type');
	}
	
	/**
	 * Updates an object.
	 */
	public function update($object) {
		if ($object instanceof ApiContact) {
			$uri = "/" . $this->apiHost->getContextPath () . "/contacts/";
			if ($this->apiHost->getContextPath () == "") {
				$uri = '/contacts/';
			}
				
			ApiHelper::getData($this->apiHost,
				'PUT', $uri . $object->getContactId(),
					ApiHelper::toJson($object));
		}
		
		else if ($object instanceof ApiContactGroup) {
			$uri = "/" . $this->apiHost->getContextPath () . "/contacts/";
			if ($this->apiHost->getContextPath () == "") {
				$uri = '/contacts/';
			}
				
			ApiHelper::getData($this->apiHost,
				'PUT', $uri.'groups/' . $object->getGroupId(),
					ApiHelper::toJson($object));
		}
		
		else throw new Smsgh_ApiException('Bad parameter type');
	}
	
	/**
	 * Deletes contact by ID.
	 */
	public function deleteContact($contactId) {
		$uri = "/" . $this->apiHost->getContextPath () . "/contacts/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/contacts/';
		}
		
		if (!is_numeric($contactId))
			throw new Smsgh_ApiException
				("Parameter 'contactId' must be of type 'number'");
		ApiHelper::getData($this->apiHost,
			'DELETE', $uri . ($contactId + 0));
	}
	
	/**
	 * Gets contact groups by page and pageSize.
	 */
	public function getGroups($page = -1, $pageSize = -1) {
		$uri = "/" . $this->apiHost->getContextPath () . "/contacts/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/contacts/';
		}
		
		return ApiHelper::getApiList
			($this->apiHost, $uri.'groups/', $page, $pageSize);
	}
	
	/**
	 * Gets contact group by ID.
	 */
	public function getGroup($groupId) {
		$uri = "/" . $this->apiHost->getContextPath () . "/contacts/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/contacts/';
		}
		
		if (is_numeric($groupId)) {
			return new ApiContactGroup(ApiHelper::getJson
				($this->apiHost, 'GET', $uri.'groups/' . ($groupId + 0)));
		}
		throw new Smsgh_ApiException("Parameter value must be of type 'string'");
	}
	
	/**
	 * Deletes contact group by ID.
	 */
	public function deleteGroup($groupId) {
		$uri = "/" . $this->apiHost->getContextPath () . "/contacts/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/contacts/';
		}
		
		if (is_numeric($groupId)) {
			ApiHelper::getData($this->apiHost,
				'DELETE', $uri.'groups/' . ($groupId + 0));
		} else throw new Smsgh_ApiException
			("Parameter value must be of type 'number'");
	}
}
