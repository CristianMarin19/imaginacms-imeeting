<?php

namespace Modules\Imeeting\Traits;

use Modules\Imeeting\Entities\Meeting;

trait Meetingable
{


	/**
   	* Boot trait method
   	*/
	public static function bootMeetingable()
	{
	    //Listen event after create model
	    static::createdWithBindings(function ($model) {
	      $model->checkMeetingRequirements($model->getEventBindings('createdWithBindings'));
	    });

	    static::updatedWithBindings(function ($model) {
	      $model->checkMeetingRequirements($model->getEventBindings('updatedWithBindings'));
	    });

	}

	/**
   	* Check Meeting Requirements when a model is created or updated
   	*/
	public function checkMeetingRequirements($params)
	{

		\Log::info('Imeeting: Trait Meetingable - Check Requirements');
	    $meetingConfig = $params['data']['meetingConfig'];

	 	if(isset($meetingConfig['providerName'])){
	 		
	 		//Provider Service
        	$service = app('Modules\Imeeting\Services\\'.ucfirst($meetingConfig['providerName']).'Service');

        	try {

          		$response = $service->checkRequirements($meetingConfig);

        	} catch (\Exception $e) {

	    	    $status = 500;
	            $response = [
	              'errors' => $e->getMessage()
	            ];

            	\Log::error('Module Imeeting: Trait Meetingable - Check Meeting : '.$e->getMessage());

	    	}
            
	 	}

	}

	/**
   	* @param meetingConfig - providerName
   	* @param meetingConfig - email
   	* @return
   	*/
   	public function validateMeetingRequirements($params){
   		
   		\Log::info('Imeeting: Trait Meetingable - validateMeetingRequirements');

   		$meetingConfig = $params['meetingConfig'];

   		if(isset($meetingConfig['providerName'])){
	 		
	 		//Provider Service
        	$service = app('Modules\Imeeting\Services\\'.ucfirst($meetingConfig['providerName']).'Service');

        	try {

          		$responseService = $service->validateRequirements($meetingConfig);

          		$response['providerStatus'] = $responseService;

        	} catch (\Exception $e) {

	    	    $status = 500;
	    	   
	            $response = [
	              'errors' => $e->getMessage()
	            ];
	           
            	\Log::error('Module Imeeting: Trait Meetingable - validateMeetingRequirements '.$e->getMessage());

	    	}
            
	 	}

	 	return $response;

   	}

   
}