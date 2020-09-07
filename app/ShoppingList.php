<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ShoppingList extends Model
{
    //TODO protected
    protected $fillable = ['user_id','volunteer_id','state_id','title','until','updated_at'];


    /*
     * the shoppinglist has many shopping items (1:n)
     */
    public function articles():HasMany{
        return $this->hasMany(Article::class);
    }


    /*
     * the shoppinglist has many feedback-messages
     */
    public function comments():HasMany{
        return $this->hasMany(Comment::class);
    }

    /*
     * the shoppinglist belongs to exact one Status
     */
    public function state():BelongsTo{
        return $this->belongsTo(State::class);
    }

    /*
     * the shoppinglist belongs to one owner/user
     */
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    /*
     * the shoppinglist belongs to one volunteer
     */
    public function volunteer():BelongsTo{
        return $this->belongsTo(User::class);
    }




}
