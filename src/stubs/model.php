<?php
$model = "<?php

namespace App\Models;

use App\Services\Column;
use Illuminate\Database\Eloquent\Model;

class ".$class." extends Model
{
    //Constants


    //Appends



    //columns management
    public function getPropertiesShow()
    {
        return [";
foreach ($showps as $showp){
    $model .= "new Column('".$showp->name."','".$showp->type."'),";
}
            $model .="
        ];
    }
";
$model .="
    public function getPropertiesCreate()
    {
        return [";
foreach ($createps as $createp){
    $model .= "new Column('".$createp->name."','".$createp->type."'),";
}
        $model .="];
    }";

$model .="public function getPropertiesEdit()
    {
        return [";
            foreach ($editps as $editp){
                $model .= "new Column('".$editp->name."','".$editp->type."'),";
            }
        $model .="];
    }

}";
