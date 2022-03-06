<?php

namespace Invoke\Toolkit\Docs\Documents;

use Invoke\Attributes\Parameter;

/**
 * IFrame document.
 */
class IframeDocument extends Document
{
    /**
     * Iframe name.
     *
     * @var string $name
     */
    #[Parameter]
    public string $name;

    /**
     * IFrame url.
     *
     * @var string $url
     */
    #[Parameter]
    public string $url;
}