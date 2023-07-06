<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $menuItem = $this->get('menuItem');

        return [
        'title' => 'required',
        'url' => 'required',
        'order' => [
            'required',
            'integer',
            Rule::unique('menu_items')->ignore($this->menuItem ? $this->menuItem->id : null),
        ],
    ];
    }
}
