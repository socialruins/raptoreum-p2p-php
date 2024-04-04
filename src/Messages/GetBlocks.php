<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Messages;

use Raptorio\Blockchain\Networking\Message;
use Raptorio\Blockchain\Networking\Serializer\Message\GetBlocksSerializer;
use Raptorio\Blockchain\Serializer\Chain\BlockLocatorSerializer;
use BitWasp\Buffertools\BufferInterface;

class GetBlocks extends AbstractBlockLocator
{
    /**
     * @see https://en.bitcoin.it/wiki/Protocol_documentation#getblocks
     * @return string
     */
    public function getNetworkCommand(): string
    {
        return Message::GETBLOCKS;
    }

    /**
     * @return BufferInterface
     */
    public function getBuffer(): BufferInterface
    {
        return (new GetBlocksSerializer(new BlockLocatorSerializer()))->serialize($this);
    }
}
