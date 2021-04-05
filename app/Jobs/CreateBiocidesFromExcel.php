<?php

namespace App\Jobs;

use App\Jobs\_ExcelRepository;
use App\Models\Biocides\Biocide;
use DB, Excel, Parser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateBiocidesFromExcel extends _ExcelRepository implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;
    protected $columns = [
        1 => 'biocide_num',
        2 => 'biocide_name',
        3 => 'biocide_company',
        4 => 'biocide_formula',
    ];
    protected $wrongCharacters = [
        '&nbsp;'
    ];

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reader = file_get_contents($this->path);
        $content = Parser::str_get_html($reader)->find('table > tr');

        return $this->createItem($content);
    }

    /**
     * Execute the query.
     *
     * @param array $data
     * @return void
     */
    protected function createItem($data, $list = [], $round = 1)
    {
       //Get if tr from table
       foreach($data as $tr) {
            //Get the td container from table
            foreach($tr->find('td') as $td) {
                //Get the items from the table row
                if($td->innertext) {
                    //Filter the values
                    $list[$round] = self::filter($td->innertext);
                    $round++;
                }
            }
            //If we have the fourth values for the item, then we add it to the DB
            if(count($list) === 4) {
                $create = app(Biocide::class)->updateOrCreate([
                    'biocide_num'       => $list[1],
                    'biocide_name'      => $list[2],
                    'biocide_company'   => $list[3],
                    'biocide_formula'   => $list[4],
                ]);

                //Reset the round
                $round = 1;
                flush();
            }
            //Then start over with a new table tr
       }
    }

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */
    private function filter($value)
    {
        //Filter to utf8
        $value = utf8_encode($value);

        //List of wrong characters
        $wrong = ['&nbsp;'];

        //Filter wrong characters
        $value = str_replace($this->wrongCharacters, '', $value);

        //Trim text
        return trim($value);
    }
}
