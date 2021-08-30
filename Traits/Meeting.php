<?php

namespace Modules\Imeeting\Traits;

trait Meeting
{


	protected $createMeeting = false;

	/*
	* Entity Relation with Meetings
	*/
	public function meetings()
    {
        return $this->morphToMany("Modules\\Imeeting\\Entities\\Meeting", 'entity');
    }


    /**
   	* Boot trait method
   	*/
	public static function bootMeeting()
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
	    

	    dd($eventBindings);

	    /*
		 // Meeting
        $dataToCreate['meetingAttr'] =[
            'title' => 'Reunion con Usuario - CitaId:'.$appointment->id,
            'startTime' => '27-08-2021 14:00:00',
             'email' => 'hostemail@email.com' //Host
        ];

        // Entity
        $dataToCreate['entityAttr'] =[
            'id' => $appointment->id,
            'type' => get_class($appointment),  
        ];

        $meeting = app('Modules\Imeeting\Services\MeetingService')->create($dataToCreate);

	    */

	}


}