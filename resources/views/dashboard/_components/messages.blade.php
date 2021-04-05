<div class="app-title">
    <div class="container">
        <div class="row" id="alerts-container">

            {{-- Check for errors --}}
            @if(isset($errors) && $errors->any())
                {{-- Alert --}}
                @component(component_path('alerts'))
                    @slot('alertType', 'danger')
                    @slot('alertBody')
                        <h4>{!! icon('error', trans('alerts.errors.title')) !!}</h4>
                        <br>
                        @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    @endslot
                @endcomponent
            @endif

            {{-- Check for update responses --}}
            @if(session()->has('updated'))
                {{-- Alert --}}
                @component(component_path('alerts'))
                    @slot('alertType', 'success')
                    @slot('alertBody')
                        <h4>{!! icon('success', trans('alerts.updated.title')) !!}</h4>
                        <br>
                        {{ session('updated') }}
                    @endslot
                @endcomponent
            @endif

            {{-- Check for success responses --}}
            @if(session()->has('success'))
                {{-- Alert --}}
                @component(component_path('alerts'))
                    @slot('alertType', 'success')
                    @slot('alertBody')
                        <h4>{!! icon('success', trans('alerts.success.title')) !!}</h4>
                        <br>
                        {{ session('success') }}
                    @endslot
                @endcomponent
            @endif

        </div>
    </div>
</div>
