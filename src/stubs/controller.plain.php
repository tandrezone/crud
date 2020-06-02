<?php
$controller = "<?php

namespace App\Http\Controllers;

use Xbugs\Crud\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use App\Models\\".$model.";";

$controller .= "
class ".$class." extends CrudController
{
    public function __construct( ".$model." ".'$model'.")
    {
    ";
$controller .= '
$this->model = $model;';
$controller .= '
        $this->resource = "'.strtolower($model).'";';
$controller .= '
        $this->validateRules ='.$validation.";";
$controller .= '
    }
}';
