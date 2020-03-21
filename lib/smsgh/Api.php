<?php 
# $Id: Api.php 0 1970-01-01 00:00:00Z mkwayisi $

require 'SmsghApi.php';
require 'ApiRequest.php';
require 'ApiResponse.php';
require 'ApiException.php';
require 'ApiHelper.php';
require 'ApiList.php';

require 'ApiAccountResource.php';
require 'ApiAccountProfile.php';
require 'ApiAccountContact.php';
require 'ApiService.php';
require 'ApiSettings.php';

require 'ApiInvoice.php';

require 'ApiMessagesResource.php';
require 'ApiMessage.php';
require 'ApiMessageResponse.php';

require 'ApiContactsResource.php';
require 'ApiContact.php';
require 'ApiContactGroup.php';

require 'ApiPremiumResource.php';
require 'ApiNumberPlan.php';
require 'ApiMoKeyWord.php';
require 'ApiNumberPlanItem.php';
require 'ApiServiceType.php';
require 'ApiCampaign.php';
require 'ApiAction.php';

require 'ApiBulkMessagingResource.php';
require 'ApiSender.php';
require 'ApiTemplate.php';
require 'ApiTicketResource.php';
require 'ApiTicket.php';
require 'ApiTicketResponse.php';

if (! function_exists ( 'json_encode' )) {
	trigger_error ( 'SmsghApi requires the PHP JSON extension', E_USER_ERROR );
}
