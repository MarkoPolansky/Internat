<?php

namespace App\Http\Requests;

use App\Rules\ExistsUsers;
use Illuminate\Foundation\Http\FormRequest;

class StoreAnnouncementRequest extends FormRequest
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
            'title' => ['required','max:255'],
            'body' =>  ['required','max:2000'],
            'visible_until' => ['nullable','date','after:yesterday'],
            'users' => ['required','array',new ExistsUsers()],
            'send_email' => ['required','boolean']

        ];
    }
    public function messages()
    {
        return [
            'title.max' => 'Predmet musí byť kratší ako 255 znakov',
            'body.max' => 'Správa musí byť kratšia ako 2000 znakov',
            'users.required' => 'Komu pole je povinné',
            'visible_until.after' => 'Zobrazovať sa môže iba ak je dátum starší ako včera'
        ];
    }
}
