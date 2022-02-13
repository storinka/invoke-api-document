<?php

namespace Invoke\Toolkit\Docs;

use Invoke\Pipe;
use Invoke\Toolkit\Docs\Documents\SectionDocument;

abstract class SectionBuilder implements Pipe
{
    public abstract function build(array $types, array $methods): SectionDocument;

    public function pass(mixed $value): mixed
    {
        return $this->build(
            $value["types"],
            $value["methods"]
        );
    }
}