<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Enum\FilterFlowModeEnum;

class Filter implements \JsonSerializable
{
    public function __construct(
        public readonly int $id,
        public readonly int $flowId,
        public readonly string $name,
        public readonly FilterFlowModeEnum $mode,
        public readonly array|string $payload,
        public readonly string $oid,
    ) {
    }

    public static function create(array $a): self
    {
        return new self(
            id: $a['id'] ?? 0,
            flowId: $a['stream_id'] ?? 0,
            name: $a['name'] ?? '',
            mode: FilterFlowModeEnum::tryFrom($a['mode'] ?? null) ?? FilterFlowModeEnum::Accept,
            payload: $a['payload'] ?? [], // {per_hour, per_day, total}
            oid: $a['oid'] ?? 0,
        );
    }

    public function jsonSerialize(): array
    {
        $result = [
            'id' => $this->id,
            'stream_id' => $this->flowId,
            'name' => $this->name,
            'mode' => $this->mode->value,
            'payload' => $this->payload,
            'oid' => $this->oid,
        ];

        if (empty($result['id'])) {
            unset($result['id']);
        }
        if (empty($result['stream_id'])) {
            unset($result['stream_id']);
        }
        if (empty($result['oid'])) {
            unset($result['oid']);
        }

        return $result;
    }
}
