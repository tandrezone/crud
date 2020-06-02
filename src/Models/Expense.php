<?php

namespace App\Models;

use App\Services\Column;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

    //Constants
    const STATUS = ['NOT PAYED','PAYED'];

    //Appends
    protected $appends = array("statusDesc");

    public function getStatusDescAttribute()
    {
        return self::STATUS[$this->status];
    }

    public function getStatuses() {
        return $this->model::STATUS;
    }

    //columns management
    public function getPropertiesShow()
    {
        return [
            new Column('description','string'),
            new Column('value','money'),
            new Column(['name' =>'statusDesc','label' => 'status'],'string'),
            new Column(['name' =>'status','label' => 'State'],'ok'),
        ];
    }

    public function getPropertiesEdit()
    {
        return [
            new Column('description','string'),
            new Column('value','money'),
            new Column('status','select',$this->repository->getStatuses()),
        ];
    }

    public function getPropertiesCreate()
    {
        return $this->getPropertiesEdit();
    }

    //Relationships
}
