<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'isActive' => 'required',
            'bannerText' => 'required',
            'bannerColor' => 'required',
            'titleText' => 'required',
            'titleColor' => 'required',
            'content' => 'required',
            'buttonText' => 'required',
            'buttonColor' => 'required',
            'buttonLink' => 'required',
            'imageUpload' => ['required', 'max:20000'],
            'imageUploadFilePond' => ['string', 'nullable']
        ];
    }
}
