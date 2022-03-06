<?php

namespace Invoke\Toolkit\Docs\Documents;

use BackedEnum;
use Invoke\Attributes\Parameter;
use Invoke\Pipe;
use Invoke\Toolkit\Validators\ArrayOf;
use Invoke\Type;
use Invoke\Types\AnyType;
use Invoke\Types\WrappedType;
use Invoke\Utils\ReflectionUtils;
use Invoke\Utils\Utils;
use Invoke\Validator;

/**
 * Type document.
 */
class TypeDocument extends Document
{
    /**
     * Type name.
     *
     * @var string $name
     */
    #[Parameter]
    public string $name;

    /**
     * Unique type name.
     *
     * @var string $uniqueTypeName
     */
    #[Parameter]
    public string $uniqueTypeName;

    /**
     * Type short description.
     *
     * @var string|null $summary
     */
    #[Parameter]
    public ?string $summary;

    /**
     * Type full description.
     *
     * @var string|null $description
     */
    #[Parameter]
    public ?string $description;

    /**
     * Is simple. (Supported by JSON)
     *
     * Simple types: <code>int</code>, <code>float</code>, <code>bool</code>, <code>string</code>, <code>null</code>
     *
     * @var bool $isSimple
     */
    #[Parameter]
    public bool $isSimple;

    /**
     * Is type a data structure with parameters.
     *
     * @var bool $isData
     */
    #[Parameter]
    public bool $isData;

    /**
     * Is type is union.
     *
     * @var bool $isUnion
     */
    #[Parameter]
    public bool $isUnion;

    /**
     * Is type binary.
     *
     * @var bool $isBinary
     */
    #[Parameter]
    public bool $isBinary;

    /**
     * Is type enum.
     *
     * @var bool $isEnum
     */
    #[Parameter]
    public bool $isEnum;

    /**
     * Is type array.
     *
     * @var bool $isArray
     */
    #[Parameter]
    public bool $isArray;

    /**
     * Array type.
     *
     * @var string|null $arrayType
     */
    #[Parameter]
    public ?string $arrayType;

    /**
     * Union types.
     *
     * @var array $unionTypes
     */
    #[Parameter]
    #[ArrayOf("string")]
    public array $unionTypes;

    /**
     * Enum values.
     *
     * @var array $enumValues
     */
    #[Parameter]
    #[ArrayOf(["string", "int"])]
    public array $enumValues;

    /**
     * Type parameters.
     *
     * @var array $params
     */
    #[Parameter]
    #[ArrayOf(ParamDocument::class)]
    public array $params;

    /**
     * Additional type validators.
     *
     * @var array $validators
     */
    #[Parameter]
    #[ArrayOf(ValidatorDocument::class)]
    public array $validators;

    /**
     * Create type document from type pipe.
     *
     * @param Type $type
     * @return static
     */
    public static function fromType(Type $type): static
    {
        $name = Utils::getPipeTypeName($type);
        $uniqueTypeName = Utils::getUniqueTypeName($type);

        if ($type instanceof WrappedType) {
            $type = $type->typeClass;
        }

        $validators = [];
        if ($type instanceof Validator) {
            $validators = [$type];
        }

        $isSimple = Utils::isPipeTypeSimple($type);
        $isData = Utils::isPipeTypeData($type);
        $isUnion = Utils::isPipeTypeUnion($type);
        $isBinary = Utils::isPipeTypeBinary($type);
        $isEnum = Utils::isPipeTypeEnum($type);
        $isArray = Utils::isPipeTypeArray($type);

        $arrayType = null;
        if ($isArray) {
            if ($type instanceof ArrayOf) {
                $arrayType = Utils::getUniqueTypeName($type->itemPipe);
            } else {
                $arrayType = Utils::getUniqueTypeName(AnyType::getInstance());
            }
        }

        $reflectionClass = ReflectionUtils::getClass(is_string($type) ? $type : $type::class);

        $comment = ReflectionUtils::extractComment($reflectionClass);
        $summary = $comment["summary"];
        $description = $comment["description"];

        $params = [];
        if ($isData) {
            $params = ReflectionUtils::extractParamsPipes($reflectionClass);
        }

        $unionTypes = $isUnion ? $type->pipes : [];

        return static::from([
            "name" => $name,
            "uniqueTypeName" => $uniqueTypeName,
            "summary" => $summary,
            "description" => $description,

            "isSimple" => $isSimple,
            "isData" => $isData,
            "isUnion" => $isUnion,
            "isBinary" => $isBinary,
            "isEnum" => $isEnum,
            "isArray" => $isArray,

            "arrayType" => $arrayType,

            "unionTypes" => array_map(fn(Pipe $pipe) => Utils::getUniqueTypeName($pipe), $unionTypes),
            "enumValues" => $isEnum ? array_map(fn(BackedEnum $pipe) => $pipe->value, $type->enumClass::cases()) : [],
            "params" => ParamDocument::many($params),
            "validators" => ValidatorDocument::many($validators),
        ]);
    }
}
