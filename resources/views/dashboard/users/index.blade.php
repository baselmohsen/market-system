@extends('layouts.admin.app')

@section('content')
    
    <section class="content">

        <div class="box box-primary">

            <div class="box-header d-flex justify-content-between mb-2">
                <h3 class="box-title">{{ trans('site.users') }} <small>{{$users->count()}}</small></h3>
            </div>

            <form action="">
              <div class="row mb-2">

                <div class="col-md-4">
                  <input type="text" name="search" class="form-control" placeholder="{{ trans('site.search') }} " value="{{ request()->search }}">

                </div>

                <div class="col-md-4">
                  
                  <button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i>{{ trans('site.search') }}</button>
                  @if (auth()->user()->isAbleTo('create_users'))
                  <a class="btn btn-primary" href="{{route('dashboard.users.create')}}"><i class="fa fa-plus"></i>{{ trans('site.add') }}</a>
  
                  @else
                  <a class="btn btn-primary disabled" href="3"><i class="fa fa-plus"></i>{{ trans('site.add') }}</a>
 
                  @endif

                </div>

              </div>

            </form>

            <div class="box-body">
                @if ($users->count() > 0)
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>{{ trans('site.image') }}</th>
                        <th>{{ trans('site.First_name') }}</th>
                        <th>{{ trans('site.Last_name') }}</th>
                        <th>{{ trans('site.email') }}</th>
                        <th>{{ trans('site.actions') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index=>$item)
                        <tr>
                          <td>{{$index+1}}</td>
                          <td>
                            <img src="{{asset('uploads/users/' . $item->image)}}" width="50px" alt="img">
                          </td>
                          <td>{{$item->first_name}}</td>
                          <td>{{$item->last_name}}</td>
                          <td>{{$item->email}}</td>
                          <td>
                            @if (auth()->user()->isAbleTo('update_users'))
                            <a class="btn btn-info btn-sm" href="{{route('dashboard.users.edit',$item->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              {{ trans('site.edit') }}</a>
                            @else
                            <a class="btn btn-info btn-sm disabled" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              {{ trans('site.edit') }}</a>
                            @endif

                            @if (auth()->user()->isAbleTo('delete_users'))
                            <form action="{{ route('dashboard.users.destroy', $item->id) }}" method="post" style="display: inline-block">
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
                      {{ $users->appends(request()->query())->links() }}
                    </ul>
                  </div>
                @else
                    <h2>{{ trans('site.no_data_found') }}</h2>
                @endif

                </div>

        </div>


    </section>

@endsection