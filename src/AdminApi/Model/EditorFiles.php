<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class EditorFiles
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $ext,
        public readonly string $path,
        public readonly EditorFilesCollection $children,
    ) {
    }
}
