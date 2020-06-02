@extends('crud::base')

@section('main')
    <div class="col-sm-12">

        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>

    <div class="row px-x" >
        <div class="col-sm-12">
            <h2>{{ucfirst($resource)}}</h2>
            @if(sizeof($list) != 0)
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    @foreach($properties as $property)
                        <td>{{ucfirst($property->getLabel())}}</td>
                    @endforeach
                    <td colspan = 2>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        @foreach($properties as $property)
                            <div class="hidden"> {{$propertyName = $property->getName()}}</div>
                            @switch($property->getType())
                                @case('image')
                                <td><img src="{{$item->$propertyName}}" width="50px"/></td>
                            @break
                                @case('money')
                            @if(is_integer($item->$propertyName)) <td>{{$item->$propertyName/100}} &euro;</td> @else <td>{{$item->$propertyName}}</td> @endif
                                @break
                            @case('name')
                                <td>{{$item->$propertyName->name}}</td>
                            @break
                                @case('ok')
                                <td>
                                    @if($item->$propertyName == 1)
                                        <span class="glyphicon glyphicon-ok" style="color:green" aria-hidden="true"></span>
                                    @else
                                        <span style="color:red" class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    @endif
                                </td>
                                @break
                            @default
                                <td>{{$item->$propertyName}}</td>
                            @break
                            @endswitch


                        @endforeach
                        <td>
                            <a href="{{ route($resource.'.edit',$item->id)}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                        </td>
                        <td>
                            <form action="{{ route($resource.'.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button style="box-shadow: 0px 0px 0px transparent;border: 0px solid transparent;background: rgba(0,0,0,0)"><span class="glyphicon glyphicon-trash" style="color:red;cursor:pointer" aria-hidden="true"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <div>There are no {{$resource}}s</div>
            @endif
            <div>
            </div>
            <div>
                <a style="margin: 19px;" href="{{ route($resource.'.create')}}" class="btn btn-primary f-r">New {{$resource}}</a>
            </div>
@endsection
