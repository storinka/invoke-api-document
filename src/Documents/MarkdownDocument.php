<?php

namespace Invoke\Toolkit\Docs\Documents;

use Invoke\Attributes\Parameter;

/**
 * Markdown document.
 */
class MarkdownDocument extends Document
{
    /**
     * Markdown name.
     *
     * @var string $name
     */
    #[Parameter]
    public string $name;

    /**
     * Markdown content.
     *
     * @var string $content
     */
    #[Parameter]
    public string $content;
}