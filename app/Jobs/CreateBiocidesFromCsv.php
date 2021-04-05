<?php

namespace App\Jobs;

use App\Models\Biocides\Biocide;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateBiocidesFromCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var protected
     */
    protected $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::filter('chunk')->selectSheetsByIndex(0)->load(storage_path('app/download/' . $this->file))->chunk(200, function($results) {
            $results->each(function($row) {
                    app(Biocide::class)->updateOrCreate([
                        'biocide_num'       => $row->registro,
                        'biocide_name'      => $row->nombre,
                        'biocide_company'   => $row->empresa,
                        'biocide_formula'   => $row->formula,
                    ]);
                    flush();
            });
        });
    }
}
