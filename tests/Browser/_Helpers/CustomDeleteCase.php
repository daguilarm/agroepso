<?php

namespace Tests\Browser\_Helpers;

use Laravel\Dusk\Browser;

trait CustomDeleteCase
{
    /**
     * Assert can delete
     *
     * @param object $browser
     * @return bool
     */
    public function assertCanDelete($browser)
    {
        $browser
            ->click('.table-arrow-up')
            ->press('.modal-delete')
            ->press(trans('buttons.delete'))
            ->assertVisible($this->responseMsgSuccess);
    }

    /**
     * Assert can restore a deleted field
     *
     * @param object $browser
     * @return bool
     */
    public function assertCanRestore($browser)
    {
        $browser
            ->click('.table-arrow-up')
            ->press('.button-restore')
            ->assertVisible($this->responseMsgSuccess);
    }
}
