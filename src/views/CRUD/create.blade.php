@extends('crud::base')

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <div style="font-weight: bold;font-size: 21px;text-align: center">Add a {{ucfirst($resource)}}</div>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ route($resource.'.store') }}">
                    @csrf
                    @foreach($properties as $property)
                        @switch($property->getType())
                            @case('string')
                            <div class="form-group">
                                <label for="{{$property->getName()}}">{{ucfirst($property->getName())}}:</label>
                                <input type="text" class="form-control" name="{{$property->getName()}}"/>
                            </div>
                        @break
                            @case('number')
                            <div class="form-group">
                                <label for="{{$property->getName()}}">{{ucfirst($property->getName())}}:</label>
                                <input type="number" class="form-control" step="1" name="{{$property->getName()}}"/>
                            </div>
                            @break
                            @case('money')
                            <div class="form-group">
                                <label for="{{$property->getName()}}">{{ucfirst($property->getName())}}:</label>
                                <input type="number" class="form-control" step="1" name="{{$property->getName()}}"/>
                            </div>
                            @break
                            @case('text')
                            <div class="form-group">
                                <label for="{{$property->getName()}}">{{ucfirst($property->getName())}}:</label>
                                <textarea class="form-control" name="{{$property->getName()}}"></textarea>
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

                            @case('selectForeign')
                            <div class="form-group">
                                <label for="{{$property->getName()}}">{{ucfirst($property->getName())}}:</label>
                                <select class="form-control" id="{{$property->getName()}}" name="{{$property->getName()}}">
                                    @foreach($property->getValues() as $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
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


                    <button type="submit" class="btn btn-primary f-r" >Add a {{ucfirst($resource)}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
