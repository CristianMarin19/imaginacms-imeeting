<?php

namespace Modules\Imeeting\Repositories\Eloquent;

use Illuminate\Support\Str;
use Modules\Imeeting\Repositories\MeetingRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentMeetingRepository extends EloquentBaseRepository implements MeetingRepository
{

    public function getItemsBy($params)
    {
        // INITIALIZE QUERY
        $query = $this->model->query();

        // RELATIONSHIPS
        $defaultInclude = [];
        $query->with(array_merge($defaultInclude, $params->include ?? []));

        // FILTERS
        if ($params->filter) {
            $filter = $params->filter;

            //add filter by search
            if (isset($filter->search)) {
                //find search in columns
                $query->where('id', 'like', '%' . $filter->search . '%')
                    ->orWhere('payment_code', 'like', '%' . $filter->search . '%')
                    ->orWhere('name', 'like', '%' . $filter->search . '%');
            }

        }
        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*== REQUEST ==*/
        if (isset($params->page) && $params->page) {
            return $query->paginate($params->take);
        } else {
          (isset($params->take) && $params->take) ? $query->take($params->take) : false;//Take
            return $query->get();
        }
    }

    public function getItem($criteria, $params)
    {
        // INITIALIZE QUERY
        $query = $this->model->query();

        $query->where('id', $criteria);

        // RELATIONSHIPS
        $includeDefault = [];
        $query->with(array_merge($includeDefault, $params->include));

        // FIELDS
        if ($params->fields) {
            $query->select($params->fields);
        }
        return $query->first();

    }


}