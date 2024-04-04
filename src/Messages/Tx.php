<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Messages;

use Raptorio\Blockchain\Networking\Message;
use Raptorio\Blockchain\Networking\NetworkSerializable;
use BitWasp\Buffertools\BufferInterface;

class Tx extends NetworkSerializable
{
    /**
     * Tx describes a bitcoin transaction, in reply to getdata
     *
     * @var BufferInterface
     */
    private $transaction;

    public function __construct(BufferInterface $tx)
    {
        $this->transaction = $tx;
    }

    /**
     * {@inheritdoc}
     * @see https://en.bitcoin.it/wiki/Protocol_documentation#tx
     * @see \Raptorio\Blockchain\Network\NetworkSerializableInterface::getNetworkCommand()
     */
    public function getNetworkCommand(): string
    {
        return Message::TX;
    }

    /**
     * @return BufferInterface
     */
    public function getTransaction(): BufferInterface
    {
        return $this->transaction;
    }

    /**
     * {@inheritdoc}
     * @see \Raptorio\Blockchain\SerializableInterface::getBuffer()
     */
    public function getBuffer(): BufferInterface
    {
        return $this->transaction;
    }
}
