<?php

namespace Modules\Imeeting\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model Repository
use Modules\Imeeting\Repositories\MeetingRepository;
//Model Requests
use Modules\Imeeting\Http\Requests\CreateMeetingRequest;
use Modules\Imeeting\Http\Requests\UpdateMeetingRequest;
//Transformer
use Modules\Imeeting\Transformers\MeetingTransformer;

use Illuminate\Http\Request;

class MeetingApiController extends BaseCrudController
{
  public $modelRepository;

  public function __construct(MeetingRepository $modelRepository)
  {
    $this->modelRepository = $modelRepository;
  }
  
  /**
   * Return request to create model
   *
   * @param $modelData
   * @return false
   */
  public function modelCreateRequest($modelData)
  {
    return new CreateMeetingRequest($modelData);
  }

  /**
   * Return request to create model
   *
   * @param $modelData
   * @return false
   */
  public function modelUpdateRequest($modelData)
  {
    return new UpdateMeetingRequest($modelData);
  }

  /**
   * Return model collection transformer
   *
   * @param $data
   * @return mixed
   */
  public function modelCollectionTransformer($data)
  {
    return MeetingTransformer::collection($data);
  }

  /**
   * Return model transformer
   *
   * @param $data
   * @return mixed
   */
  public function modelTransformer($data)
  {
    return new MeetingTransformer($data);
  }
}