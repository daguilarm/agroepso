<?php

// Form::selectRoles() => Generate a select for roles
// Form::selectUsers() => Generate a select for users
// Form::selectClients() => Select all the clients with the crop values as data
// Form:selectPlants() => Select all the plants for a client
// Form:selectWarehouses() => Select all the warehouses for a client

use App\Models\Clients\Client;
use App\Models\CropVarieties\CropVariety;
use App\Models\Plants\Plant;
use App\Models\Users\User;
use App\Models\Warehouses\Warehouse;

/**
 * Generate a select for roles
 *
 * @param  object $data
 * @param  bool $blank [Blank option]
 * @return string
 */
Form::macro('selectRoles', function($data = null, $colWidth = 2)
{
    //Prevent the user to update himself
    if(isset($data) && $data->id === Credentials::id()) {
        return html()->hidden('role')->value($data->role);
    }

    //List with all the allowed roles
    $roles = get_roles();

    //Create the select container
    $options = collect($roles)->mapWithKeys(function($value) {
        return [$value => $value];
    })->toArray();

    //Remove first item (because an user only can add roles below them)
    array_shift($options);

    //Binding value
    $value = $data
        ? $data->getRoleNames()->first()
        : 'user';

    return sprintf(
        '<div class="form-group col-12 col-lg-%s">' .
            '<label class="control-label">%s</label>' .
            '%s' .
        '</div>',
        $colWidth,
        trans('persona.contact.role'),
        html()->select('role')->addClass('form-control')->options(['' => ''] + $options)->required()
    );
});

/**
 * Generate a select for users
 *
 * @param object $data
 * @return  string
 */
Form::macro('selectUsers', function($data = null)
{
    //If is an admin and is creating a plot
    if(auth()->user()->hasRole('admin') && is_null($data)) {
        return html()->select('user_id')->addClass('form-control')->options([])->required();
    }

    //Get the users
    $users = User::byName()->byClient(optional($data)->client_id);

    //Set the values
    $options = $users->map(function($value) use ($data) {
        //Selected value
        $selected = ($value->id === optional($data)->user_id) ? ' selected' : '';
        //Return the html
        return sprintf('<option value="%s"%s>%s</option>', $value->id, $selected, $value->name ?? '');
    })
    ->prepend('<option></option>')
    ->implode('');

    return sprintf('<select name="user_id" id="user_id" class="form-control" required>%s</select>', $options);
});

/**
 * Select all the clients with the crop values as data
 *
 * @param object $data
 * @param bool $withCrops [Add the crop relationship to the collection]
 * @param string $responseType ['user', 'plant', 'warehouse', 'plot']
 * @return string
 */
Form::macro('selectClients', function($data = null, $withCrops = true, $responseType, $colWidth = 2)
{
    //If is an admin
    if(auth()->user()->hasRole('admin')) {

        //Get the client list
        $clients = $withCrops
            ? Client::with('crop')->get()
            : Client::all();

        //Get the option values
        $options = $clients->map(function($value) use ($data, $responseType, $withCrops) {
            //Selected value
            $selected = ($value->id === (optional($data)->client_id ?? 'no-result')) ? ' selected' : '';

            //Return the html
            return $withCrops
                ? sprintf('<option value="%s" data-id="%s" data-crop="%s" data-key="%s"%s>%s</option>', $value->id, $value->crop->id ?? '', $value->crop->crop_name ?? '', $value->crop->crop_key ?? '', $selected, $value->client_name)
                : sprintf('<option value="%s" %s>%s</option>', $value->id, $selected, $value->client_name);
        })->implode('');

        //Print the data
        return sprintf(
            '<div class="form-group col-12 col-lg-%s">' .
                '<label class="control-label">%s</label>' .
                '<select name="client_id" id="client_id" data-model="%s" class="form-control" required><option></option>%s</select>' .
            '</div>',
            $colWidth,
            trans_title('clients', 'plural'),
            $responseType,
            $options
        );
    }

    //Just return de client ID if not admin
    return html()->hidden('client_id')->value(Credentials::client());
});

/**
 * Select all the plants for a client
 *
 * @param object $data
 * @param bool $colWidth [Add the crop relationship to the collection]
 * @return string
 */
Form::macro('selectPlants', function($data = null, $colWidth = 2)
{
    //If is an admin and is creating a plot
    if(auth()->user()->hasRole('admin') && is_null($data)) {
        return html()->select('plant_id')->addClass('form-control')->options([]);
    }

    //Client values
    $options = Plant::byClient(optional($data)->client_id);

    //Set the values
    $options = $options->map(function($value) use ($data) {
        //Selected value
        $selected = ($value->id === optional($data)->plant_id) ? ' selected' : '';
        //Return the html
        return sprintf('<option value="%s"%s>%s</option>', $value->id, $selected, $value->plant_name ?? '');
    })
    ->prepend('<option></option>')
    ->implode('');

    return sprintf('<select name="plant_id" id="plant_id" class="form-control">%s</select>', $options);
});

/**
 * Select all the warehouses for a client
 *
 * @param object $data
 * @param bool $colWidth [Add the crop relationship to the collection]
 * @return string
 */
Form::macro('selectWarehouses', function($data = null, $colWidth = 2)
{
    //If is an admin and is creating a plot
    if(is_null($data)) {
        return html()->select('warehouse_id')->addClass('form-control')->options([]);
    }

    //Client values
    $options = Warehouse::byClient($data ?? null);

    //Set the values
    $options = $options->map(function($value) use ($data) {
        //Selected value
        $selected = ($value->id === optional($data)->warehouse_id) ? ' selected' : '';
        //Return the html
        return sprintf('<option value="%s"%s>%s</option>', $value->id, $selected, $value->warehouse_name ?? '');
    })
    ->prepend('<option></option>')
    ->implode('');

    return sprintf('<select name="warehouse_id" id="warehouse_id" class="form-control">%s</select>', $options);
});

/**
 * Select all the varieties for a crop
 *
 * @param object $crop
 * @return string
 */
Form::macro('selectCropVarieties', function($data = null)
{
    //If is an admin and is creating a plot
    if(auth()->user()->hasRole('admin') && is_null($data)) {
        return html()->select('crop_variety_id')->addClass('form-control')->options([]);
    }

    //Client values
    $options = CropVariety::whereCropId(Credentials::crop())->get();

    //Set the values
    $options = $options->map(function($value) use ($data) {
        //Selected value
        $selected = ($value->id === optional($data)->crop_variety_id) ? ' selected' : '';
        //Return the html
        return sprintf('<option value="%s"%s>%s</option>', $value->id, $selected, $value->crop_variety_name ?? '');
    })
    ->prepend('<option></option>')
    ->implode('');

    return sprintf('<select name="crop_variety_id" id="crop_variety_id" class="form-control">%s</select>', $options);
});
