<?php

namespace Tests;

use App\Models\Author;

trait CreateAuthor
{
    public function CreateAuthor($user, $attributes = null): Author
    {
        $author = Author::factory()->create($attributes);
        
        $author->user_id = $user->id;
        $user->author_id = $author->id;
        
        $user->save();
        $author->save();

        return $author;
    }
}
