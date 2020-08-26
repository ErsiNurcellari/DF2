<div class="panel panel-default">
    <div class="panel-heading">@lang('nav-title')</div>

    <div class="panel-body account-menu-ctn">
        <ul class="account-menu">
            <li><a href="{{route('home')}}">@lang('menu.home')</a></li>
            <li><a href="{{route('ch_edit_details')}}">@lang('menu.account-details')</a></li>
            <li><a href="{{route('ch_user_orders')}}">@lang('menu.orders')</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-account').submit();">@lang('menu.logout')</a>
                <form id="logout-form-account" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</div>