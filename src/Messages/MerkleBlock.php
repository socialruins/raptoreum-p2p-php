<?php

declare(strict_types=1);

namespace Raptorio\Blockchain\Networking\Messages;

use Raptorio\Blockchain\Block\FilteredBlock;
use Raptorio\Blockchain\Networking\Message;
use Raptorio\Blockchain\Networking\NetworkSerializable;
use Raptorio\Blockchain\Networking\Serializer\Message\MerkleBlockSerializer;
use Raptorio\Blockchain\Serializer\Block\BlockHeaderSerializer;
use Raptorio\Blockchain\Serializer\Block\FilteredBlockSerializer;
use Raptorio\Blockchain\Serializer\Block\PartialMerkleTreeSerializer;
use BitWasp\Buffertools\BufferInterface;

class MerkleBlock extends NetworkSerializable
{
    /**
     * @var FilteredBlock
     */
    private $merkle;

    /**
     * @param FilteredBlock $merkleBlock
     */
    public function __construct(FilteredBlock $merkleBlock)
    {
        $this->merkle = $merkleBlock;
    }

    /**
     * @return string
     * @@see https://en.bitcoin.it/wiki/Protocol_documentation#filterload.2C_filteradd.2C_filterclear.2C_merkleblock
     */
    public function getNetworkCommand(): string
    {
        return Message::MERKLEBLOCK;
    }

    /**
     * @return FilteredBlock
     */
    public function getFilteredBlock(): FilteredBlock
    {
        return $this->merkle;
    }

    /**
     * @return BufferInterface
     */
    public function getBuffer(): BufferInterface
    {
        return (new MerkleBlockSerializer(new FilteredBlockSerializer(new BlockHeaderSerializer(), new PartialMerkleTreeSerializer())))->serialize($this);
    }
}
