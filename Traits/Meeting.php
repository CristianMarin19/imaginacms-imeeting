<?php

namespace Modules\Imeeting\Traits;

trait Meeting
{


	/*
	* Entity Relation with Meetings
	*/
	public function meetings()
    {
        return $this->morphToMany("Modules\\Imeeting\\Entities\\Meeting", 'entity');
    }


}