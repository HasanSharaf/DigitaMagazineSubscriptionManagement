<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ApiResponse::validationError($validator));
    }

    /**
     * @param $method
     * @param $parameters
     * @return array|mixed
     */
    public function __call($method, $parameters)
    {
        if (property_exists($this, $method)) {
            $rulesArray = $this->{$method};
            $required = !empty($parameters) ? $parameters[0] : true;
            return $this->applyRulesFromArray($rulesArray, $required);
        }

        return parent::__call($method, $parameters);
    }


    /**
     * @param $rulesArray
     * @param bool $required
     * @return array
     */
    protected function applyRulesFromArray($rulesArray, bool $required = true): array
    {
        return $this->getRule($rulesArray, $required);
    }

    /**
     * @param $rules
     * @param $required
     * @return array
     */
    public function getRule($rules, $required): array
    {
        return $required ? $this->withRequiredRule($rules) : $rules;
    }

    /**
     * @param array $rules
     * @return array
     */
    public function withRequiredRule(array $rules): array
    {
        $rules[] = 'required';
        return $rules;
    }




}
