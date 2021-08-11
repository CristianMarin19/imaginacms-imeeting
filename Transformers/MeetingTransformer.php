<?php

namespace Modules\Imeeting\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingTransformer extends JsonResource
{

    public function toArray($request)
    {

         $data = [
            'id' => $this->id,
            'providerName' => $this->when($this->provider_name,$this->provider_name),
            'providerMeetingId' => $this->when($this->provider_meeting_id,$this->provider_meeting_id),
            'starUrl' => $this->when($this->star_url,$this->star_url),
            'joinUrl' => $this->when($this->join_url,$this->join_url),
            'password' => $this->when($this->password,$this->password),
            'entityId' => $this->when($this->entity_id,$this->entity_id),
            'entityType' => $this->when($this->entity_type,$this->entity_type),
            'options' =>  $this->options,
            'createdAt' => $this->when($this->created_at, $this->created_at),
            'updatedAt' => $this->when($this->updated_at, $this->updated_at),
        ];

        return $data;

    }

}