<?php

namespace Invoke\Toolkit\Docs\Utils;

use phpDocumentor\Reflection\DocBlockFactory;
use ReflectionFunctionAbstract;
use ReflectionProperty;
use ReflectionClass;
use ReflectionClassConstant;

final class ReflectionUtils
{
    public static function extractComment(ReflectionFunctionAbstract|ReflectionProperty|ReflectionClass|ReflectionClassConstant $reflectionClass): array
    {
        $comment = [
            "summary" => null,
            "description" => null
        ];

        $docComment = $reflectionClass->getDocComment();
        $docBlockFactory = DocBlockFactory::createInstance();

        if ($docComment) {
            $docBlock = $docBlockFactory->create($docComment);

            $comment["summary"] = $docBlock->getSummary();
            $comment["description"] = $docBlock->getDescription()->render();
        }

        return $comment;
    }
}