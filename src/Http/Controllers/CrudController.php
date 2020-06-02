<?php

namespace xbugs\crud\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CrudController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $resource;
    protected $validateRules;
    protected $model;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list
        $list = $this->model->all();
        //return list view
        return view($this->getViewFolder().".index",[
            'list' => $list,
            'properties' => $this->model->getPropertiesShow(),
            'resource' => $this->resource
        ]);
    }


    public function getViewFolder() {
        return "crud::CRUD";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return create view
        return view($this->getViewFolder().'.create',[
            'properties' => $this->model->getPropertiesCreate(),
            'resource' => $this->resource
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $request->validate($this->validateRules);

        //store data
        $item = new get_class($this->model);
        foreach ($this->model->getPropertiesCreate() as $property) {
            $propertyName = $property->getName();
            $item->$propertyName = $request->get($propertyName);
        }
        $item->save();

        //redirect to list
        return redirect('/'.$this->resource)->with('success', ucfirst($this->resource).' saved!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get object
        $item = $this->service->getById($id);

        //return show view
        return view($this->getViewFolder().'.show', [
            'item' => $item,
            'properties' => $this->service->getPropertiesShow(),
            'resource' => $this->resource
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get object
        $item = $this->service->getById($id);
        //return edit view
        return view($this->getViewFolder().'.edit', [
            'item' => $item,
            'properties' => $this->service->getPropertiesEdit(),
            'resource' => $this->resource
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate
        $request->validate($this->validateRules);

        //edit data
        $item = $this->service->getById($id);
        foreach ($this->service->getPropertiesEdit() as $property) {
            $propertyName = $property->getName();
            $item->$propertyName = $request->get($propertyName);
        }
        $item->save();

        //redirect to list
        return redirect('/'.$this->resource)->with('success', ucfirst($this->resource).' updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //delete resource
        $item = $this->service->getById($id);
        $item->delete();

        //redirect to list
        return redirect('/'.$this->resource)->with('success', ucfirst($this->resource).' deleted!');

    }
}
