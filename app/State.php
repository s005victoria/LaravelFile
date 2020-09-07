<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    //TODO protexted fillable
    protected $fillable = ['name'];

    /*
     * one status of this table is needed for many shoppinglists
     */
    public function shoppingLists():HasMany{
        return $this->hasMany(ShoppingList::class);
    }
}
