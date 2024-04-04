<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Messages;

use Raptorio\Blockchain\Networking\Message;
use Raptorio\Blockchain\Networking\NetworkSerializable;
use Raptorio\Blockchain\Networking\Serializer\Message\FilterAddSerializer;
use BitWasp\Buffertools\BufferInterface;

class FilterAdd extends NetworkSerializable
{
    /**
     * @var BufferInterface
     */
    private $data;

    /**
     * @param BufferInterface $data
     */
    public function __construct(BufferInterface $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     * @see https://en.bitcoin.it/wiki/Protocol_documentation#filterload.2C_filteradd.2C_filterclear.2C_merkleblock
     */
    public function getNetworkCommand(): string
    {
        return Message::FILTERADD;
    }

    /**
     * @return BufferInterface
     */
    public function getData(): BufferInterface
    {
        return $this->data;
    }

    /**
     * @return BufferInterface
     */
    public function getBuffer(): BufferInterface
    {
        return (new FilterAddSerializer())->serialize($this);
    }
}
