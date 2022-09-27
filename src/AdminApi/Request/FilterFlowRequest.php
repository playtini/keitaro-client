<?php

namespace Playtini\KeitaroClient\AdminApi\Request;

use Playtini\KeitaroClient\AdminApi\Enum\FilterFlowModeEnum;

class FilterFlowRequest implements \JsonSerializable
{
    public function __construct(
        public readonly ?int $id = null, // Flow filter ID. Provide it if you update the filter.
        public readonly string $name = '', // Flow filter name, see 'retrieve-stream-filters' section
        public readonly FilterFlowModeEnum $mode = FilterFlowModeEnum::Accept, // Filter mode
        public readonly array $payload = [], // string[]. Flow payload. This field contains values for filters. For example, for a "keyword" Filter an Array ["value1", "value2"] must be provided
    ) {
    }

    public function jsonSerialize(): array
    {
        $result = [
            'id' => $this->id,
            'name' => $this->name,
            'mode' => $this->mode->value,
            'payload' => $this->payload,
        ];

        if (empty($result['id'])) {
            unset($result['id']);
        }

        return $result;
    }
}
