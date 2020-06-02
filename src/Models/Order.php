<?php

namespace App\Models;

use App\Services\Column;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //Constants
    const STATUS = ['NOT PAYED','PAYED'];

    //Appends
    protected $appends = array("statusDesc");

    public function getStatusDescAttribute()
    {
        return self::STATUS[$this->status];
    }


    //columns management
    public function getPropertiesShow()
    {
        return [
            new Column('client','name'),
            new Column('products','money'),
            new Column('price_to_pay','money'),
            new Column('status','string'),
            new Column('notes','string'),
        ];
    }

    public function getPropertiesEdit()
    {
        return [
            new Column('products','multiple',Product::select('id','name')->get()),
            new Column('price_to_pay','money'),
            new Column('missing_price','string'),
            new Column('status','select',$this->model::STATUS),
        ];
    }
    public function getPropertiesCreate()
    {
        return [
            new Column('client_id','selectForeign',Client::select("id","name")->get())
        ];
    }

    //Relationships
    public function client() {
        return $this->belongsTo('App\Models\Client','client_id','id');
    }

    public function products() {
        return $this->belongsToMany(
            'App\Models\Product',
            'product_orders',
            'order_id',
            'product_id');
    }



}
