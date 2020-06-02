<?php

namespace App\Models;

use App\Services\Column;
use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    //Constants
    const TYPE = ['Bug','Improvement'];
    const PRIORITY =['Very Low','Low','Medium','High','Very High','Critical'];
    const STATUS = ['Ready','In Progress','Done'];

    //Appends
    protected $appends = array("priorityDesc","statusDesc","typeDesc");

    public function getPriorityDescAttribute()
    {
        return self::PRIORITY[$this->priority];
    }

    public function getStatusDescAttribute()
    {
        return self::STATUS[$this->status];
    }

    public function getTypeDescAttribute()
    {
        return self::TYPE[$this->type];
    }


    //columns management
    public function getPropertiesShow()
    {
        return [
            new Column('title','string'),
            new Column(['name' => 'typesDesc','label' => 'Type'],'string'),
            new Column('description','string'),
            new Column(['name' => 'priorityDesc','label' => 'Priority'],'string'),
            new Column(['name' => 'statusDesc','label' => 'status'],'string'),
            new Column('status','ok'),
        ];
    }

    public function getPropertiesCreate()
    {
        return [
            new Column('title','string'),
            new Column('type','select',$this->model::TYPE),
            new Column('description','text'),
            new Column('priority','select',$this->model::PRIORITY),
            new Column('status','select',$this->model::STATUS),
        ];
    }

    public function getPropertiesEdit()
    {
        return [
            new Column('title','string'),
            new Column('type','select',$this->model::TYPE),
            new Column('description','text'),
            new Column('priority','select',$this->model::PRIORITY),
            new Column('status','select',$this->model::STATUS),
        ];
    }




}
