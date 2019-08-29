<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostCommentUserResource;

class PostCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'content' => $this->content,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'user' => new PostCommentUserResource($this->whenLoaded('user'))
        ];
    }
}
