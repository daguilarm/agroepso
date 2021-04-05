@if(auth()->user()->can('view label') && getClient('module.labels'))
    <li class="nav-item dropdown">

        {!! Html::dropdown('Etiquetas', ($section === 'labels')) !!}

        <div class="dropdown-menu" aria-labelledby="navbarDropdownInspections">

            @can('create label')
                <a href="{{ route('dashboard.labels.create') }}" class="dropdown-item">{!! icon('new', trans('buttons.add')) !!}</a>
            @endcan

            @can('view label')
                <a href="{{ route('dashboard.labels.index') }}" class="dropdown-item">{!! icon('list', trans('navbar.list')) !!}</a>
            @endcan

        </div>
    </li>
@endif
