<?php

namespace Invoke\Toolkit\Docs;

use Invoke\Extensions\Extension;
use Invoke\Invoke;
use Invoke\Toolkit\Docs\Methods\GetApiDocument;
use Psr\Container\ContainerInterface;

class ApiDocumentExtension implements Extension
{
    public function boot(Invoke $invoke, ContainerInterface $container): void
    {
        $isApiDocumentMethodEnabled = $invoke->getConfig("apiDocument.methods.getApiDocument.enabled", true);
        $getApiDocumentMethod = $invoke->getConfig("apiDocument.methods.getApiDocument.method", GetApiDocument::class);

        if ($isApiDocumentMethodEnabled) {
            $invoke->setMethod("getApiDocument", $getApiDocumentMethod);
        }
    }
}