<?php 
# $Id: SmsghApi.php 0 1970-01-01 00:00:00Z mkwayisi $

class ApiAccountResource {
	/**
	 * Data fields.
	 */
	private $apiHost;
	
	/**
	 * Primary constructor.
	 */
	public function __construct(SmsghApi $apiHost) {
		$this->apiHost = $apiHost;
	}
	
	/**
	 * Gets account profile.
	 */
	public function getProfile() {
		$uri = "/" . $this->apiHost->getContextPath () . "/account/profile";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/account/profile';
		}
		
		return new ApiAccountProfile ( ApiHelper::getJson ( $this->apiHost, "GET", $uri ) );
	}
	
	/**
	 * Gets primary contact.
	 */
	public function getPrimaryContact() {
		$uri = "/" . $this->apiHost->getContextPath () . "/account/primary_contact";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/account/primary_contact';
		}
		return new ApiAccountContact ( ApiHelper::getJson ( $this->apiHost, "GET", $uri ) );
	}
	
	/**
	 * Gets billing contact.
	 */
	public function getBillingContact() {
		$uri = "/" . $this->apiHost->getContextPath () . "/account/billing_contact";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/account/billing_contact';
		}
		return new ApiAccountContact ( ApiHelper::getJson ( $this->apiHost, "GET", $uri ) );
	}
	
	/**
	 * Gets technical contact.
	 */
	public function getTechnicalContact() {
		$uri = "/" . $this->apiHost->getContextPath () . "/account/technical_contact";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/account/technical_contact';
		}
		return new ApiAccountContact ( ApiHelper::getJson ( $this->apiHost, "GET", $uri ) );
	}
	
	/**
	 * Gets all account contacts
	 */
	public function getContacts() {
		$uri = "/" . $this->apiHost->getContextPath () . "/account/contacts";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/account/contacts';
		}
		$contacts = array ();
		$json = ApiHelper::getJson ( $this->apiHost, "GET", $uri );
		if (is_array ( $json ))
			foreach ( $json as $contact )
				$contacts [] = new ApiAccountContact ( $contact );
		return $contacts;
	}
	
	/**
	 * Updates an object.
	 */
	public function update($object) {
		if ($object == null)
			throw new Smsgh_ApiException ( "Parameter 'object' cannot be null" );
			
			// Account contact.
		if ($object instanceof ApiAccountContact) {
			$uri = "/" . $this->apiHost->getContextPath () . "/account/contacts/";
			if ($this->apiHost->getContextPath () == "") {
				$uri = '/account/contacts/';
			}
			
			ApiHelper::getData ( $this->apiHost, 'PUT', $uri . $object->getAccountContactId (), ApiHelper::toJson ( $object ) );
		} 		

		// Account settings.
		else if ($object instanceof ApiSettings) {
			$uri = "/" . $this->apiHost->getContextPath () . "/account/settings/";
			if ($this->apiHost->getContextPath () == "") {
				$uri = '/account/settings/';
			}
			
			return new ApiSettings ( ApiHelper::getJson ( $this->apiHost, 'PUT', $uri, ApiHelper::toJson ( $object ) ) );
		} 		

		// Unknown.
		else
			throw new Smsgh_ApiException ( 'Bad parameter' );
	}
	
	/**
	 * Gets account services.
	 */
	public function getServices($page = -1, $pageSize = -1) {
		$uri = "/" . $this->apiHost->getContextPath () . "/account/services/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/account/services/';
		}
		
		return ApiHelper::getApiList ( $this->apiHost, $uri, $page, $pageSize );
	}
	
	/**
	 * Gets account settings.
	 */
	public function getSettings() {
		$uri = "/" . $this->apiHost->getContextPath () . "/account/settings/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/account/settings/';
		}
		
		return new ApiSettings ( ApiHelper::getJson ( $this->apiHost, 'GET', $uri ) );
	}
	
	/**
	 * Gets account invoices.
	 */
	public function getInvoices($page = -1, $pageSize = -1) {
		$uri = "/" . $this->apiHost->getContextPath () . "/account/invoices/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/account/invoices/';
		}
		
		return ApiHelper::getApiList ( $this->apiHost, $uri, $page, $pageSize );
	}
}
 
