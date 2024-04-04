<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Structure;

use Raptorio\Blockchain\Networking\Ip\IpInterface;

interface NetworkAddressInterface
{
    /**
     * @return int
     */
    public function getServices(): int;

    /**
     * @return IpInterface
     */
    public function getIp(): IpInterface;

    /**
     * @return int
     */
    public function getPort(): int;
}
