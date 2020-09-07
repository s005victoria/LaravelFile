<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    //was überschrieben werden kann
    protected $fillable = ['shopping_list_id', 'title', 'amount', 'max_price'];

    /*
     * everyone creates its own shopping items,
     * they are always new and therefore unique in each shoppinglist.
     * Thus the shoppingitem belongs always to one shoppinglist
     */
    public function shoppingList():BelongsTo{
        return $this->belongsTo(ShoppingList::class);
    }

}
