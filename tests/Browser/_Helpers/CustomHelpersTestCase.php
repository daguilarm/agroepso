<?php

namespace Tests\Browser\_Helpers;

trait CustomHelpersTestCase
{

    /**
    * Get value from a selector
    * @param object $browser
    * @param string $selector
    *
    * @return mixed
    */
    public function getValueFromSelector($browser, $selectorID)
    {
        return $browser->script("document.querySelector('{$selectorID}').value;")[0];
    }

   /**
    * Get value from a selector
    * @param object $browser
    * @param string $selectorID
    *
    *   Example:
    *   $this->selectCheckBox($browser, ['#permissions-1', '#permissions-2', '#permissions-3']);
    *   $this->selectCheckBox($browser, '#permissions-5');
    *
    * @return mixed
    */
   public function selectCheckBox($browser, $selectorID)
   {
       if(is_array($selectorID)) {
            foreach($selectorID as $item) {
                $browser->script("document.querySelector('{$item}').checked = true");
            }
       } else {
            $browser->script("document.querySelector('{$selectorID}').checked = true");
       }
   }

    /**
    * Generate the user method for the role
    *
    * @param array $role
    * @return bool
    */
    public function getRoleMethod($role)
    {
        return $this->{'default' . camel_case($role)}();
    }
}
