<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class GuzzleService {

    const HOST  = 'https://api.heyloyalty.com';
    const ENDPOINTTYPE = '/loyalty/v1';

    /**
     * @param $response
     * @return array|mixed|object
     */
    public function responseToArray($response){
        return json_decode($response,true);
    }

    /**
     * @param string $type
     * @param string $url
     * @param string $client
     * @return json|null
     */
    public function sendRequest($type,$url,$client,$query = []){

        $cred = $this->getCredentials($client);
        $requestTimestamp = gmDate("D, d M Y H:i:s").'GMT';
        $requestSignature = base64_encode(hash_hmac('sha256',$requestTimestamp,$cred['secret']));

        $client = $this->getGuzzleClient();
        $request = new Request($type ,self::ENDPOINTTYPE.$url);

     try {
            //add basic authorization for client
            $response = $client->send($request, [
                'timeout' => 2,
                'auth' => [$cred['key'], $requestSignature],
                'headers' => [
                    'X-Request-Timestamp' => $requestTimestamp
                ],
                'query' => $query
            ]);

        //check if we have a response!

            $code = $response->getStatusCode();
        }catch (\Exception $e)
        {

            exit();
        }

        if($this->handleResponseStatusCode($code)){

            $response = $response->getBody()->getContents();
        }else{

            $response = null;
        }

        return $response;
    }
       /**
     * @desc get credentials from client
     * @param string $client
     * @return array
     */
    public function getCredentials($client){
        $array = [
            'test' => ['key' => 'DTd7K5yfQFgyLcTS','secret' => 'zo8z8pRy0bRKqMxojcq0t1jVjXzE623L','list_id' => 2444]
        ];

        if(isset($array[$client])) return $array[$client];

        return null;
    }
    /**
     * @return Client
     */
    private function getGuzzleClient(){
        return new Client(['base_uri' => self::HOST]);
    }
    /**
     * @param $code
     * @return bool
     */
    private function handleResponseStatusCode($code){

        if($code > 199 && $code < 299){
            return true;
        }else {

            return false;
        }
    }
}