<?php

namespace Modules\Imeeting\Services;

// Traits
use Modules\Imeeting\Traits\ZoomJwt;

class ZoomService
{

	use ZoomJwt;


	/**
	* @param Email - email (required)
	* @param DateTime - startTime (required)
	* @param String - topic (optional)
	* @param int - duration (optional)
	*/
	public function create($dataRequest){

		// Default values
		$defaultConf = $this->getConfig('asgard.imeeting.config.providers.zoom.defaulValuesMeeting');
		
		// Get data Meeting
		$data = $dataRequest['meetingAttr'];

		
		// 'me' => Esto lo asignaria con el mismo host siempre
		//$path = 'users/me/meetings';

		$path = 'users/'.$data['email'].'/meetings';

		$body = [
			'topic' => $data['title'] ?? $defaultConf['topic'],
            'type' => 2,// Shedule Meeting
            'start_time' => $this->convertTimeFormat($data['startTime']),
            'duration' => $data['duration'] ?? $defaultConf['duration'], // En min
            'settings' => [
                'host_video' => false,//Start the video when the host join meeting
                'participant_video' => false,//Start the video when participans join meeting
                'waiting_room' => true,
            ]
		];

		// Request
        $response = $this->requestPost($path,$body,$data);

        // Format data to save
        $dataFormat = $this->formatResponse(json_decode($response->body()));


        return $dataFormat;
        

	}

	/**
	* @param Response from Provider
	*/
	private function formatResponse($response){

		$data["provider_name"] = "zoom";
		$data["provider_meeting_id"] = $response->id;
		$data["star_url"] = $response->start_url;
		$data["join_url"] = $response->join_url;
		$data["password"] = $response->password; //opcional
		
		// Extra Attr
		// $data["options"]
		
		return $data;

	}
   

}