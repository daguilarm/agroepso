@if(auth()->user()->can('view certificate') && getClient('module.certificates'))
    <li class="nav-item dropdown">

        {!! Html::dropdown(trans_title('certificates', 'plural'), ($section === 'certificates')) !!}

        <div class="dropdown-menu" aria-labelledby="navbarDropdownCertificates">

            @can('create certificate')
                <a href="{{ route('dashboard.certificates.create') }}" class="dropdown-item">{!! icon('new', trans('buttons.add')) !!}</a>
            @endcan

            <a href="{{ route('dashboard.certificates.index') }}" class="dropdown-item">{!! icon('list', trans('navbar.list')) !!}</a>

        </div>
    </li>
@endif
