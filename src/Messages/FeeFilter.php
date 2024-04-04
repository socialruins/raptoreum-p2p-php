<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Messages;

use Raptorio\Blockchain\Networking\Message;
use Raptorio\Blockchain\Networking\NetworkSerializable;
use Raptorio\Blockchain\Networking\Serializer\Message\FeeFilterSerializer;
use BitWasp\Buffertools\BufferInterface;

class FeeFilter extends NetworkSerializable
{
    /**
     * Fee rate per 1000 bytes
     * @var int
     */
    protected $feeRate;

    /**
     * FeeFilter constructor.
     * @param int $feeRate
     */
    public function __construct(int $feeRate)
    {
        $this->feeRate = $feeRate;
    }

    /**
     * @return int
     */
    public function getFeeRate(): int
    {
        return $this->feeRate;
    }

    /**
     * @return string
     * @see https://en.bitcoin.it/wiki/Protocol_documentation#filterload.2C_filteradd.2C_filterclear.2C_merkleblock
     */
    public function getNetworkCommand(): string
    {
        return Message::FEEFILTER;
    }

    /**
     * @return \BitWasp\Buffertools\BufferInterface
     */
    public function getBuffer(): BufferInterface
    {
        return (new FeeFilterSerializer())->serialize($this);
    }
}
