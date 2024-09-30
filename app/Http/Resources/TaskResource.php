<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\AttachmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = [
            "id_task" => $this->id_task,
            'taskName' => $this->taskName,
            'description' => $this->description,
            'dateS' => $this->dateS,
            'dateF' => $this->dateF,
            'collaborators' => $this->whenLoaded('collaborators', function () {
                return EmployeeResource::collection($this->collaborators);
            }),
            'attachments' => $this->whenLoaded('attachments', function () {
                return AttachmentResource::collection($this->attachments);
            })
        ];
        return $response;
    }
}
