@include(component_path('messages'))

{{-- Form --}}
<div class="col-md-12" id="form-container">
    <div class="tile">
        <div class="tile-body">
                {{ html()
                    ->form('POST', route('dashboard.' . $section . '.excel.store'))
                    ->attribute('enctype', 'multipart/form-data')
                    ->id('form-excel')
                    ->open()
                }}
                    {{-- Title --}}
                    {!! Form::formTitle('download', trans('excel.title')) !!}

                    <div class="row my-5" id="text-info">
                        {{-- Instructions --}}
                        <div class="col-12 mx-4 mt-2 mb-4">
                            <li>{{ trans('excel.file') }}: <a href="{{ route('dashboard.download.excel', $file) }}" class="btn btn-warning ml-2" id="download-excel">{!! icon('download') !!}</a></li>
                            @foreach(trans('excel.instructions') as $key => $value)
                                <li>{!! $value !!}.</li>
                            @endforeach
                        </div>

                        {{-- Image --}}
                        <div class="row justify-content-md-center my-4">
                            <div class="col-11">
                                <img src="{{ mix('img/examples/' . $thumbnail) }}" class="img-fluid rounded border">
                            </div>
                        </div>

                        {{-- Fields explanation --}}
                        <div class="card m-4">
                            <div class="card-header bg-warning">{!! icon('info', trans('excel.columns')) !!}</div>
                            <div class="card-body bg-light">
                                <div class="row">
                                    @foreach($instructions as $item)
                                        <div class="col-12 col-md-3 mt-3"><strong>{{ $item[0] }}</strong>: {!! $item[1] !!}.</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Client ID base on role --}}
                        @if(Credentials::isAdmin())
                            <div class="form-group col-12 col-md-4">
                                <label class="control-label">{{ trans_title('clients') }}</label>
                                {{ html()->select('client_id')->class('form-control')->options($clients ?? [])->required() }}
                            </div>
                        @else
                            {{ html()->hidden('client_id')->value(Credentials::client()) }}
                        @endif

                        {{-- Customize forms --}}
                        {{ $customForms ?? null }}
                    </div>

                    <div class="row">
                        {{-- The excel file --}}
                        <div class="form-group col-12 col-md-4">
                            {{ html()->file('upload_excel')->required() }}
                        </div>

                        <div class="form-group col-12">
                            {{-- Submit button --}}
                            {!! Form::excelButtons() !!}
                        </div>
                    </div>

                {{ html()->closeModelForm() }}
        </div>
    </div>
</div>
