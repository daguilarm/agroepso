{{-- Tab systen: links --}}
<ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#data" aria-expanded="true">{{ sections('clients.tabs.data') }}</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#modules" aria-expanded="true">{{ sections('clients.tabs.modules') }}</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#regions" aria-expanded="true">{{ sections('clients.tabs.regions') }}</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#options" aria-expanded="true">{{ sections('clients.tabs.options') }}</a></li>
</ul>
{{-- Tab systen: containers --}}
<div class="tab-content" id="tabs">
    <div class="tab-pane fade active show p-3" id="data" aria-expanded="true">
        @include(dashboard_path($section . '.forms.client')) 
        <hr>
        @include(dashboard_path($section . '.forms.crops'))     
        <hr>
        @include(dashboard_path($section . '.forms.logo'))    
    </div>
    <div class="tab-pane fade p-3" id="regions" aria-expanded="true">
        @include(dashboard_path($section . '.forms.regions'))  
    </div>
    <div class="tab-pane fade p-3" id="modules" aria-expanded="true">
        @include(dashboard_path($section . '.forms.modules'))  
    </div>
    <div class="tab-pane fade p-3" id="options" aria-expanded="true">
        @include(dashboard_path($section . '.forms.agronomics')) 
    </div>
</div>

{{-- Form footer --}}
{!! Form::footerButtons($data ?? null) !!}