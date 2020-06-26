<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'title', 'description', 'status', 'create_user_id', 'updated_user_id', 'deleted_user_id', 'deleted_at',
    ];

    public function users() {
        return $this->belongsTo( User::class , 'create_user_id');
    }
    // public function updatedUsers() {
    //     return $this->belongsTo( User::class , 'updated_user_id');
    // }
    public function posts() {
        return $this->belongsTo(Post::class);
    }
}