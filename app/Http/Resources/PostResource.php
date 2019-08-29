<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostUserResource;
use App\Http\Resources\PostTagResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'tags' => PostTagResource::collection($this->whenLoaded('tags')),
            'user' => new PostUserResource($this->whenLoaded('user')),
            'href' => [
                'comments' => route("api.v1.posts.comments.index", ['post' => $this->id])
            ]
        ];
    }
}
