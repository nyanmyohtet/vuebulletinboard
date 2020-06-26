<?php

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;

class CSVFiles implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (count(Post::where('title', @$row[0])->get()) == 0 && @$row[0] && @$row[1]) {
            $post = new Post([
                'title' => @$row[0],
                'description' => @$row[1],
                'create_user_id' => Auth::guard("api")->user()->id,
                'updated_user_id' => Auth::guard("api")->user()->id
            ]);
            return $post;
        }
    }
}
