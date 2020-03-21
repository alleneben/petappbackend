<?php
/**
 * @name ApiTicketResource.php
 * It helps perform all the necessary tasks against the Unity API
 * @since 	09/12/2013
 * @version 1.0
 * @copyright (c) 2013 SMSGH Limited
 * @category API
 */
class ApiTicketResource {
	private $apiHost;
	
	/**
	 * Primary constructor.
	 */
	public function __construct(SmsghApi $apiHost) {
		$this->apiHost = $apiHost;
	}
	
	/**
	 * Get Support Tickets list
	 * 
	 * @param integer $page        	
	 * @param integer $pageSize        	
	 * @return ApiList of ApiTicket
	 * @version 1.0
	 * @author Arsene T. GANDOTE
	 */
	public function getTickets($page = -1, $pageSize = -1) {
		$uri = "/" . $this->apiHost->getContextPath () . "/tickets/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/tickets/';
		}
		
		return ApiHelper::getApiList ( $this->apiHost, $uri, $page, $pageSize );
	}
	
	/**
	 * Get the ticket Id
	 * 
	 * @param integer $ticketId        	
	 * @throws Smsgh_ApiException
	 * @version 1.0
	 * @author Arsene T. GANDOTE
	 */
	public function getTicket($ticketId) {
		$uri = "/" . $this->apiHost->getContextPath () . "/tickets/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/tickets/';
		}
		

		if (is_numeric($ticketId))
			return new ApiTicket(ApiHelper::getJson
					($this->apiHost, 'GET', $uri.$ticketId));
		
		throw new Smsgh_ApiException ( "Parameter 'ticketId' must be of type 'number'" );
	}
	
	/**
	 * Create a Support Ticket
	 * @param ApiTicket $object        	
	 * @return ApiTicket
	 */
	public function create($object) {
		if ($object instanceof ApiTicket) {
			$uri = "/" . $this->apiHost->getContextPath () . "/tickets/";
			if ($this->apiHost->getContextPath () == "") {
				$uri = '/tickets/';
			}
			
			return new ApiTicket ( ApiHelper::getJson ( $this->apiHost, 'POST', $uri, ApiHelper::toJson ( $object ) ) );
		}
		throw new Smsgh_ApiException('Bad parameterized object type');
	}
	
	/**
	 * Reply a Support Ticket
	 * @param integer $ticketId
	 * @param ApiTicketResponse $object
	 * @return ApiTicket
	 */
	public function replyTicket($ticketId, $object){
		$uri = "/" . $this->apiHost->getContextPath () . "/tickets/";
		if ($this->apiHost->getContextPath () == "") {
			$uri = '/tickets/';
		}
		
		if(is_numeric($ticketId) && $object instanceof ApiTicketResponse){
			return new ApiTicket ( ApiHelper::getJson ( $this->apiHost, 'PUT', $uri.$ticketId, ApiHelper::toJson ( $object ) ) );			
		}
	}
}