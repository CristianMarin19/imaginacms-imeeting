<?php

namespace Modules\Imeeting\Http\Controllers\Api;

// Requests & Response
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Request
use Modules\Imeeting\Http\Requests\CreateMeetingRequest;

// Transformers
use Modules\Imeeting\Transformers\MeetingTransformer;

// Repositories
use Modules\Imeeting\Repositories\MeetingRepository;

class MeetingApiController extends BaseApiController
{

    private $meeting;
    private $meetingService;

    public function __construct(MeetingRepository $meeting){
       $this->meeting = $meeting;
       $this->meetingService = app("Modules\Imeeting\Services\MeetingService");
    }

    /**
     * GET ITEMS
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $meetings = $this->meeting->getItemsBy($params);

            //Response
            $response = ["data" => MeetingTransformer::collection($meetings)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($meetings)] : false;
        } catch (\Exception $e) {
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * GET A ITEM
     *
     * @param $criteria
     * @return mixed
     */
    public function show($criteria, Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $meeting = $this->meeting->getItem($criteria, $params);

            //Break if no found item
            if (!$meeting) throw new \Exception('Item not found', 404);

            //Response
            $response = ["data" => new MeetingTransformer($meeting)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($meeting)] : false;
        } catch (\Exception $e) {
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }
    
    /**
     * GET - Create
     * @param Request
     * @return response
     */
    public function create(Request $request){

        \DB::beginTransaction();

        try {

            $data = $request['attributes'] ?? [];//Get data

            //Validate Request
            $this->validateRequestApi(new CreateMeetingRequest($data));

            //Service Meeting
            $meeting = $this->meetingService->create($data);
            
            //Response
            $response = ["data" => new MeetingTransformer($meeting)];

            \DB::commit(); //Commit to Data Base
          } catch (\Exception $e) {

            \DB::rollback();//Rollback to Data Base
            //Message Error
            $status = 500;
            $response = [
              'errors' => $e->getMessage()
            ];
        }

        return response()->json($response, $status ?? 200);

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Response
     */
    public function update($criteria, Request $request)
    {
        \DB::beginTransaction();

        try {

            $params = $this->getParamsRequest($request);

            $data = $request->input('attributes') ?? [];

            //Update data
            //Request to Repository
            $entity = $this->meeting->getItem($criteria, $params);

            //Break if no found item
            if (!$entity) throw new \Exception('Item not found', 404);

            $meeting = $this->meeting->update($entity, $data);
            //Response
            $response = ['data' => 'Item Updated'];
            \DB::commit(); //Commit to Data Base

        } catch (\Exception $e) {
          \Log::error($e->getMessage());
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        return response()->json($response, $status ?? 200);
    }

    /**
    * Remove the specified resource from storage.
    * @return Response
    */
    public function delete($criteria, Request $request)
    {
        
        \DB::beginTransaction();

        try {

            $params = $this->getParamsRequest($request);
           
            //Request to Repository
            $entity = $this->meeting->getItem($criteria, $params);

            //Break if no found item
            if (!$entity) throw new \Exception('Item not found', 404);

            $meeting = $this->meeting->destroy($entity);
            //Response
            $response = ['data' => 'Item Deleted'];
            \DB::commit(); //Commit to Data Base

        } catch (\Exception $e) {
          \Log::error($e->getMessage());
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        return response()->json($response, $status ?? 200);
    }
    

}