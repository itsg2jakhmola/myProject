<?php

namespace App\Http\Controllers\Traits;

use GuzzleHttp\Client;

trait MessageTrait
{

    protected $_authKey;
    protected $_sender_id;
    protected $_route_trans;


    private function callMessageService()
    {
    	$this->_authKey = config('services.message_api.api_key');
    	$this->_sender_id = config('services.message_api.sender_id');
    	$this->_route_trans = config('services.message_api.route_trans');
    }

    /**
   * Function used to get Email on each or require event.

   * @param  [type] Message          [char]
   */


    public function sendSMS( $message, $mobileRequest ){

   	try{
   		$this->callMessageService();

   		$country_code = '';

        if(isset($mobileRequest['country_code'])){
          $country_code = $mobileRequest['country_code'];
        } else {
          $country_code = '91';
        }
        $mobile = $country_code . $mobileRequest['phone'];

   		$data = http_build_query([
						'authkey' => $this->_authKey,
				        'mobiles' => $mobile,
				        'message' => $message,
				        'sender' => $this->_sender_id,
				        'route' => $this->_route_trans
					    ]);

    	$client = new Client(['base_uri' => 'https://control.msg91.com']);
		$res = $client->request('GET', '/api/sendhttp.php?' . $data);
		$response = $res->getBody()->getContents();
     	return json_decode($response);
		} catch (\Exception $e) {
     	 echo $e->getMessage();
    	}
    }

    public function composeSMSMessage($message_string, $data){
      $pattern = [];
      foreach ($data as $key => $value) {
        $pattern['{{' . $key . '}}'] = $value;
      }
      //replace pattern, strtr() function
      //remove new line and tabs.
      return trim(preg_replace('/\s+/', ' ', strtr($message_string, $pattern)));
    }
}
