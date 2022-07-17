@extends('layouts.admin.app')

@section('content')
    
<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('site.edit_clients') }}</h3>
            <a class="btn btn-info" href="{{route('dashboard.clients.index')}}">{{ trans('site.back') }}</a>


        </div>

        <div class="box-body">

            @include('admin.partials._errors')
            
            <form action="{{route('dashboard.clients.update',$client->id)}}" method="POST" >
                
                @csrf
                {{method_field('put')}}

                <div class="form-group">
                    <label class="control-label">{{ trans('site.name') }}</label>
                    <input class="form-control" name="name" type="text" value="{{$client->name}}">
                  </div>

                  <div class="form-group">
                    <label class="control-label">{{ trans('site.phone') }}</label>
                    <input class="form-control" name="phone" type="text" value="{{$client->phone}}">
                  </div>

                  <div class="form-group">
                    <label class="control-label">{{ trans('site.address') }}</label>
                    <input class="form-control" name="address" type="text" value="{{$client->address}}">
                  </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-blus"></i> {{ trans('site.edit') }}</button>
                
                  </div>
                </div>
              </form>

        </div>

    </div>


</section>

@endsection