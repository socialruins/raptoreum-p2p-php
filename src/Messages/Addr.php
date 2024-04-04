<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Messages;

use Raptorio\Blockchain\Networking\Message;
use Raptorio\Blockchain\Networking\NetworkSerializable;
use Raptorio\Blockchain\Networking\Serializer\Message\AddrSerializer;
use Raptorio\Blockchain\Networking\Serializer\Structure\NetworkAddressTimestampSerializer;
use Raptorio\Blockchain\Networking\Structure\NetworkAddressTimestamp;
use BitWasp\Buffertools\BufferInterface;

class Addr extends NetworkSerializable implements \Countable
{
    /**
     * Address of other nodes on the network. As it types the
     * NetworkAddressTimestamp type, it is incompatible with
     * nodes with a version <31402
     * @var NetworkAddressTimestamp[]
     */
    private $addresses = [];

    /**
     * @param NetworkAddressTimestamp[] $addresses
     */
    public function __construct(array $addresses = [])
    {
        foreach ($addresses as $addr) {
            $this->addAddress($addr);
        }
    }

    /**
     * @param NetworkAddressTimestamp $address
     * @return $this
     */
    private function addAddress(NetworkAddressTimestamp $address)
    {
        $this->addresses[] = $address;
        return $this;
    }

    /**
     * @see https://en.bitcoin.it/wiki/Protocol_documentation#addr
     * @return string
     */
    public function getNetworkCommand(): string
    {
        return Message::ADDR;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->addresses);
    }

    /**
     * @return NetworkAddressTimestamp[]
     */
    public function getAddresses(): array
    {
        return $this->addresses;
    }

    /**
     * @param int $index
     * @return NetworkAddressTimestamp
     * @throws \InvalidArgumentException
     */
    public function getAddress(int $index): NetworkAddressTimestamp
    {
        if (false === isset($this->addresses[$index])) {
            throw new \InvalidArgumentException('No address exists at this index');
        }

        return $this->addresses[$index];
    }

    /**
     * @see \Raptorio\Blockchain\SerializableInterface::getBuffer()
     */
    public function getBuffer(): BufferInterface
    {
        return (new AddrSerializer(new NetworkAddressTimestampSerializer()))->serialize($this);
    }
}
