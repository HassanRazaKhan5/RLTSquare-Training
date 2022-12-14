<?php

declare(strict_types=1);

namespace RLTSquare\Unit3\Model;

class EnvironmentOptions
{
    public function toOptionArray(): array
    {
        return [
            [
                'value' => 'development',
                'label' => 'Development',
            ],
            [
                'value' => 'staging',
                'label' => 'Staging',
            ],
            [
                'value' => 'production',
                'label' => 'Production'
            ]
        ];
    }
}
