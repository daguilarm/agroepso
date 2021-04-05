@if(Credentials::God())
    <li class="dropdown"><a class="app-nav__item icon-reset" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">{!! icon('administration::configs', null, 'fa-2x') !!}</a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li>
                <a href="{{ route('dashboard.tools.cities.index') }}"  class="dropdown-item">
                    {!! icon('administration::countries', trans_title('cities', 'plural'), $addClass = 'app-menu__icon') !!}
                    <span class="app-menu__label">{{ trans('') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.tools.crops.index') }}"  class="dropdown-item">
                    {!! icon('administration::crops', trans_title('crops', 'plural'), $addClass = 'app-menu__icon') !!}
                    <span class="app-menu__label">{{ trans('') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.tools.biocides.index') }}"  class="dropdown-item">
                    {!! icon('administration::biocides', trans_title('biocides', 'plural'), $addClass = 'app-menu__icon') !!}
                    <span class="app-menu__label">{{ trans('') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.tools.modules.index') }}"  class="dropdown-item">
                    {!! icon('administration::modules', trans_title('modules', 'plural'), $addClass = 'app-menu__icon') !!}
                    <span class="app-menu__label">{{ trans('') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.tools.options.index') }}"  class="dropdown-item">
                    {!! icon('administration::options', trans_title('options', 'plural'), $addClass = 'app-menu__icon') !!}
                    <span class="app-menu__label">{{ trans('') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.tools.roles.index') }}" class="dropdown-item">
                    {!! icon('roles', trans_title('roles', 'plural'), $addClass = 'app-menu__icon') !!}
                    <span class="app-menu__label">{{ trans('') }}</span>
                </a>
            </li>

            <li class="dropdown-divider"></li>

            <li>
                <a href="{{ route('log-viewer::dashboard') }}" class="dropdown-item">
                    <i class="fas fa-cog"></i> Logs Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('log-viewer::logs.list') }}" class="dropdown-item">
                    <i class="fas fa-archive"></i> Logs
                </a>
            </li>

            <li class="dropdown-divider"></li>

            <li>
                <a href="{{ route('dashboard.tools.seed') }}" class="dropdown-item">
                    <i class="fas fa-archive"></i> Seed
                </a>
            </li>

            <li class="dropdown-divider"></li>

            @foreach(get_roles() as $role)
                <li>
                    <a href="{{ route('dashboard.tools.roles.change', $role) }}" class="dropdown-item">
                        {!! icon('arrow-right') !!}
                        <span class="app-menu__label">{{ strtoupper($role) }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
@endif
