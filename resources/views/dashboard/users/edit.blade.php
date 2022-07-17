@extends('layouts.admin.app')

@section('content')
    
<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('site.edit_users') }}</h3>
            <a class="btn btn-info" href="{{route('dashboard.users.index')}}">{{ trans('site.back') }}</a>


        </div>

        <div class="box-body">

            @include('admin.partials._errors')
            
            <form action="{{route('dashboard.users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{method_field('put')}}
                <div class="form-group">
                  <label class="control-label">{{ trans('site.First_name') }}</label>
                  <input class="form-control" name="first_name" type="text" value="{{$user->first_name}}">
                </div>

                <div class="form-group">
                    <label class="control-label">{{ trans('site.Last_name') }}</label>
                    <input class="form-control" name="last_name" type="text" value="{{$user->last_name}}">
                  </div>


                <div class="form-group">
                  <label class="control-label">{{ trans('site.email') }}</label>
                  <input class="form-control" name="email" type="email" value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label>@lang('site.image')</label>
                    <input type="file" name="image" class="form-control image">
                </div>
  
  
                    <div class="form-group">
                      <img src="{{ asset('uploads/users/' . $user->image) }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
                  </div>
  
           
                  <div class="form-group">
                    <label>@lang('site.permissions')</label>
                    <div class="nav-tabs-custom">   

                        @php
                        $models = ['users','categories','clients','products','orders'];
                        $maps = ['create', 'read', 'update', 'delete'];
                    @endphp

          
                    <ul class="nav nav-tabs">
                        @foreach ($models as $index=>$model)
                            <li class="nav-item"><a class="{{ $index == 0 ? 'nav-link active' : 'nav-link ' }}" data-toggle="tab" href="#{{ $model }}" >{{ trans('site.' . $model) }}</a></li>
                        @endforeach
                    </ul>


                        <div class="tab-content">

                            @foreach ($models as $index=>$model)

                                <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                    @foreach ($maps as $map)
                                        <label><input type="checkbox" name="permissions[]" {{$user->isAbleTo($map . '_' . $model) ? 'checked' : ''}} value="{{ $map . '_' . $model }}"> @lang('site.' . $map)</label>
                                    @endforeach

                                </div>

                            @endforeach

                        </div><!-- end of tab content -->
                        
                    </div><!-- end of nav tabs -->
                    
                </div>


                
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> {{ trans('site.update') }}</button>
                
                  </div>
                </div>
              </form>

        </div>

    </div>


</section>

@endsection