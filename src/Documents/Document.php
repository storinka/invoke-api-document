<?php

namespace Invoke\Toolkit\Docs\Documents;

use Invoke\Data;

class Document extends Data
{
    public function shouldIncludeTypeName(): bool
    {
        return true;
    }
}