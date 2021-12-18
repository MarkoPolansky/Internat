<?php

namespace App\Rules;

use App\Models\Activity;
use Illuminate\Contracts\Validation\Rule;

class UniqueTodayActivity implements Rule
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
        $value = collect($value);

        return $value->count() == $value->pluck('id')
                ->diff(Activity::TodayActivities()->get()->pluck('available_activity_id'))->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Aktivita je už pre tento deň vytvorená';
    }
}
