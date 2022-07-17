@extends('layouts.admin.app')

@section('content')
    <div class="container">

   
        {{-- <div class="app-title">
          <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            <p>A free and open source Bootstrap 4 admin template</p>
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          </ul>
        </div> --}}
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-list fa-3x"></i>
              <div class="info">
                <h4> {{ trans('site.categories') }}</h4>
                <p><b>{{$categories}}</b></p>
                <a  href="{{route('dashboard.categories.index')}}" class="small-box-footer">{{ trans('site.show') }}<i class="fa fa-arrow-circle-right"></i></a>

              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-bars fa-3x"></i>
              <div class="info">
                <h4>{{ trans('site.products') }}</h4>
                <p><b>{{$products}}</b></p>
                <a  href="{{route('dashboard.products.index')}}" class="small-box-footer">{{ trans('site.show') }}<i class="fa fa-arrow-circle-right"></i></a>

              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>{{ trans('site.clients') }}</h4>
                <p><b>{{$clients}}</b></p>
                <a  href="{{route('dashboard.clients.index')}}" class="small-box-footer">{{ trans('site.show') }}<i class="fa fa-arrow-circle-right"></i></a>

              </div>
            </div>

          </div>
          <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-user fa-3x"></i>
              <div class="info">
                <h4>{{ trans('site.users') }}</h4>
                <p><b>{{$users}}</b></p>
                <a  href="{{route('dashboard.users.index')}}" class="small-box-footer">{{ trans('site.show') }}<i class="fa fa-arrow-circle-right"></i></a>

              </div>
            </div>
          </div>

          {{-- <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-user fa-3x"></i>
              <div class="info">
                <h4>{{ trans('site.orders') }}</h4>
                <p><b>{{$orders}}</b></p>
                <a  href="{{route('dashboard.orders.index')}}" class="small-box-footer">{{ trans('site.show') }}<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div> --}}

        </div>

   


    </div>
