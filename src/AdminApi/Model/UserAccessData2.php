<?php

namespace Playtini\KeitaroClient\AdminApi\Model;

class UserAccessData2
{
    public function __construct(
        public readonly array $resources, // string[]. Available resources
        //public readonly array $allowedResources, // string[]. Allowed resources // TODO: test. Most probably not working
        public readonly array $reports, // string[]. Allowed reports
    ) {
    }
}
