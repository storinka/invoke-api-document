# Invoke API Document

Documentation toolkit for Invoke.

## Installation

1. Install the dependency via composer:

```shell
composer require storinka/invoke-api-document
```

2. Register the extension:

```php
use Invoke\Toolkit\Docs\ApiDocumentExtension;

$invoke->registerExtension(ApiDocumentExtension::class);
```

## Configuration

```php
$invoke->setConfig([
    "apiDocument" => [
        // Name of the API
        "name" => "Invoke API Document",

        // Short description of the API
        "summary" => "API documentation by Invoke API Document.",

        // Url to API icon
        "iconUrl" => "https://user-images.githubusercontent.com/21020331/145628046-ca19dbdf-2935-49fe-934c-a171219566cc.png",

        // Show only icon without name in header
        "iconOnly" => true,
        
        // Documentation sections
        "sections" => [
            // Default section with list of methods
            \Invoke\Toolkit\Docs\Sections\MethodsSection::class
            
            // You can put here your custom sections
        ],
        
        // Documentation methods
        "methods" => [
            "getApiDocument" => [
                "enabled" => true,
                "method" => \Invoke\Toolkit\Docs\Methods\GetApiDocument::class
            ]
        ],
        
        // Invoke instruction
        "invokeInstruction" => [
            // Name of the instruction
            "name" => "fetch",
            
            // Server protocol
            "protocol" => "http",
            
            // Server host
            "host" => "localhost",
            
            // Server port
            "port" => 8081,
            
            // Url path
            "path" => "",
        ]
    ]
]);
```
