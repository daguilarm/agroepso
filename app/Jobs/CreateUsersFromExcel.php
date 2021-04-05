<?php

namespace App\Jobs;

use App\Jobs\_ExcelRepository;
use App\Models\Plants\Plant;
use App\Models\Users\User;
use App\Models\Warehouses\Warehouse;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateUsersFromExcel extends _ExcelRepository implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $item;
    protected $request;

    public function __construct($item, $request)
    {
        $this->item = $item;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->createItem($this->item);
    }

    /**
     * Execute the query.
     *
     * @param array $data
     * @return void
     */
    protected function createItem($data)
    {
        return DB::transaction(function () use ($data) {

            //Validate data
            if(!$this->validate($data)){
                return false;
            }

            $client = $this->request['client_id'];

            //Create user
            $user = User::create([
                'user_ref' => parent::sanitize($data, 'referencia', $type = 'string', getUserReference($client)),
                'client_id' => $client,
                'name' => parent::sanitize($data, 'nombre'),
                'nif' => parent::sanitize($data, 'nif'),
                'email' => parent::sanitize($data, 'email', $type = 'email'),
                'password' => parent::sanitize($data, 'referencia', $type = 'string', str_random(8)),
            ]);

            if(!is_null($user->id)) {
                //Create profile
                $user->profile()->create([
                    'profile_birthdate' => optional($data['nacimiento'])->format('d/m/Y') ?? null,
                    'profile_address' => parent::sanitize($data, 'direccion'),
                    'profile_zip' => parent::sanitize($data, 'cp'),
                    'profile_state' => parent::sanitize($data, 'ccaa'),
                    'profile_region' => parent::sanitize($data, 'provincia'),
                    'profile_city' => parent::sanitize($data, 'ciudad'),
                    'profile_telephone' => parent::sanitize($data, 'telefono'),
                ]);
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    /**
     * Validate data
     *
     * @param array $data
     * @return void
     */
    protected function validate($data) : bool
    {
        //Validate keys
        // if(!parent::filterKeys($data)){
        //     return false;
        // }

        //Validate email
        if(!parent::filterEmail($data, User::class)) {
            return false;
        }

        //Validate name
        if(!parent::filterName($data)) {
            return false;
        }

        return true;
    }
}
