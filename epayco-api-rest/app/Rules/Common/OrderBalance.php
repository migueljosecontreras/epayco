<?php

namespace App\Rules\Common;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class OrderBalance implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $message;

    public function __construct()
    {
        $this->message = trans('validation.balanceIsNotEnough');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::findUser()->first();

        if(!$user){
            $this->message = trans('general.msg.userNotFound');

            return false;
        }

        if($user->balance < $value){
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
