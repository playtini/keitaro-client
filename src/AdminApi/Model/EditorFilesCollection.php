<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class EditorFilesCollection
{
    /** @var EditorFiles[] */
    private array $items;

    public function __construct(
        array $items
    ) {
        foreach ($items as $item) {
            if ($item instanceof EditorFiles) {
                $this->items[] = $item;
            }
        }
    }

    /**
     * @return EditorFiles[]
     */
    public function all(): array
    {
        return $this->items;
    }
}
