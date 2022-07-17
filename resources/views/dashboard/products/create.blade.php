@extends('layouts.admin.app')

@section('content')
    
<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('site.add_products') }}</h3>
            <a class="btn btn-info" href="{{route('dashboard.products.index')}}">{{ trans('site.back') }}</a>


        </div>

        <div class="box-body">

            @include('admin.partials._errors')
            
            <form action="{{route('dashboard.products.store')}}" method="POST" enctype="multipart/form-data">
                
                @csrf
                {{method_field('post')}}

                <div class="form-group">
                  <label class="control-label">{{ trans('site.category') }}</label>
                  <select class="form-control" name="category_id">
                      @foreach ($categories as $item)
                      <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach           
                    </select>
                  </div>  

                  @foreach (config('translatable.locales') as $locale)
                  <div class="form-group">
                      <label>@lang('site.' . $locale . '.name')</label>
                      <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}">
                  </div>
                  @endforeach


                  

                  @foreach (config('translatable.locales') as $locale)
                  <div class="form-group">
                      <label>@lang('site.' . $locale . '.description')</label>
                      <input type="text" name="{{ $locale }}[description]" class="form-control" value="{{ old($locale . '.description') }}">
                  </div>
                  @endforeach

                

                  <div class="form-group">
                    <label class="control-label">{{ trans('site.purchase_price') }}</label>
                    <input class="form-control" name="purchase_price" type="text" value="{{old('purchase_price')}}">
                  </div>

                  <div class="form-group">
                    <label class="control-label">{{ trans('site.sale_price') }}</label>
                    <input class="form-control" name="sale_price" type="text" value="{{old('sale_price')}}">
                  </div>

                  <div class="form-group">
                    <label class="control-label">{{ trans('site.stock') }}</label>
                    <input class="form-control" name="stock" type="text" value="{{old('stock')}}">
                  </div>

                  <div class="form-group">
                    <label>@lang('site.image')</label>
                    <input type="file" name="image" class="form-control image">
                </div>
  
  
                    <div class="form-group">
                      <img src="{{ asset('uploads/products/default.png') }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
                  </div>

  
  

            
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-blus"></i> {{ trans('site.add') }}</button>
                
                  </div>
                </div>
              </form>

        </div>

    </div>


</section>

@endsection