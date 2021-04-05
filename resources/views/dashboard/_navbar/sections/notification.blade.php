{{-- Notification Menu --}}
<li class="dropdown">
    <a class="app-nav__item icon-reset" href="#" data-toggle="dropdown" aria-label="Show notifications">
        <span class="fa-layers fa-2x">
            <i class="fas fa-envelope"></i>
            <span class="fa-layers-counter" style="background:Tomato">{{ $notifications['total'] }}</span>
        </span>
    </a>
    <ul class="app-notification dropdown-menu dropdown-menu-right">
        <li class="app-notification__title">@lang('notifications.message', ['message' => $notifications['total']])</li>
            <div class="app-notification__content">
                @foreach($notifications['messages'] as $message)
                    <li>
                        {{--<a class="app-notification__item" href="#"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span></a>--}}
                        <a class="app-notification__item" href="#"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                            <div>
                                <p class="app-notification__message">{{ $message->name }} le envió un email</p>
                                <p class="app-notification__meta">@lang('notifications.time', ['time' => $notifications['time'] ?? rand(1, 10)])</p>
                            </div>
                        </a>
                    </li>
                @endforeach
            </div>
        <li class="app-notification__footer"><a href="#">@lang('notifications.all')</a></li>
    </ul>
</li>