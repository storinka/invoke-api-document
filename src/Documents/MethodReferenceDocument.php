<?php

namespace Invoke\Toolkit\Docs\Documents;

use Invoke\Attributes\Parameter;

class MethodReferenceDocument extends Document
{
    #[Parameter]
    public string $methodName;
}