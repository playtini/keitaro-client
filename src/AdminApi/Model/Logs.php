<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class Logs
{
    public function __construct(
        public readonly \DateTimeInterface $datetime,
        public readonly string $jid,
        public readonly string $message,
    ) {
    }
}
