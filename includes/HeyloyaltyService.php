<?php

use GuzzleService;

/**
 * Class HeyloyaltyService
 */
class HeyloyaltyService {

    public function __construct(GuzzleService $guzzleService)
    {
        $this->guzzleService = $guzzleService;
    }

    /**
     * @param $client
     * @return array
     */
    public function getMembersFromList($client){

        $cred = $this->guzzleService->getCredentials($client);
        $response = $this->guzzleService->sendRequest('GET','/lists/'.$cred['list_id'].'/members',$client);
        $array = $this->guzzleService->responseToArray($response);

        $members = (isset($array['members'])) ? $array['members'] : array();
        return $members;
    }

    /**
     * @param $client
     * @param $email
     * @return null
     */
    public function getMemberByEmail($client,$email){

        $members = $this->getMembersFromList($client);
        foreach ($members as $member) {
            if($member['email'] === $email){
                return $member;
            }
        }
        return null;
    }

    public function getLists($client){

        $response = $this->guzzleService->sendRequest('GET','/lists',$client);
        $array = $this->guzzleService->responseToArray($response);
    }

}