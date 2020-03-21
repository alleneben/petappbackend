<?php # $Id: SmsghApi.php 0 1970-01-01 00:00:00Z mkwayisi $

class SmsghApi {
	
	/**
	 * Data fields.
	 */
	private $clientId;
	private $clientSecret;
	private $hostname;
	private $port;
	private $https;
	private $timeout;
	private $contextPath;
	private $accountResource;
	private $messagesResource;
	private $contactsResource;
	private $premiumResource;
	private $bulkMessagingResource;
	private $ticketResource;
	
	/**
	 * Primary constructor.
	 */
	public function __construct($clientId = null, $clientSecret = null) {
		$this
			->setHostname('api.smsgh.com')
			->setPort(443)
			->setHttps(true)
			->setTimeout(15)->setContextPath("");
		
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;
		
		$this->accountResource = new ApiAccountResource($this);
		$this->messagesResource = new ApiMessagesResource($this);
		$this->contactsResource = new ApiContactsResource($this);
		$this->premiumResource = new ApiPremiumResource($this);
		$this->bulkMessagingResource = new ApiBulkMessagingResource($this);
		$this->ticketResource = new ApiTicketResource($this);
	}
	
	/**
	 * Gets accountResource.
	 */
	public function getAccount() {
		return $this->accountResource;
	}
	
	/**
	 * Gets messagesResource.
	 */
	public function getMessages() {
		return $this->messagesResource;
	}
	
	/**
	 * Gets contactsResource.
	 */
	public function getContacts() {
		return $this->contactsResource;
	}
	
	/**
	 * Gets premiumResource.
	 */
	public function getPremium() {
		return $this->premiumResource;
	}
	
	/**
	 * Gets bulkMessagingResource.
	 */
	public function getBulkMessaging() {
		return $this->bulkMessagingResource;
	}
	
	/**
	 *  Get ticketResource
	 * @return ApiTicketResource
	 */
	public function getTicketResource(){
		return $this->ticketResource;
	}
	
	/**
	 * Gets clientId.
	 */
	public function getClientId() {
		return $this->clientId;
	}
	
	/**
	 * Gets clientSecret.
	 */
	public function getClientSecret() {
		return $this->clientSecret;
	}
	
	/**
	 * Gets hostname.
	 */
	public function getHostname() {
		return $this->hostname;
	}
	
	/**
	 * Gets port.
	 */
	public function getPort() {
		return $this->port;
	}
	
	/**
	 * Gets https.
	 */
	public function isHttps() {
		return $this->https;
	}
	
	/**
	 * Gets timeout.
	 */
	public function getTimeout() {
		return $this->timeout;
	}
	
	/**
	 * Sets clientId.
	 */
	public function setClientId($value) {
		if (is_string($value)) {
			$this->clientId = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
	
	/**
	 * Sets clientSecret.
	 */
	public function setClientSecret($value) {
		if (is_string($value)) {
			$this->clientSecret = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
	
	/**
	 * Sets hostname.
	 */
	public function setHostname($value) {
		if (is_string($value)) {
			$this->hostname = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'string'");
	}
	
	/**
	 * Sets port.
	 */
	public function setPort($value) {
		if (is_int($value)) {
			$this->port = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'int'");
	}
	
	/**
	 * Sets https.
	 */
	public function setHttps($value) {
		if (is_bool($value)) {
			$this->https = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'bool'");
	}
	
	/**
	 * Sets timeout.
	 */
	public function setTimeout($value) {
		if (is_int($value)) {
			$this->timeout = $value;
			return $this;
		}
		throw new Smsgh_ApiException
			("Parameter value must be of type 'int'");
	}
	
	/**
	 * Set the context path
	 * @param string $value
	 * @throws Smsgh_ApiException
	 * @return SmsghApi
	 */
	public function setContextPath($value){
		if(is_string($value)){
			$this->contextPath = $value;
			return $this;
		}
		throw new Smsgh_ApiException
		("Parameter value must be of type 'string'");		
	}
	
	public function getContextPath(){
		return $this->contextPath;
	}
}
