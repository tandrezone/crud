<?php

namespace App\Models;

use App\Services\Column;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Constants

    //Appends

    //columns management
    public function getPropertiesShow()
    {
        return [
            new Column('name','string'),
            new Column('description','string'),
            new Column('image','image'),
            new Column('price','money'),
        ];
    }

    public function getPropertiesEdit()
    {
        return [
            new Column('name','string'),
            new Column('description','string'),
            new Column('image','image'),
            new Column('image','string'),
            new Column('price','money'),
        ];
    }

    //Relationships
    public function orders() {
        return $this->belongsToMany('App\Order');
    }


}
