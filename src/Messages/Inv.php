<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Messages;

use Raptorio\Blockchain\Networking\Message;
use Raptorio\Blockchain\Networking\Serializer\Message\InvSerializer;
use Raptorio\Blockchain\Networking\Serializer\Structure\InventorySerializer;
use BitWasp\Buffertools\BufferInterface;

class Inv extends AbstractInventory
{
    /**
     * @see https://en.bitcoin.it/wiki/Protocol_documentation#inv
     * @return string
     */
    public function getNetworkCommand(): string
    {
        return Message::INV;
    }

    /**
     * {@inheritdoc}
     * @see \Raptorio\Blockchain\SerializableInterface::getBuffer()
     */
    public function getBuffer(): BufferInterface
    {
        return (new InvSerializer(new InventorySerializer()))->serialize($this);
    }
}
