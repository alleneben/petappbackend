<?php # $Id: ApiHelper.php 0 1970-01-01 00:00:00Z mkwayisi $

class ApiHelper {
	/**
	 * Data fields.
	 */
	private static $json_errors = array(
		JSON_ERROR_DEPTH          => 'Maximum stack depth exceeded',
		JSON_ERROR_STATE_MISMATCH => 'State mismatch',
		JSON_ERROR_CTRL_CHAR      => 'Unexpected control character found',
		JSON_ERROR_SYNTAX         => 'Syntax error, malformed JSON',
		JSON_ERROR_UTF8           => 'Encoding error occured'
	);
	
	/**
	 * getData
	 */
	public static function getData
		(SmsghApi $api, $method, $uri, $data = null) {
		$apiRequest = new ApiRequest
			($api->getHostname(), $api->getPort(), $api->isHttps() ? 'ssl' : 'tcp',
				$api->getTimeout(), $api->getClientId(), $api->getClientSecret());
		$apiResponse = $apiRequest
			->setMethod($method)
			->setUri(str_replace(' ', '', $uri))
			->addHeader('Accept', 'application/json')
			->addHeader('Content-Type', 'application/json')
			->send($data);
		if ($apiResponse->getStatus() > 199 && $apiResponse->getStatus() < 300)
			return $apiResponse->getBody();
		throw new Smsgh_ApiException
			(sprintf('Request failed: (%d) %s',
				$apiResponse->getStatus(), $apiResponse->getReason()));
	}
	
	/**
	 * getJson
	 */
	public static function getJson
		(SmsghApi $api, $method, $uri, $data = null) {
		$result = json_decode(self::getData($api, $method, $uri, $data));
		if (($errcode = json_last_error()) == JSON_ERROR_NONE)
			return $result;
		throw new Smsgh_ApiException('json_decode(): '
			. (isset(self::$json_errors[$errcode]) ?
				self::$json_errors[$errcode] : 'Unknown error'));
	}
	
	/**
	 * getApiList
	 */
	public static function getApiList
		(SmsghApi $api, $uri, $page, $pageSize, $hasQ = false) {
		if (!is_string($uri))
			throw new Smsgh_ApiException
				("Parameter 'uri' must be of type 'string'");
		if (!is_int($page))
			throw new Smsgh_ApiException
				("Parameter 'page' must be of type 'int'");
		if (!is_int($pageSize))
			throw new Smsgh_ApiException
				("Parameter 'pageSize' must be of type 'int'");
		if ($page > 0) {
			$uri .= ($hasQ ? '&' : '?') . 'Page=' . $page;
			if (!$hasQ) $hasQ = true;
		}
		if ($pageSize > 0)
			$uri .= ($hasQ ? '&' : '?') . 'PageSize=' . $pageSize;
		return new ApiList(self::getJson($api, 'GET', $uri));
	}
	
	/**
	 * toJson
	 */
	public static function toJson($object) {
		$obj = new stdClass;
		if (is_object($object)) {
			foreach (get_class_methods($object) as $meth) {
				if (strncmp($meth, 'set', 3)) continue;
				$prop = substr($meth, 3);
				$meth = array($object, 'get' . $prop);
				if (is_callable($meth))
					$obj->{$prop} = call_user_func($meth);
			}
		}
		return json_encode($obj);
	}
}
