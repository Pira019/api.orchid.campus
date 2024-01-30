<?php

namespace App\Rules;

use App\Enums\ProfilNameEnum;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CheckRoleRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::where("user_name",$value)->first();
          // Check if the user exists and has any of the specified roles
       if ($user !== null && $user->hasAnyRole(ProfilNameEnum::getValues())) {
            return true; // Validation passes
        }

        return false; // Validation fails
    }

    /**
     * Get the validation error message.
     *Role valide see rofilNameEnum::getValues()
     * @return string
     */
    public function message()
    {
        return __("L'utilisateur doit avoir un rôle valide pour cette opération");
    }
}
