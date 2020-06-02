<?php

namespace App\Models;

use App\Services\Column;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //Constants

    //Appends

    //columns management
    public function getPropertiesShow()
    {
        return [
            new Column('name','string'),
            new Column('address','string'),
            new Column('nick','string'),
            new Column('contact','string'),
            new Column('notes','text'),
        ];
    }

    public function getPropertiesEdit()
    {
        return $this->getPropertiesShow();
    }
    public function getPropertiesCreate()
    {
        return $this->getPropertiesEdit();
    }

    //Relationships
    public function order() {
        return $this->hasMany('App\Orders');
    }
}
