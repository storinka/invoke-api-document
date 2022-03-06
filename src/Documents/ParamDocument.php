<?php

namespace Invoke\Toolkit\Docs\Documents;

use Invoke\Attributes\Parameter;
use Invoke\Toolkit\Validators\ArrayOf;
use Invoke\Utils\Utils;

/**
 * Parameter document.
 */
class ParamDocument extends Document
{
    /**
     * Parameter name.
     *
     * @var string $name
     */
    #[Parameter]
    public string $name;

    /**
     * Parameter short description.
     *
     * @var string|null $summary
     */
    #[Parameter]
    public ?string $summary;

    /**
     * Parameter full description.
     *
     * @var string|null $description
     */
    #[Parameter]
    public ?string $description;

    /**
     * Is parameter optional.
     *
     * @var bool $isOptional
     */
    #[Parameter]
    public bool $isOptional;

    /**
     * Parameter default value.
     *
     * @var mixed $defaultValue
     */
    #[Parameter]
    public mixed $defaultValue;

    /**
     * Parameter type.
     *
     * @var string $type
     */
    #[Parameter]
    public string $type;

    /**
     * Parameter validators.
     *
     * @var array $validators
     */
    #[Parameter]
    #[ArrayOf(ValidatorDocument::class)]
    public array $validators;

    public function override(array $data): array
    {
        $typeName = Utils::getUniqueTypeName($data["type"]);
        $validatorsDocuments = ValidatorDocument::many($data["validators"]);

        return [
            "type" => $typeName,
            "validators" => $validatorsDocuments,
        ];
    }
}
