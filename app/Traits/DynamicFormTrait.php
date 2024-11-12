<?php
namespace App\Traits;

trait DynamicFormTrait
{
    public function getFormFields($formType, $action)
    {
        return config("form_fields.$formType.$action", []);
    }
}
