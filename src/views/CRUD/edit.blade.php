@extends('crud::base')
@section('main')
    <div class="row">
        <div class="col-sm-12">
            <div style="font-weight: bold;font-size: 21px;text-align: center">Update a {{ucfirst($resource)}}</div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <form method="post" action="{{ route($resource.'.update', $item->id) }}">
                @method('PATCH')
                @csrf

                @foreach($properties as $property)
                    <div class="hidden"> {{$propertyName = $property->getName()}}</div>
                    @switch($property->getType())
                        @case('image')
                        <div class="form-group">
                            <label for="{{$property->getName()}}">{{ucfirst($property->getName())}}:</label>
                            <img src="{{$item->$propertyName}}" width="200px"></img>
                        </div>
                        @break
                        @case('string')
                        <div class="form-group">
                            <label for="{{$property->getName()}}">{{ucfirst($property->getName())}}:</label>

                            <input type="text" class="form-control" name="{{$property->getName()}}" value="{{$item->$propertyName}}"/>
                        </div>
                        @break
                        @case('text')
                        <div class="form-group">
                            <label for="{{$property->getName()}}">{{ucfirst($property->getName())}}:</label>
                            <textarea class="form-control" name="{{$property->getName()}}">{{$item->$propertyName}}</textarea>
                        </div>
                        @break
                        @case('select')
                        <div class="form-group">
                            <label for="{{$property->getName()}}">{{ucfirst($property->getName())}}:</label>
                            <select class="form-control" id="{{$property->getName()}}" name="{{$property->getName()}}">
                                @foreach($property->getValues() as $value)
                                    <option value="{{$loop->index}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        @break
                        @default
                            <div class="form-group">
                                <label for="{{$property->getName()}}">{{ucfirst($property->getName())}}:</label>

                                <input type="text" class="form-control" name="{{$property->getName()}}" value="{{$item->$propertyName}}"/>
                            </div>
                        @break
                    @endswitch
                @endforeach

                <button type="submit" class="btn btn-primary f-r">Update</button>
            </form>
        </div>
    </div>
@endsection
