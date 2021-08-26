<?php

namespace Modules\Imeeting\Services;

// Repositories
use Modules\Imeeting\Repositories\MeetingRepository;

class MeetingService
{

	private $meeting;

	public function __construct(MeetingRepository $meeting){
       $this->meeting = $meeting;
    }

    /**
     * @param Array meetingAttr (title,startTime,email, etc)
     * @param Array entityAttr (id,type)
     * @param String provider (optional)
     * @return response
     */
	public function create($data){

		    // Default Provider
        $providerName = "zoom";

        // check other provider (if exist)
        if(isset($data['providerName']))
            $providerName = $data['providerName'];
           
        //Provider Service
        $service = app('Modules\Imeeting\Services\\'.ucfirst($providerName).'Service');
        
        // Create Meeting in the Provider
        $meetingDataProvider = $service->create($data);

        // Add entities attributes from request
        $meetingDataProvider['entity_id'] = $data['entityAttr']['id'];
        $meetingDataProvider['entity_type'] = $data['entityAttr']['type'];
        
        try {

	        //Create meeting in Module
	        $response = $this->meeting->create($meetingDataProvider);

	    } catch (\Exception $e) {

	    	$status = 500;
            $response = [
              'errors' => $e->getMessage()
            ];

            \Log::error('Module Imeeting: Service Meeting - Create: '.$e->getMessage());
	    }

        return $response;
            
	}


}