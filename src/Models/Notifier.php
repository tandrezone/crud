<?php

namespace App\Models;

use App\Services\Column;
use Illuminate\Database\Eloquent\Model;

class Notifier extends Model
{
    //Constants

    //Appends

    //columns management
    public function getPropertiesShow()
    {
        return [
            new Column('email','string'),
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
}
