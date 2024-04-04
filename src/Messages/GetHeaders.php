<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Messages;

use Raptorio\Blockchain\Networking\Message;
use Raptorio\Blockchain\Networking\Serializer\Message\GetHeadersSerializer;
use Raptorio\Blockchain\Serializer\Chain\BlockLocatorSerializer;
use BitWasp\Buffertools\BufferInterface;

class GetHeaders extends AbstractBlockLocator
{
    /**
     * @see https://en.bitcoin.it/wiki/Protocol_documentation#getheaders
     * @return string
     */
    public function getNetworkCommand(): string
    {
        return Message::GETHEADERS;
    }

    /**
     * @return BufferInterface
     */
    public function getBuffer(): BufferInterface
    {
        return (new GetHeadersSerializer(new BlockLocatorSerializer()))->serialize($this);
    }
}
