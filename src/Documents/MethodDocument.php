<?php

namespace Invoke\Toolkit\Docs\Documents;

use Invoke\Attributes\Parameter;
use Invoke\Toolkit\Validators\ArrayOf;
use Invoke\Utils\ReflectionUtils;
use Invoke\Toolkit\Docs\Utils\ReflectionUtils as DocsReflectionUtils;
use Invoke\Utils\Utils;

/**
 * Method document.
 */
class MethodDocument extends Document
{
    /**
     * Method name.
     *
     * @var string $name
     */
    #[Parameter]
    public string $name;

    /**
     * Short description of the method.
     *
     * @var string|null $summary
     */
    #[Parameter]
    public ?string $summary;

    /**
     * Long description of the method.
     *
     * @var string|null $description
     */
    #[Parameter]
    public ?string $description;

    /**
     * Method parameters documents.
     *
     * @var array $params
     */
    #[Parameter]
    #[ArrayOf(ParamDocument::class)]
    public array $params;

    /**
     * Method result type.
     *
     * @var string $resultType
     */
    #[Parameter]
    public string $resultType;

    /**
     * Method tags.
     *
     * @var array $tags
     */
    #[Parameter]
    #[ArrayOf("string")]
    public array $tags;

    /**
     * Method required headers.
     *
     * @var array $headers
     */
    #[Parameter]
    #[ArrayOf(HeaderDocument::class)]
    public array $headers;

    /**
     * Create method document from name and class.
     *
     * @param string $name
     * @param string $class
     * @return static
     */
    public static function fromNameAndClass(string $name, string $class): static
    {
        $reflectionClass = ReflectionUtils::getClass($class);

        $comment = DocsReflectionUtils::extractComment($reflectionClass);
        $summary = $comment["summary"];
        $description = $comment["description"];

        $params = ReflectionUtils::extractParamsPipes($reflectionClass);
        $paramsDocuments = ParamDocument::many($params);

        $reflectionMethod = $reflectionClass->getMethod("handle");
        $returnType = ReflectionUtils::extractPipeFromMethodReturnType($reflectionMethod);
        $returnTypeName = Utils::getUniqueTypeName($returnType);

        $headers = array_map(fn(string $header) => HeaderDocument::from([
            "name" => $header,
        ]), ReflectionUtils::extractRequiredHeaders($reflectionClass));

        return parent::from([
            "name" => $name,

            "summary" => $summary,
            "description" => $description,

            "params" => $paramsDocuments,
            "resultType" => $returnTypeName,

            "tags" => [],

            "headers" => $headers,
        ]);
    }
}
