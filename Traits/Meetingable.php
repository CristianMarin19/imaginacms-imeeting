<?php

namespace Modules\Imeeting\Traits;

use Modules\Imeeting\Entities\Meeting;

trait Meetingable
{


	protected $createMeeting = false;

	/**
   	* Boot trait method
   	*/
	public static function bootMeetingable()
	{
	    //Listen event after create model
	    static::createdWithBindings(function ($model) {
	      $model->createMeeting();
	    });

	}

	/**
   	* Create meeting to entity
   	*/
	public function createMeeting()
	{
	    //Get event bindings by event name
	    $eventBindings = $this->getEventBindings('createdWithBindings');
	    	
	    // Validate meeting data from Entity Created
	 	if(isset($eventBindings['data']['meeting'])){
	 		
	 		// Data Metting
        	$dataToCreate['meetingAttr'] = $eventBindings['data']['meeting'];

	 		// Entity
	        $dataToCreate['entityAttr'] =[
	            'id' => $this->id,
	            'type' => get_class($this),  
	        ];

	        // Create meeting with Provider
	        $meeting = app('Modules\Imeeting\Services\MeetingService')->create($dataToCreate);

	        if(isset($meeting['errors']))
            	throw new \Exception($meeting['errors'], 500);
            
	 	}


	}

    /*
	* Entity Relation with Meetings
	*/
    public function meetings()
  	{
    	return $this->morphMany(Meeting::class, 'entity');
  	}
  	


}