<?php

namespace xbugs\crud\Commands;

use Illuminate\Console\Command;

class CreateCrud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Crud';

    protected $items;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $class = $this->argument('name');
        $table = $class . "s";
        $elements = [];
        $this->items = [];


        //migration
        $this->info("This is the interactive migration creator, to stop adding more properties write exit()");
        $name = $this->ask("Name?");
        do {
            $type = $this->ask("Type? can be string or integer");
            $nullable = $this->ask("Nullable? 1 for nullable, 0 for not null");
            $item = new \stdClass();
            $item->type = $type;
            $item->name = $name;
            $item->nullable = 0;
            $property = '$table->' . $type . '("' . $name . '")';
            if ($nullable == 1) {
                $property .= "->nullable()";
                $item->nullable = 1;
            }
            $show = $this->ask("This property gonna show on the list, 1 to show");
            $item->show = $show;
            $edit = $this->ask("You are able to edit this property, 1 to edit");
            $item->edit = $edit;
            $validation = $this->ask("Any validation? write the validation ex: required");
            $item->validation = $validation;
            $this->info(" Gonna add this to the migration you can edit if you want later " . $property);
            $elements[] = $property.";";
            $this->items[] = $item;
            $name = $this->ask("Name? or exit to exit");
        } while ($name != "exit");
        require_once(__DIR__ . "/../stubs/migration.create.php");
        file_put_contents(app_path() . "/../database/migrations/".date('Y_m_d_His')."_create_".$class."s_table.php",$migration);

        //model
        $showps = [];
        $editps = [];
        $createps = [];
        $class = ucfirst($class);
        foreach ($this->items as $item){
            if($item->show){
                $showps[] = $item;
            }
            if($item->edit){
                $editps[] = $item;
                $createps[] = $item;
            }
        }
        require_once(__DIR__ . "/../stubs/model.php");
        file_put_contents(app_path() . "/Models/".ucfirst($class).".php",$model);
        $class = strtolower($class);
        $model = ucfirst($class);
        $resource = strtolower($model);
        $class = $class."Controller";
        $validations =[];
        foreach ($this->items as $item){
            if($item->validation) {
                $validations[] = $item->name."' =>'".$item->validation;
            }
        }
        $val = implode(", ",$validations);
        $validationF = "[ '";
        $validationL = "']";
        $validation = $validationF.$val.$validationL;
        require_once(__DIR__ . "/../stubs/controller.plain.php");
        file_put_contents(app_path() . "/Http/Controllers/".$class.".php",$controller);
        $route = "Route::resource('".$resource."', '".$class."');";
        file_put_contents(app_path() . "/../routes/web.php",$route,FILE_APPEND);

    }
}
