<?php
$migration = "<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ".$class." extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('".$table."', function (Blueprint ".'$table'.") {
            ".'$table->id();'."
            ";

foreach ($elements as $element) {
    $migration = $migration.$element;
}
$migration = $migration.'
            $table->timestamps();
        });
    }'."

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('".$table."');
    }
}
";
