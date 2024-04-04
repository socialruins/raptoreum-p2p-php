<?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Networking\DnsSeeds;

class MainNetDnsSeeds extends DnsSeedList
{
    public function __construct()
    {
        parent::__construct([
            'lbdn.raptoreum.com',
            '51.89.21.112',
        ]);
    }
}
