<?php

namespace Invoke\Toolkit\Docs\Documents;

use Invoke\Attributes\Parameter;
use Invoke\Data;

/**
 * Header document.
 */
class HeaderDocument extends Data
{
    /**
     * Header name.
     *
     * @var string $name
     */
    #[Parameter]
    public string $name;
}