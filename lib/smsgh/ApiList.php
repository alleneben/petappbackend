<?php # $Id: ApiList.php 0 1970-01-01 00:00:00Z mkwayisi $

class ApiList {
	private $count;
	private $totalPages;
	private $items;
	
	/**
	 * Primary constructor.
	 */
	public function __construct($json) {
		if ($json instanceof stdClass) {
			$this->items = array();
			
			foreach ($json as $name => $value)
			switch (strtolower($name)) {
				case 'count':
					$this->count = $value;
					break;
					
				case 'totalpages':
					$this->totalPages = $value;
					break;
					
				case 'actionlist':
					foreach ($value as $o)
						$this->items[] = new ApiAction($o);
					break;
					
				case 'campaignlist':
					foreach ($value as $o)
						$this->items[] = new ApiCampaign($o);
					break;
					
				/*case 'childaccountlist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiChildAccount($o);
					break;
				*/	
				case 'contactlist':
					foreach ($value as $o)
						$this->items[] = new ApiContact($o);
					break;
					
				case 'grouplist':
					foreach ($value as $o)
						$this->items[] = new ApiContactGroup($o);
					break;
					
				case 'invoicestatementlist':
					foreach ($value as $o)
						$this->items[] = new ApiInvoice($o);
					break;
					
				case 'messages':
					foreach ($value as $o)
						$this->items[] = new ApiMessage($o);
					break;
					
				case 'messagetemplatelist':
					foreach ($value as $o)
						$this->items[] = new ApiTemplate($o);
					break;
					
				case 'mokeywordlist':
					foreach ($value as $o)
						$this->items[] = new ApiMoKeyWord($o);
					break;
					
				case 'numberplanlist':
					foreach ($value as $o)
						$this->items[] = new ApiNumberPlan($o);
					break;
					
				case 'senderaddresseslist':
					foreach ($value as $o)
						$this->items[] = new ApiSender($o);
					break;
					
				case 'servicelist':
					foreach ($value as $o)
						$this->items[] = new ApiService($o);
					break;
				case 'ticketlist':
					foreach ($value as $o)
						$this->items[] = new ApiTicket($o);
					break;
			}
		} else throw new Smsgh_ApiException('Bad ApiList parameter');
	}
	
	/**
	 * Gets count.
	 */
	public function getCount() {
		return $this->count;
	}
	
	/**
	 * Gets totalPages.
	 */
	public function getTotalPages() {
		return $this->totalPages;
	}
	
	/**
	 * Gets items.
	 */
	public function getItems() {
		return $this->items;
	}
}
