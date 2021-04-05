@extends('dashboard._layouts._app')

@section('content')
    <main class="app-content">
        {{-- Head title --}}
        @component(component_path('head'))
             @slot('headItems', [
                'icon' => 'invoice',
            ])
            {{-- Breadcrumb items [title, link] --}}
            @slot('breadcrumbItems', [
                //['title' => trans_title($section), 'route' => route('dashboard.' . $role . '.' . $section . '.index')],
                ['title' => trans_title($section, 'plural')]
            ])
        @endcomponent

        @include(component_path('messages'))

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Planificador inspecciones</h3>
                    <table class="table table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Superficie</th>
                            <th>Latitud/X</th>
                            <th>Longitud/Y</th>
                            <th>Municipio</th>
                            <th>Provincia</th>
                            <th>Contacto</th>
                            <th>Últ. inspección</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>143-1</td>
                                <td>1,30 Ha</td>
                                <td>689858</td>
                                <td>4230001,77</td>
                                <td>Elche</td>
                                <td>Alicante</td>
                                <td>
                                    <div>Telf: XXX-XXX-XXX</div>
                                    <div>Sr/Sra: XXXXX XXXXX</div>
                                </td>
                                <td>10/04/2017</td>
                                <td>
                                    <a href="{{ route('dashboard.dop.surveyors.show', 1) }}" class="btn btn-success">{!! icon('invoice') !!}</a> 
                                    <button class="btn btn-warning">{!! icon('edit') !!}</button>
                                    <button class="btn btn-info">{!! icon('info') !!}</button>
                                </td>
                            </tr>
                            <tr>
                                <td>143-2</td>
                                <td>2,28 Ha</td>
                                <td>689136,09</td>
                                <td>4229300,65</td>
                                <td>Elche</td>
                                <td>Alicante</td>
                                <td>
                                    <div>Telf: XXX-XXX-XXX</div>
                                    <div>Sr/Sra: XXXXX XXXXX</div>
                                </td>
                                <td>23/02/2017</td>
                                <td>
                                    <button class="btn btn-success">{!! icon('invoice') !!}</button> 
                                    <button class="btn btn-warning">{!! icon('edit') !!}</button>
                                    <button class="btn btn-info">{!! icon('info') !!}</button>
                                </td>
                            </tr>
                            <tr class="table-danger">
                                <td>143-3</td>
                                <td>2,17 Ha</td>
                                <td>690065,33</td>
                                <td>4228632,82</td>
                                <td>Elche</td>
                                <td>Alicante</td>
                                <td>
                                    <div>Telf: XXX-XXX-XXX</div>
                                    <div>Sr/Sra: XXXXX XXXXX</div>
                                </td>
                                <td>01/04/2017</td>
                                <td>
                                    <button class="btn btn-success">{!! icon('invoice') !!}</button> 
                                    <button class="btn btn-warning">{!! icon('edit') !!}</button>
                                    <button class="btn btn-info">{!! icon('info') !!}</button>
                                </td>
                            </tr>
                            <tr class="table-danger">
                                <td>143-4</td>
                                <td>3,44 Ha</td>
                                <td>689307,71</td>
                                <td>4229111,78</td>
                                <td>Elche</td>
                                <td>Alicante</td>
                                <td>
                                    <div>Telf: XXX-XXX-XXX</div>
                                    <div>Sr/Sra: XXXXX XXXXX</div>
                                </td>
                                <td>01/04/2017</td>
                                <td>
                                    <button class="btn btn-success">{!! icon('invoice') !!}</button> 
                                    <button class="btn btn-warning">{!! icon('edit') !!}</button>
                                    <button class="btn btn-info">{!! icon('info') !!}</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7 offset-md-5">
                <div class="tile">
                    <h3 class="tile-title">Inspecciones realizadas</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Inspector</th>
                                <th>Fecha de realización</th>
                                <th>Hora</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>143-4</td>
                                <td>XXXXX XXXXXX</td>
                                <td>12/03/2018</td>
                                <td>09:38</td>
                                <td>
                                    <button class="btn btn-warning">{!! icon('edit') !!}</button>
                                </td>
                            </tr>
                            <tr>
                                <td>143-3</td>
                                <td>XXXXX XXXXXX</td>
                                <td>12/03/2018</td>
                                <td>11:20</td>
                                <td>
                                    <button class="btn btn-warning">{!! icon('edit') !!}</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 offset-md-8">
                <div class="tile">
                    <h3 class="tile-title">Información parcela 143-4</h3>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Parcela</td>
                                <td>143-4</td>
                            </tr>
                            <tr>
                                <td>Supercie</td>
                                <td>3,44 Ha</td>
                            </tr>
                            <tr>
                                <td>Latitud/X</td>
                                <td>689307,71</td>
                            </tr>
                            <tr>
                                <td>Longitud/Y</td>
                                <td>4229111,78</td>
                            </tr>
                            <tr>
                                <td>Municipio</td>
                                <td>Elche</td>
                            </tr>
                            <tr>
                                <td>Provincia</td>
                                <td>Alicante</td>
                            </tr>
                            <tr>
                                <td>Año plantación</td>
                                <td>2006</td>
                            </tr>
                            <tr>
                                <td>Producción (última)</td>
                                <td>40.000</td>
                            </tr>
                            <tr>
                                <td>Nº árboles</td>
                                <td>1500</td>
                            </tr>
                            <tr>
                                <td>SIGPAC</td>
                                <td>143-1-119-1</td>
                            </tr>
                            <tr>
                                <td>Tipo de acceso</td>
                                <td>Carretera</td>
                            </tr>
                            <tr>
                                <td>Tipo de suelo</td>
                                <td>Bueno / <del>R. Salino</del> / <del>Salino</del></td>
                            </tr>
                            <tr>
                                <td>Tipo de riego</td>
                                <td>Goteo</td>
                            </tr>
                            <tr>
                                <td>¿Dispone de balsa</td>
                                <td>Si</td>
                            </tr>
                            <tr>
                                <td>Ultima inspección</td>
                                <td>12/03/2018 - 09:38</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection