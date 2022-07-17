@extends('layouts.admin.app')

@section('content')
    
<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('site.edit_categories') }}</h3>
            <a class="btn btn-info" href="{{route('dashboard.categories.index')}}">{{ trans('site.back') }}</a>


        </div>

        <div class="box-body">

            @include('admin.partials._errors')
            
            <form action="{{route('dashboard.categories.update',$category->id)}}" method="POST" >
                
                @csrf
                {{method_field('put')}}

                @foreach (config('translatable.locales') as $locale)
                <div class="form-group">
                    <label>@lang('site.' . $locale . '.name')</label>
                    <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ $category->translate($locale)->name}}">
                </div>
                @endforeach       
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-blus"></i> {{ trans('site.edit') }}</button>
                
                  </div>
                </div>
              </form>

        </div>

    </div>


</section>

@endsection