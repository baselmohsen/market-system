@extends('layouts.admin.app')

@section('content')
    
    <section class="content">

        <div class="box box-primary">

            <div class="box-header d-flex justify-content-between mb-2">
                <h3 class="box-title">{{ trans('site.categories') }} <small>{{$categories->count()}}</small></h3>
            </div>

            <form action="">
              <div class="row mb-2">

                <div class="col-md-4">
                  <input type="text" name="search" class="form-control" placeholder="{{ trans('site.search') }} " value="{{ request()->search }}">

                </div>

                <div class="col-md-4">
                  
                  <button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i>{{ trans('site.search') }}</button>
                  @if (auth()->user()->isAbleTo('create_categories'))
                  <a class="btn btn-primary" href="{{route('dashboard.categories.create')}}"><i class="fa fa-plus"></i>{{ trans('site.add') }}</a>

                  @else
                  <a class="btn btn-primary disabled" href="3"><i class="fa fa-plus"></i>{{ trans('site.add') }}</a>

                  @endif

                </div>

              </div>

            </form>

            <div class="box-body">
                @if ($categories->count() > 0)
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>{{ trans('site.name') }}</th>
                        <th>{{ trans('site.products_count') }}</th>
                        <th>{{ trans('site.related_products') }}</th>
                        <th>{{ trans('site.actions') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index=>$item)
                        <tr>
                          <td>{{$index+1}}</td>
                       
                          <td>{{$item->name}}</td>
                          <td>{{$item->products->count()}}</td>
                          <td><a href="{{route('dashboard.products.index',['category_id'=>$item->id])}}" class="btn btn-info btn-sm">{{ trans('site.related_products') }}</a></td>
                       
                          <td>
                            @if (auth()->user()->isAbleTo('update_categories'))
                            <a class="btn btn-info btn-sm" href="{{route('dashboard.categories.edit',$item->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              {{ trans('site.edit') }}</a>
                            @else
                            <a class="btn btn-info btn-sm disabled" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              {{ trans('site.edit') }}</a>
                            @endif

                            @if (auth()->user()->isAbleTo('delete_categories'))
                            <form action="{{ route('dashboard.categories.destroy', $item->id) }}" method="post" style="display: inline-block">
                              {{ csrf_field() }}
                              {{ method_field('delete') }}
                              <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                          </form>
                            @else
                            <a class="btn btn-danger btn-sm disabled" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i>
                              {{ trans('site.delete') }}</a> 
                            @endif
                             
                              
                              
  
                          </td>
                        </tr>
                 
                        @endforeach
             
                    </tbody>
                  </table>
                  <div>
                    <ul class="pagination">
                      {{ $categories->appends(request()->query())->links() }}
                    </ul>
                  </div>
                @else
                    <h2>{{ trans('site.no_data_found') }}</h2>
                @endif

                </div>

        </div>


    </section>

@endsection