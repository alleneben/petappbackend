<?php
class ApiPremiumResource {
	private $apiHost;
	
	/**
	 * Primary constructor.
	 */
	public function __construct(SmsghApi $apiHost) {
		$this->apiHost = $apiHost;
	}
	
	/**
	 * Gets number plans by page and pageSize.
	 */
	public function getNumberPlans($page = -1, $pageSize = -1, $type = -1) {
		
		$uri = "/".$this->apiHost->getContextPath()."/numberplans/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/numberplans/';
		}
		
		if(is_int($type) && $type > 0){
			$uri .= "?Type=$type";
			return ApiHelper::getApiList($this->apiHost, $uri, $page, $pageSize, TRUE);
		}
		
		return ApiHelper::getApiList
			($this->apiHost, $uri, $page, $pageSize);
	}
	
	/**
	 * Gets shared number plans by page and pageSize.
	 */
/* 	public function getSharedNumberPlans($page = -1, $pageSize = -1) {
		return ApiHelper::getApiList
			($this->apiHost, '/v3/numberplans/shared', $page, $pageSize);
	} */
	
	/**
	 * Gets not-shared number plans by page and pageSize.
	 */
/* 	public function getNotSharedNumberPlans($page = -1, $pageSize = -1) {
		return ApiHelper::getApiList
			($this->apiHost, '/v3/numberplans/notshared', $page, $pageSize);
	} */
	
	/**
	 * Gets number plan keywords by number plan ID.
	 */
	public function getNumberPlanKeywords
		($numberPlanId, $page = -1, $pageSize = -1) {
		
		$uri = "/".$this->apiHost->getContextPath()."/numberplans/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/numberplans/';
		}
		
		
		if (is_numeric($numberPlanId))
			return ApiHelper::getApiList($this->apiHost,
				$uri."$numberPlanId/keywords", $page, $pageSize);
		throw new Smsgh_ApiException
			("Paramater 'numberPlanId' must be of type 'number'");
	}
	
	
	/**
	 * Gets campaign keywords
	 */
	public function getCampaignKeywords
	($campaignId, $page = -1, $pageSize = -1) {
	
		$uri = "/".$this->apiHost->getContextPath()."/campaigns/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns/';
		}
	
	
		if (is_numeric($campaignId))
			return ApiHelper::getApiList($this->apiHost,
					$uri."$campaignId/keywords", $page, $pageSize);
		throw new Smsgh_ApiException
		("Paramater 'campaignId' must be of type 'number'");
	}
		
	/**
	 * Gets campaigns by page and pageSize.
	 */
	public function getCampaigns($page = -1, $pageSize = -1) {
		$uri = "/".$this->apiHost->getContextPath()."/campaigns/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns/';
		}
		
		return ApiHelper::getApiList
			($this->apiHost, $uri, $page, $pageSize);
	}
	
	/**
	 * Gets campaign by ID.
	 */
	public function getCampaign($campaignId) {
		$uri = "/".$this->apiHost->getContextPath()."/campaigns/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns/';
		}
		
		
		if (is_numeric($campaignId))
			return new ApiCampaign(ApiHelper::getJson
				($this->apiHost, 'GET', $uri.$campaignId));
		throw new Smsgh_ApiException
			("Parameter 'campaignId' must be of type 'number'");
	}
	
	
	/**
	 * Gets numberplan by ID.
	 */
	public function getNumberPlan($numberPlanId) {
		$uri = "/".$this->apiHost->getContextPath()."/numberplans/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/numberplans/';
		}
	
	
		if (is_numeric($numberPlanId))
			return new ApiNumberPlan(ApiHelper::getJson
					($this->apiHost, 'GET', $uri.$numberPlanId));
		throw new Smsgh_ApiException
		("Parameter 'numberPlanId' must be of type 'number'");
	}	
	
	
	/**
	 * Gets keyword by ID.
	 */
	public function getKeyword($keywordId) {
		$uri = "/".$this->apiHost->getContextPath()."/keywords/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/keywords/';
		}
	
	
		if (is_numeric($keywordId))
			return new ApiMoKeyWord(ApiHelper::getJson
					($this->apiHost, 'GET', $uri.$keywordId));
		throw new Smsgh_ApiException
		("Parameter 'keywordId' must be of type 'number'");
	}
	
	/**
	 * Creates new object.
	 */
	public function create($object) {
		
		if ($object instanceof ApiCampaign) {
			$uri = "/".$this->apiHost->getContextPath()."/campaigns/";
			if($this->apiHost->getContextPath() == ""){
				$uri = '/campaigns/';
			}
			
				
			return new ApiCampaign(ApiHelper::getJson
				($this->apiHost, 'POST', $uri,
					ApiHelper::toJson($object)));
		}
		
		else if ($object instanceof ApiMoKeyWord) {
			$uri = "/".$this->apiHost->getContextPath()."/keywords/";
			if($this->apiHost->getContextPath() == ""){
				$uri = '/keywords/';
			}
			
				
			return new ApiMoKeyWord(ApiHelper::getJson
				($this->apiHost, 'POST', $uri,
					ApiHelper::toJson($object)));
		}
		
		throw new Smsgh_ApiException('Bad parameterized object type');
	}
	
	/**
	 * Updates object.
	 */
	public function update($object) {
		if ($object instanceof ApiCampaign) {
			
			$uri = "/".$this->apiHost->getContextPath()."/campaigns/";
			if($this->apiHost->getContextPath() == ""){
				$uri = '/campaigns/';
			}
				
			return new ApiCampaign(ApiHelper::getJson
				($this->apiHost, 'PUT',
					$uri . $object->getCampaignId(),
						ApiHelper::toJson($object)));
		}
		
		else if ($object instanceof ApiMoKeyWord) {
			$uri = "/".$this->apiHost->getContextPath()."/keywords/";
			if($this->apiHost->getContextPath() == ""){
				$uri = '/keywords/';
			}
				
			return new ApiMoKeyWord(ApiHelper::getJson
				($this->apiHost, 'PUT', $uri . $object->getId(),
					ApiHelper::toJson($object)));
		}
		
		throw new Smsgh_ApiException('Bad parameterized object type');
	}
	
	/**
	 * Deletes campaign by ID.
	 */
	public function deleteCampaign($campaignId) {
		$uri = "/".$this->apiHost->getContextPath()."/campaigns/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns/';
		}
		
		if (is_numeric($campaignId))
			ApiHelper::getData
				($this->apiHost, 'DELETE', $uri.$campaignId);
		else throw new Smsgh_ApiException
			("Parameter 'campaignId' must be of type 'number'");
	}
	
	/**
	 * Gets keywords by page and pageSize.
	 */
	public function getKeywords($page = -1, $pageSize = -1) {
		$uri = "/".$this->apiHost->getContextPath()."/keywords/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/keywords/';
		}
		
		return ApiHelper::getApiList
			($this->apiHost, $uri, $page, $pageSize);
	}
	
	/**
	 * Deletes keyword by ID.
	 */
	public function deleteKeyword($keywordId) {
		$uri = "/".$this->apiHost->getContextPath()."/keywords/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/keywords/';
		}
		
		if (is_numeric($keywordId))
			ApiHelper::getData
				($this->apiHost, 'DELETE', $uri.$keywordId);
		else throw new Smsgh_ApiException
			("Parameter 'keywordId' must be of type 'number'");
	}
	
	/**
	 * Adds keyword to campaign.
	 */
	public function addKeywordToCampaign($campaignId, $keywordId) {
		$uri = "/".$this->apiHost->getContextPath()."/campaigns/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns/';
		}
		
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_numeric($keywordId))
			throw new Smsgh_ApiException
				("Parameter 'keywordId' must be of type 'number'");
		return new ApiCampaign(ApiHelper::getJson
			($this->apiHost, 'PUT', $uri."$campaignId/keywords/$keywordId"));
	}
	
	/**
	 * Removes keyword from campaign.
	 */
	public function removeKeywordFromCampaign($campaignId, $keywordId) {
		$uri = "/".$this->apiHost->getContextPath()."/campaigns/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns/';
		}
		
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_numeric($keywordId))
			throw new Smsgh_ApiException
				("Parameter 'keywordId' must be of type 'number'");
		ApiHelper::getData($this->apiHost,
			'DELETE', $uri."$campaignId/keywords/$keywordId");
	}
	
	/**
	 * Gets campaign actions by ID.
	 */
	public function getCampaignActions($campaignId, $page = -1, $pageSize = -1) {
		$uri = "/".$this->apiHost->getContextPath()."/campaigns/";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns/';
		}
		
		if (is_numeric($campaignId))
			return ApiHelper::getApiList($this->apiHost,
				$uri."$campaignId/actions", $page, $pageSize);
		throw new Smsgh_ApiException
			("Parameter 'campaignId' must be of type 'number'");
	}
	
	/**
	 * Adds default reply action to campaign.
	 */
	public function addDefaultReplyAction($campaignId, $message) {
		$uri = "/".$this->apiHost->getContextPath()."/campaigns";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns';
		}
		
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_string($message))
			throw new Smsgh_ApiException
				("Parameter 'message' must be of type 'string'");
		$obj = new stdClass;
		$obj->message = $message;
		return new ApiCampaign(ApiHelper::getJson
			($this->apiHost, 'POST',
				$uri."/$campaignId/actions/default_reply",
					json_encode($obj)));
	}
	
	/**
	 * Adds dynamic URL action to campaign.
	 */
	public function addDynamicUrlAction
		($campaignId, $url, $sendResponse = 'no') {
		$uri = "/".$this->apiHost->getContextPath()."/campaigns";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns';
		}
		
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_string($url))
			throw new Smsgh_ApiException
				("Parameter 'url' must be of type 'string'");
		if (!is_string($sendResponse))
			throw new Smsgh_ApiException
				("Parameter 'sendResponse' must be of type 'string'");
		$obj = new stdClass;
		$obj->url = $url;
		$obj->send_response = $sendResponse;
		return new ApiCampaign(ApiHelper::getJson
			($this->apiHost, 'POST',
				$uri."/$campaignId/actions/dynamic_url",
					json_encode($obj)));
	}
	
	/**
	 * Adds email address action to campaign.
	 */
	public function addEmailAddressAction($campaignId, $address) {
		$uri = "/".$this->apiHost->getContextPath()."/campaigns";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns';
		}
		
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_string($address))
			throw new Smsgh_ApiException
				("Parameter 'address' must be of type 'string'");
		$obj = new stdClass;
		$obj->address = $address;
		return new ApiCampaign(ApiHelper::getJson
			($this->apiHost, 'POST',
				$uri."/$campaignId/actions/email",
					json_encode($obj)));
	}
	
	/**
	 * Adds forward to mobile action to campaign.
	 */
	public function addForwardToMobileAction($campaignId, $number) {
		$uri = "/".$this->apiHost->getContextPath()."/campaigns";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns';
		}
		
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_string($number))
			throw new Smsgh_ApiException
				("Parameter 'number' must be of type 'string'");
		$obj = new stdClass;
		$obj->number = $number;
		return new ApiCampaign(ApiHelper::getJson
			($this->apiHost, 'POST',
				$uri."/$campaignId/actions/phone",
					json_encode($obj)));
	}
	
	/**
	 * Adds forward to SMPP action to campaign.
	 */
	public function addForwardToSmppAction($campaignId, $appId) {
		$uri = "/".$this->apiHost->getContextPath()."/campaigns";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns';
		}
		
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_string($appId))
			throw new Smsgh_ApiException
				("Parameter 'appId' must be of type 'string'");
		$obj = new stdClass;
		$obj->api_id = $appId;
		return new ApiCampaign(ApiHelper::getJson
			($this->apiHost, 'POST',
				$uri."/$campaignId/actions/smpp",
					json_encode($obj)));
	}
	
	/**
	 * Removes action from campaign.
	 */
	public function removeActionFromCampaign($campaignId, $actionId) {
		$uri = "/".$this->apiHost->getContextPath()."/campaigns";
		if($this->apiHost->getContextPath() == ""){
			$uri = '/campaigns';
		}
		
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of tye 'number'");
		if (!is_numeric($actionId))
			throw new Smsgh_ApiException
				("Parameter 'actionId' must be of type 'number'");
		return new ApiCampaign(ApiHelper::getJson
			($this->apiHost, 'DELETE', $uri."/$campaignId/actions/$actionId"));
	}
}
