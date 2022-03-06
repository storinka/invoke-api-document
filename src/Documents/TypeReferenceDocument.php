<?php

namespace Invoke\Toolkit\Docs\Documents;

use Invoke\Attributes\Parameter;

class TypeReferenceDocument extends Document
{
    #[Parameter]
    public string $uniqueTypeName;
}