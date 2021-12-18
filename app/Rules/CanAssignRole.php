<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Spatie\Permission\Models\Role;

class CanAssignRole implements Rule
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

        $rule =  Role::find($value['id']);

        if (\auth()->user()->hasRole('Super-Admin')){
            return true;
        }

        if (\auth()->user()->hasRole('vychovavatel')){
            return $rule->name == 'internatista';
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Bez oprávnenia na pridelenie konkrétnej roly' ;
    }
}
