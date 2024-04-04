<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Settings;

use Raptorio\Blockchain\Networking\DnsSeeds\TestNetDnsSeeds;

class Testnet3Settings extends NetworkSettings
{
    protected $defaultP2PPort = 10229;

    public function __construct()
    {
        $this->dnsSeeds = new TestNetDnsSeeds();
    }
}
