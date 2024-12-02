<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\BaseRequest;
use App\Infrastructure\Models\Comment\Comment;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Gate;

class StoreCommentRequest extends BaseRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $canCreate = Gate::allows(['create', 'moderate'], Comment::class);
        return $canCreate;
        
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
            'user_id' => 'required|exists:users,id',
            'article_id' => 'required|exists:articles,id',
            'content' => 'required|string|max:255',
        ];

    }

}
