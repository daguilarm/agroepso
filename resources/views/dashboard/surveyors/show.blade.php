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
                    <h3 class="tile-title">Modelos de inspección</h3>
                    <div class="bs-component">
                                  <ul class="nav nav-tabs">
                                    <li class="nav-item"><a class="nav-link text-white bg-secondary" data-toggle="tab" href="#FPC01">FPC-05/01</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#FPC02">FPC-05/02</a></li>
                                    <li class="nav-item"><a class="nav-link disabled" href="#FPC03">FPC-05/03</a></li>
                                  </ul>
                                  <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" style="box-shadow: 1px 1px 4px #666; padding: 10px;" id="FPC01">
                                        <h2 class="my-4">Modelo: FPC-05/01</h2>
                                        <div class="tile-body">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Nª de acta</label>
                                                    <div class="col-md-1">
                                                        <label>Titular</label>
                                                        <input class="form-control" type="text" value="XXX" disabled>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label>Seleccione</label>
                                                        <select class="form-control">
                                                            <option value="P">P</option>
                                                            <option value="PC">PC</option>
                                                            <option value="A">A</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label>Nº Orden</label>
                                                        <input class="form-control" type="text" value="XXX XXX" disabled>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label>Año</label>
                                                        <input class="form-control" type="text" value="18" disabled>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label>Hora</label>
                                                        <input class="form-control" type="text" value="09:35" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Tipo de visita</label>
                                                    <div class="col-md-9">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="radio" name="gender">Inspección inicial
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="radio" name="gender">Inspección de campaña
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Parcela</label>
                                                    <div class="col-md-1">
                                                        <select class="form-control">
                                                            <option value="143-1">143-1</option>
                                                            <option value="143-2">143-2</option>
                                                            <option value="143-3">143-3</option>
                                                            <option value="143-4">143-4</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button class="btn btn-danger">{!! icon('new', 'Añadir') !!}</button>
                                                    </div>
                                                </div>
                                                
                                                <h2 class="by-4">Parcelas</h2>
                                                <br>
                                                <table class="table table-striped text-center">
                                                    <thead>
                                                        <th class="bg-warning text-dark">Minicipio</th>
                                                        <th class="bg-warning text-dark">Polígono</th>
                                                        <th class="bg-warning text-dark">Parcela</th>
                                                        <th class="bg-warning text-dark">Recinto</th>
                                                        <th class="bg-warning text-dark">Conformidad</th>
                                                        <th class="bg-warning text-dark">Discrepancias</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>143</td>
                                                            <td>1</td>
                                                            <td>119</td>
                                                            <td>1</td>
                                                            <td>
                                                                <select class="form-control">
                                                                    <option value="Si">Si</option>
                                                                    <option value="No">No</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <textarea class="w-100" rows="4"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>142</td>
                                                            <td>2</td>
                                                            <td>69</td>
                                                            <td>4</td>
                                                            <td>
                                                                <select class="form-control">
                                                                    <option value="Si">Si</option>
                                                                    <option value="No" selected>No</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <textarea class="w-100" rows="4"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>141</td>
                                                            <td>4</td>
                                                            <td>235</td>
                                                            <td>12</td>
                                                            <td>
                                                                <select class="form-control">
                                                                    <option value="Si">Si</option>
                                                                    <option value="No" selected>No</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <textarea class="w-100" rows="4"></textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="FPC02">
                                      <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
                                    </div>
                                    <div class="tab-pane fade" id="FPC03">
                                      <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
                                    </div>
                                  </div>
                                </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h2 class="tile-title">Certificados</h2>
                    <h2>Balance de masas FPC-10/07</h2>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">Campaña</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Mes/Semana</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <br>
                    <h2>Datos de producción</h2>
                    <table class="table table-striped text-center">
                        <thead>
                            <th class="bg-warning text-dark"></th>
                            <th class="bg-warning text-dark">Granada Mollar DOP</th>
                            <th class="bg-warning text-dark">Granada Mollar</th>
                            <th class="bg-warning text-dark">Resto de granadas</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Entrada</td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                            </tr>
                            <tr>
                                <td>Salida extra</td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                            </tr>
                            <tr>
                                <td>Salida PRIMERA</td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                            </tr>
                            <tr>
                                <td>Salida SEGUNDA</td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                            </tr>
                            <tr>
                                <td>Salida CITRICA</td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <h2 class>Stock de etiquetas </h2>
                    <p>Indicar en cada columna el tipo de etiqueta y la serie (ej. Etiqueta A, Stick de fruta...) y en las filas siguientes las gastadas y las que quedan en almacén.</p>
                    <table class="table table-striped text-center">
                        <thead>
                            <th class="bg-success text-white"></th>
                            <th class="bg-success text-white"><input type="text" name="" value="Sticks fruta" class="text-center"></th>
                            <th class="bg-success text-white"><input type="text" name="" value="" class="text-center"></th>
                            <th class="bg-success text-white"><input type="text" name="" value="" class="text-center"></th>
                            <th class="bg-success text-white"><input type="text" name="" value="" class="text-center"></th>
                            <th class="bg-success text-white"><input type="text" name="" value="" class="text-center"></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Gastadas</td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                            </tr>
                            <tr>
                                <td>En stock</td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <h2 class>Destino del producto Nacional</h2>
                    <p>Esta información se utilizará para la previsión de las campañas depromoción. Indicar en cada provincia qué parte se comercializa por mayorista (Merca) o por cadena (Aldi/Lidl/Carrefour/Dia/Mercadona/...) o cualquier otro(O).</p>
                    <table class="table table-striped text-center">
                        <thead>
                            <th class="bg-info text-white">Provincia</th>
                            <th class="bg-info text-white">Kg</th>
                            <th class="bg-info text-white">Provincia</th>
                            <th class="bg-info text-white">Kg</th>
                            <th class="bg-info text-white">Provincia</th>
                            <th class="bg-info text-white">Kg</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                            </tr>
                            <tr>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                                <td><input type="text" name=""></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection