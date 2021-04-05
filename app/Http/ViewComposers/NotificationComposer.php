<?php

namespace App\Http\ViewComposers;

use App\Models\Users\User;
use Illuminate\View\View;

use Cache, Credentials;

class NotificationComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;
    protected $minutes = 60;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(User $users)
    {
        // Dependencies automatically resolved by service container...
        $this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('notifications', $this->storedCache());
    }

    /**
     * Cache the notifications by time
     *
     * @return void
     */
    public function storedCache()
    {
        $total = Cache::remember('notifications-total-' . Credentials::id(), $this->minutes, function () {
            return $this->users->count();
        });

        $messages = Cache::remember('notifications-msg-' . Credentials::id(), $this->minutes, function () {
            return $this->users->take(5)->get();
        });

        return compact('total', 'messages');
    }
}
