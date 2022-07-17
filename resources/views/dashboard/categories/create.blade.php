@extends('layouts.admin.app')

@section('content')
    
<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('site.add_categories') }}</h3>
            <a class="btn btn-info" href="{{route('dashboard.categories.index')}}">{{ trans('site.back') }}</a>


        </div>

        <div class="box-body">

            @include('admin.partials._errors')
            
            <form action="{{route('dashboard.categories.store')}}" method="POST" >
                
                @csrf
                {{method_field('post')}}

                @foreach (config('translatable.locales') as $locale)
                <div class="form-group">
                    <label>@lang('site.' . $locale . '.name')</label>
                    <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}">
                </div>
                @endforeach       
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-blus"></i> {{ trans('site.add') }}</button>
                
                  </div>
                </div>
              </form>

        </div>

    </div>


</section>

@endsection