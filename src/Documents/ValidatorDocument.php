<?php

namespace Invoke\Toolkit\Docs\Documents;

use Invoke\Attributes\Parameter;
use Invoke\Utils\ReflectionUtils;
use Invoke\Validator;
use function Invoke\Utils\get_class_name;

/**
 * Validator document.
 */
class ValidatorDocument extends Document
{
    #[Parameter]
    public string $name;

    #[Parameter]
    public ?string $summary;

    #[Parameter]
    public ?string $description;

    #[Parameter]
    public array $data;

    public function override(Validator $validator): array
    {
        $data = [];

        if (method_exists($validator, "invoke_getValidatorData")) {
            $data = $validator->invoke_getValidatorData();
        }

        $reflectionClass = ReflectionUtils::getClass($validator::class);
        $comment = ReflectionUtils::extractComment($reflectionClass);
        $summary = $comment["summary"];
        $description = $comment["description"];

        return [
            "name" => get_class_name($validator::class),

            "summary" => $summary,
            "description" => $description,

            "data" => $data,
        ];
    }
}
