<?php

namespace Modules\Imeeting\Repositories\Eloquent;

use Modules\Imeeting\Repositories\ProviderRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentProviderRepository extends EloquentBaseRepository implements ProviderRepository
{

	/**
   	* Filter name to replace
   	* @var array
   	*/
  	protected $replaceFilters = [];

  	/**
   	* Filter query
   	*
   	* @param $query
   	* @param $filter
   	* @return mixed
   	*/
  	public function filterQuery($query, $filter)
  	{
    
    /**
     * Note: Add filter name to replaceFilters attribute to replace it
     *
     * Example filter Query
     * if (isset($filter->status)) $query->where('status', $filter->status);
     *
     */

    	//Response
    	return $query;
  	}

}
