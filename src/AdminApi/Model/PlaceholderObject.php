<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class PlaceholderObject
{
    public function __construct(
        public readonly string $name,
        public readonly string $placeholder,
        public readonly string $alias,
    ) {
    }

    public static function create(?array $a = null, string $defaultName = ''): self
    {
        $a = array_merge(['name' => null, 'placeholder' => null, 'alias' => null], $a ?? []);

        return new self(
            name: $a['name'] ?? $defaultName,
            placeholder: $a['placeholder'] ?? '',
            alias: $a['alias'] ?? '',
        );
    }
}
