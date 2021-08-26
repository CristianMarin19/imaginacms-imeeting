<?php

namespace Modules\Imeeting\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model Repository
use Modules\Imeeting\Repositories\ProviderRepository;
//Model Requests
use Modules\Imeeting\Http\Requests\CreateProviderRequest;
use Modules\Imeeting\Http\Requests\UpdateProviderRequest;
//Transformer
use Modules\Imeeting\Transformers\ProviderTransformer;

class ProviderApiController extends BaseCrudController
{
  public $modelRepository;

  public function __construct(ProviderRepository $modelRepository)
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
    return new CreateProviderRequest($modelData);
  }

  /**
   * Return request to create model
   *
   * @param $modelData
   * @return false
   */
  public function modelUpdateRequest($modelData)
  {
    return new UpdateProviderRequest($modelData);
  }

  /**
   * Return model collection transformer
   *
   * @param $data
   * @return mixed
   */
  public function modelCollectionTransformer($data)
  {
    return ProviderTransformer::collection($data);
  }

  /**
   * Return model transformer
   *
   * @param $data
   * @return mixed
   */
  public function modelTransformer($data)
  {
    return new ProviderTransformer($data);
  }
}