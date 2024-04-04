<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Messages;

use Raptorio\Blockchain\Bloom\BloomFilter;
use Raptorio\Blockchain\Networking\Message;
use Raptorio\Blockchain\Networking\NetworkSerializable;
use Raptorio\Blockchain\Networking\Serializer\Message\FilterLoadSerializer;
use Raptorio\Blockchain\Serializer\Bloom\BloomFilterSerializer;
use BitWasp\Buffertools\BufferInterface;

class FilterLoad extends NetworkSerializable
{
    /**
     * @var BloomFilter
     */
    private $filter;

    /**
     * @param BloomFilter $filter
     */
    public function __construct(BloomFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return string
     * @see https://en.bitcoin.it/wiki/Protocol_documentation#filterload.2C_filteradd.2C_filterclear.2C_merkleblock
     */
    public function getNetworkCommand(): string
    {
        return Message::FILTERLOAD;
    }

    /**
     * @return BloomFilter
     */
    public function getFilter(): BloomFilter
    {
        return $this->filter;
    }
    /**
     * @return BufferInterface
     */
    public function getBuffer(): BufferInterface
    {
        return (new FilterLoadSerializer(new BloomFilterSerializer()))->serialize($this);
    }
}
