<?php

namespace Invoke\Toolkit\Docs\Documents;

use Invoke\Toolkit\Validators\ArrayOf;
use Invoke\Utils\ReflectionUtils;
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
    public string $name;

    /**
     * Short description of the method.
     *
     * @var string|null $summary
     */
    public ?string $summary;

    /**
     * Long description of the method.
     *
     * @var string|null $description
     */
    public ?string $description;

    /**
     * Method parameters documents.
     *
     * @var array $params
     */
    #[ArrayOf(ParamDocument::class)]
    public array $params;

    /**
     * Method result type.
     *
     * @var string $resultType
     */
    public string $resultType;

    /**
     * Method tags.
     *
     * @var array $tags
     */
    #[ArrayOf("string")]
    public array $tags;

    /**
     * Method required headers.
     *
     * @var array $headers
     */
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

        $comment = ReflectionUtils::extractComment($reflectionClass);
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