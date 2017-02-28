<?php namespace interactivesolutions\honeycomblanguages\validators;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCLanguagesValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'language_family' => 'required',
'language' => 'required',
'native_name' => 'required',
'iso_639_1' => 'required',
'iso_639_2' => 'required',

        ];
    }
}