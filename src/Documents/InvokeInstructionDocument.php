<?php

namespace Invoke\Toolkit\Docs\Documents;

use Invoke\Attributes\Parameter;

/**
 * Invoke instruction document.
 */
class InvokeInstructionDocument extends Document
{
    /**
     * Unique instruction name.
     *
     * @var string
     */
    #[Parameter]
    public string $name; // default

    /**
     * Protocol.
     *
     * @var string $protocol
     */
    #[Parameter]
    public string $protocol; // http/https

    /**
     * Host.
     *
     * @var string $host
     */
    #[Parameter]
    public string $host; // localhost

    /**
     * Port.
     *
     * @var int $port
     */
    #[Parameter]
    public int $port; // port

    /**
     * Path.
     *
     * @var string|null $path
     */
    #[Parameter]
    public ?string $path; // invoke

    /**
     * Data type.
     *
     * @var string $type
     */
    #[Parameter]
    public string $type; // json
}