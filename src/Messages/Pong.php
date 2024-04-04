<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Messages;

use Raptorio\Blockchain\Networking\Message;
use Raptorio\Blockchain\Networking\NetworkSerializable;
use Raptorio\Blockchain\Networking\Serializer\Message\PongSerializer;
use BitWasp\Buffertools\BufferInterface;

class Pong extends NetworkSerializable
{
    /**
     * @var BufferInterface
     */
    private $nonce;

    /**
     * @param BufferInterface $nonce
     */
    public function __construct(BufferInterface $nonce)
    {
        if ($nonce->getSize() !== 8) {
            throw new \RuntimeException("Invalid nonce size");
        }
        $this->nonce = $nonce;
    }

    /**
     * @return string
     * @see https://en.bitcoin.it/wiki/Protocol_documentation#pong
     */
    public function getNetworkCommand(): string
    {
        return Message::PONG;
    }

    /**
     * @return BufferInterface
     */
    public function getNonce(): BufferInterface
    {
        return $this->nonce;
    }

    /**
     * @return BufferInterface
     */
    public function getBuffer(): BufferInterface
    {
        return (new PongSerializer())->serialize($this);
    }
}
