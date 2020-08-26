<li class="dropdown notifications-menu notification-dropdown">
    <a href="#" class="dropdown-toggle mark-as-read" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        @if(\App\Models\User::find(auth()->user()->getAuthIdentifier())->unreadNotifications->count())
            <span class="label label-danger">{{\App\Models\User::find(auth()->user()->getAuthIdentifier())->unreadNotifications->count()}}</span>
        @endif
    </a>
    <ul class="dropdown-menu">
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                @forelse(auth()->user()->notifications as $notification)
                <li>
                    @if($notification->type == 'App\Notifications\Order\OrderCreated')
                        <a href="{{route('ch-admin.order.show', [$notification->data['id']])}}">
                            <i class="fa fa-shopping-cart text-aqua"></i> You have a new Order (#{{$notification->data['id']}})
                        </a>
                    @endif

                        @if($notification->type == 'App\Notifications\Order\MessageAdded')
                            <a href="{{route('ch-admin.order.messages', [$notification->data['order_id']])}}">
                                <i class="fa fa-envelope text-aqua"></i> You have new message in Order#{{$notification->data['order_id']}}
                            </a>
                        @endif
                </li>
                @empty
                    <li>
                        <a href="#">
                            <i class="fa fa-search text-aqua"></i> No new notifications.
                        </a>
                    </li>
                @endforelse
            </ul>
        </li>
        <li class="footer"><a href="#" class="clear-notifications">Clear Notifications</a></li>
    </ul>
</li>