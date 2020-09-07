<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'shopping_list_id','user_id','text','created_at'
    ];

    /*
     * a message belongs to one user
     */
    public function user():BelongsTo{
        return $this->BelongsTo(User::class);
    }

    /*
 * a message belongs to one user
 */
    public function shoppingList():BelongsTo{
        return $this->BelongsTo(ShoppingList::class);
    }
}
