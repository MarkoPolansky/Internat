<?php

namespace App\Http\Requests;

use App\Rules\UniqueTodayActivity;
use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'availableActivities'=> ['required',new UniqueTodayActivity()],
            'availableActivities.*.id' => ['required','exists:available_activities,id'],
            'starts_at' =>['required','date_format:H:i'],
            'ends_at' =>['required','date_format:H:i','after:starts_at'],
            'send_email' => ['required', 'boolean']
        ];
    }
    public function messages()
    {
        return [
            'availableActivities' => 'Pole Aktivity je povinné',
            'ends_at.after' => 'Pole Do musí byť neskôr ako pole Od',
        ];
    }
}
