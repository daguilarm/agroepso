<?php

namespace App\Tables;

use App\Models\Biocides\Biocide;
use App\Tables\_TableTrait;
use Credentials, Form, Gate, Table;

class BiocideTable extends Table
{
   use _TableTrait;

   /**
    * Generate the model query
    *
    * @return object
    */
    public static function query()
    {
        return app(Biocide::class)
            ->filterByRole('biocides');
    }

    /**
     * Set the table columns: table > thead > th
     *
     * @return string
     */
    public static function columns()
    {
        return [
            'id' => trans('persona.id.id'),
            'biocide_name' => trans_title('biocides'),
            'biocide_num' => sections('biocides.register'),
            'biocide_company' => trans('financials.company'),
            'biocide_formula' => sections('biocides.formula'),
        ];
    }

    /**
     * Search filter for table
     *
     * Search filters availables: 'string', 'range', 'date', 'filterOption'
     *
     * @return object
     */
    public static function search()
    {
        return [
            'biocide_name' => 'string',
            'biocide_num' => 'string',
            'biocide_company' => 'string',
        ];
    }

    /**
     * Set the sortable columns
     *
     * Example for sortables fields:
     * return ['id', 'name', ...]
     * @return array
     */
    public static function sortables()
    {
        return ['id', 'biocide_name', 'biocide_num', 'biocide_company'];
    }

    /**
     * Generate batch actions
     *
     * @param string $section
     * @param array $array
     * @return string/html
     */
    public static function actions($section, array $array = [])
    {
        return [
            [
                'route' => 'dashboard.tools.' . $section . '.edit',
                'button' => Form::actionButtons($icon = 'edit', $color = 'warning'),
            ],
        ];
    }
}
