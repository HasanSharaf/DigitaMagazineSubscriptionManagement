<?php

namespace App\Http\Requests\Magazine;

use App\Http\Requests\BaseRequest;
use App\Infrastructure\Models\Magazine\Magazine;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Gate;

class StoreMagazineRequest extends BaseRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $canCreate = Gate::allows('create', Magazine::class);
        return $canCreate;
        // return Gate::allows('create', Magazine::class);
        // return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'date_of_release' => ['required', 'date'],
        ];

    }

}