<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Messages;

use Raptorio\Blockchain\Networking\Message;
use Raptorio\Blockchain\Networking\Serializer\Message\NotFoundSerializer;
use Raptorio\Blockchain\Networking\Serializer\Structure\InventorySerializer;
use BitWasp\Buffertools\BufferInterface;

class NotFound extends AbstractInventory
{
    /**
     * @see https://en.bitcoin.it/wiki/Protocol_documentation#notfound
     * @return string
     */
    public function getNetworkCommand(): string
    {
        return Message::NOTFOUND;
    }

    /**
     * {@inheritdoc}
     * @see \Raptorio\Blockchain\SerializableInterface::getBuffer()
     */
    public function getBuffer(): BufferInterface
    {
        return (new NotFoundSerializer(new InventorySerializer()))->serialize($this);
    }
}
