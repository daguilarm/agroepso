<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Credentials, Excel, Gate, PDF;

class DashboardController extends Controller
{
    /**
     * Remove the specified resource from storage.
     * More information in App\Http\Controllers\Controller => passVariablesToView()
     * More information in App\Http\Helpers\Routes => url_params_delete_id()
     *
     * Important: If this method don't work, please go to the Controller, an check for the $msgTableField
     * The $msgTableField variable, can be empty!!!!
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Auth validation
        if(Gate::denies('delete ' . str_singular($this->section), $this->controller)) {
            return errorNotAllowedAccess();
        }

        //Avoiding self-destruction
        if(Credentials::id() == $id && $this->section === 'users') {
            return redirect()
                ->route('dashboard.' . $this->section . '.index')
                ->withErrors([trans('alerts.delete.self-destruction')]);
        }

        //Regular destruction
        $item = $this->controller->destroy($id);

        return redirect()
            ->route('dashboard.' . $this->section . '.index')
            ->withSuccess(trans('alerts.delete.success'));
    }

    /**
     * Restire the deleted resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        //Auth validation
        if(!Credentials::isAdmin()) {
            return errorNotAllowedAccess();
        }

        //Regular destruction
        //App\DataTables\Repository\Traits\Helpers
        $this->controller->restoredItem($id);

        return redirect()
            ->route('dashboard.' . $this->section . '.index')
            ->withSuccess(trans('alerts.delete.restore'));
    }

    /**
     * Export html content to PDF
     *
     * @return \Illuminate\Http\Response
     */
    public function toPdf()
    {
        //Get the table values
        $table = $this->getTable($this->getTableRepository());

        //Generate the document headers
        $text = [
            'title'         => request('p_title'),
            'description'   => request('p_description')
        ];

        //Render the view
        $pdf = PDF::loadView(dashboard_path('pdf'), compact('table', 'text'));

        return $pdf->download(time() . '.pdf');
    }

    /**
     * Export html content to PDF
     *
     * @return \Illuminate\Http\Response
     */
    public function toExcel($data) {
        Excel::create(trans('system.backup:excel'), function($excel) use ($data) {
            $excel->sheet('Productos', function($sheet) use ($data) {
                $sheet->fromArray($data->toArray());
            });
        })->export('xls');
    }
}
