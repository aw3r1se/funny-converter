<?php

use App\Classes\Html;
use App\Classes\Json;
use App\Services\JsonParserService;

return [
    'from' => [
        'folder' => __DIR__ . '/../storage/from/',
        'entity' => Json::class,
    ],
    'to' => [
        'folder' => __DIR__ . '/../storage/to/',
        'entity' => Html::class,
    ],
    'parser' => JsonParserService::class,
];
