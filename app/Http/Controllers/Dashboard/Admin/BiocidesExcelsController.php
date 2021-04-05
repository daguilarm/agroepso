<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\DashboardController;
use App\Jobs\CreateBiocidesFromExcel;
use App\Models\Biocides\Biocide;
use Credentials, Gate, Storage;

class BiocidesExcelsController extends DashboardController
{
    /**
     * @var protected
     */
    protected $controller;
    protected $delete;
    protected $path;
    protected $route;

    /**
     * @var protected
     * @return string
     */
    protected $section = 'biocides';
    protected $msgTableField = 'biocide_name';
    protected $server = 'http://www.mapama.gob.es/es/agricultura/temas/sanidad-vegetal/productos-fitosanitarios/registro/productos/ListadoProductos.asp';
    protected $file = 'biocides.xls';
    protected $storage = 'app/public/download/';
    protected $reader;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct(Biocide $controller)
    {
        $this->controller = $controller;
        $this->path = Storage::disk('download')->getAdapter()->getPathPrefix();

        //Sharing in the view
        $this->passVariablesToView();
    }

    /**
     * Download the extarnal file into the download disk.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        if(Storage::disk('download')->put($this->file, file_get_contents($this->server))) {
            dispatch(new CreateBiocidesFromExcel($this->path . $this->file));
            return redirect()->back()->withSuccess(sections('biocides.options.storage'));
        }
        return redirect()->back()->withErrors(sections('biocides.errors'));
    }
}
