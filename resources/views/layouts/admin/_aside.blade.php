<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{ auth()->user()->image_path }}" alt="User Image">
        <div>
            <p>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</p>
            <p class="app-sidebar__user-designation">{{ auth()->user()->roles->first()->display_name }}</p>
        </div>
    </div>

    
    <ul class="app-menu">
        
        
        <li><a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}" href="{{route('dashboard.home')}}"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">{{ trans('site.home') }}</span></a></li>
       
        @if (auth()->user()->isAbleTo('read_users'))
        <li><a class="app-menu__item {{ request()->is('*users*') ? 'active' : '' }}" href="{{route('dashboard.users.index')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">{{ trans('site.users') }}</span></a></li>     
        @endif

        @if (auth()->user()->isAbleTo('read_categories'))
        <li><a class="app-menu__item {{ request()->is('*categories*') ? 'active' : '' }}" href="{{route('dashboard.categories.index')}}"> <i class="app-menu__icon fa fa-list" aria-hidden="true"></i>
             <span class="app-menu__label"> {{   trans('site.categories') }}  </span></a></li>     
        @endif

        @if (auth()->user()->isAbleTo('read_products'))
        <li><a class="app-menu__item {{ request()->is('*products*') ? 'active' : '' }}" href="{{route('dashboard.products.index')}}"> <i class="app-menu__icon fa fa-bars" aria-hidden="true"></i>
             <span class="app-menu__label"> {{   trans('site.products') }}  </span></a></li>     
        @endif

      

        @if (auth()->user()->isAbleTo('read_clients'))
        <li><a class="app-menu__item {{ request()->is('*clients*') ? 'active' : '' }}" href="{{route('dashboard.clients.index')}}"> <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
             <span class="app-menu__label"> {{   trans('site.clients') }}  </span></a></li>     
        @endif

       

        @if (auth()->user()->isAbleTo('read_orders'))
        <li><a class="app-menu__item {{ request()->is('*orders*') ? 'active' : '' }}" href="{{route('dashboard.orders.index')}}"><i class="app-menu__icon fa fa-money" aria-hidden="true"></i>

             <span class="app-menu__label"> {{   trans('site.orders') }}  </span></a></li>     
        @endif

      

    </ul>


</aside>
