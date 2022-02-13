<?php

namespace Invoke\Toolkit\Docs\Sections;

use Invoke\Toolkit\Docs\Documents\MethodReferenceDocument;
use Invoke\Toolkit\Docs\Documents\SectionDocument;
use Invoke\Toolkit\Docs\SectionBuilder;

/**
 * Methods section builder.
 */
class MethodsSection extends SectionBuilder
{
    public function build(array $types, array $methods): SectionDocument
    {
        $methodsDocuments = array_map(
            fn(array $method) => MethodReferenceDocument::from([
                "methodName" => $method["name"],
            ]),
            $methods
        );

        return SectionDocument::from([
            "name" => "Methods",
            "items" => $methodsDocuments,
        ]);
    }
}