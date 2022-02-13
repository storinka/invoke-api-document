<?php

namespace Invoke\Toolkit\Docs\Methods;

use Invoke\Invoke;
use Invoke\Meta\NotParameter;
use Invoke\Method;
use Invoke\Toolkit\Docs\Documents\ApiDocument;

/**
 * Get current API document.
 */
class GetApiDocument extends Method
{
    #[NotParameter]
    protected Invoke $invoke;

    public function __construct(Invoke $invoke)
    {
        $this->invoke = $invoke;
    }

    protected function handle(): ApiDocument
    {
        return ApiDocument::fromInvoke($this->invoke);
    }
}