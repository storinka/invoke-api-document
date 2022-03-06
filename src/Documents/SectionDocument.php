<?php

namespace Invoke\Toolkit\Docs\Documents;

use Invoke\Attributes\Parameter;
use Invoke\Toolkit\Validators\ArrayOf;

/**
 * Section document.
 */
class SectionDocument extends Document
{
    /**
     * Title of the section.
     *
     * @var string $name
     */
    #[Parameter]
    public string $name;

    /**
     * Section items.
     *
     * @var array $items
     */
    #[Parameter]
    #[ArrayOf([
        MethodDocument::class,
        TypeDocument::class,
        MarkdownDocument::class,
        IframeDocument::class,
        SectionDocument::class,

        TypeReferenceDocument::class,
        MethodReferenceDocument::class,
    ])]
    public array $items;
}
