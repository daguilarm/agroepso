<?php
/**
 * @middleware: dop
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use App\Http\Requests\ProfilesRequest;
use App\Models\Users\User;
use Credentials, DB, Gate;

class ProfilesController extends DashboardController
{
    /**
     * @var protected
     */
    protected $controller;
    protected $delete;
    protected $route;

    /**
     * @var protected
     * @return string
     */
    protected $section = 'profiles';
    protected $msgTableField = 'name';

    /**
     * Constructo initialization
     */
    public function __construct(User $controller)
    {
        $this->controller = $controller;
        $this->route = 'dashboard.' . $this->section;

        //Sharing in the view
        $this->passVariablesToView();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   App\Models\Clients\Client
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $data = $this->controller->findOrFail($id);

        //Auth validation. Only the owner can update this value.
        if(Credentials::id() != $data->id) {
            return errorNotAllowedAccess();
        }

        return view(dashboard_path($this->section . '.edit'), compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfilesRequest $request, int $id)
    {
        //Get the user
        $user = $this->controller->findOrFail($id);

        //Auth validation. Only the owner can update this value.
        if(Credentials::id() != $user->id) {
            return errorNotAllowedAccess();
        }

        //Update fields with transaction
        return DB::transaction(function() use ($user, $request) {
            $user->update($request->all());
            $user->profile->update($request->all());

            return redirect()
                ->back()
                ->withUpdated(trans_title('users') . ': ' . request($this->msgTableField));
        }) ?? errorDataBase('update');
    }
}
