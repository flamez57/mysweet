<?php

namespace hl\library\Tools\Excel;

/**
 * OleReader Class
 */
class OleReader
{

    const NUM_BIG_BLOCK_DEPOT_BLOCKS_POS = 0x2c;
    const SMALL_BLOCK_DEPOT_BLOCK_POS = 0x3c;
    const ROOT_START_BLOCK_POS = 0x30;
    const BIG_BLOCK_SIZE = 0x200;
    const SMALL_BLOCK_SIZE = 0x40;
    const EXTENSION_BLOCK_POS = 0x44;
    const NUM_EXTENSION_BLOCK_POS = 0x48;
    const PROPERTY_STORAGE_BLOCK_SIZE = 0x80;
    const BIG_BLOCK_DEPOT_BLOCKS_POS = 0x4c;
    const SMALL_BLOCK_THRESHOLD = 0x1000;

    // property storage offsets
    const SIZE_OF_NAME_POS = 0x40;
    const TYPE_POS = 0x42;
    const START_BLOCK_POS = 0x74;
    const SIZE_POS = 0x78;

    protected $fileData;

    protected $numBigBlockDepotBlocks = null;
    protected $sbdStartBlock = null;
    protected $rootStartBlock = null;
    protected $extensionBlock = null;
    protected $numExtensionBlocks = null;

    protected $bigBlockChain = [];
    protected $smallBlockChain = [];

    protected $props = [];
    protected $wrkbook = null;
    protected $rootEntry = null;

    public function __construct()
    {
        # code...
    }

    public function read($file)
    {

        $identifierOle       = pack('CCCCCCCC', 0xd0, 0xcf, 0x11, 0xe0, 0xa1, 0xb1, 0x1a, 0xe1);
        $bigBlockDepotBlocks = [];

        if (!is_readable($file)) {
            throw new \Exception('file is not readable.');
        }

        $this->fileData = @file_get_contents($file);

        if (!$this->fileData) {
            throw new \Exception('file is empty');
        }

        if (substr($this->fileData, 0, 8) != $identifierOle) {
            throw new \Exception('file is invalid.');
        }

        $this->numBigBlockDepotBlocks = ReaderUtil::getInt4d($this->fileData, self::NUM_BIG_BLOCK_DEPOT_BLOCKS_POS);
        $this->sbdStartBlock          = ReaderUtil::getInt4d($this->fileData, self::SMALL_BLOCK_DEPOT_BLOCK_POS);
        $this->rootStartBlock         = ReaderUtil::getInt4d($this->fileData, self::ROOT_START_BLOCK_POS);
        $this->extensionBlock         = ReaderUtil::getInt4d($this->fileData, self::EXTENSION_BLOCK_POS);
        $this->numExtensionBlocks     = ReaderUtil::getInt4d($this->fileData, self::NUM_EXTENSION_BLOCK_POS);

        $pos       = self::BIG_BLOCK_DEPOT_BLOCKS_POS;
        $bbdBlocks = $this->numBigBlockDepotBlocks;

        if ($this->numExtensionBlocks != 0) {
            $bbdBlocks = (self::BIG_BLOCK_SIZE - self::BIG_BLOCK_DEPOT_BLOCKS_POS) / 4;
        }

        for ($i = 0; $i < $bbdBlocks; $i++) {
            $bigBlockDepotBlocks[$i] = ReaderUtil::getInt4d($this->fileData, $pos);
            $pos                     += 4;
        }
        for ($j = 0; $j < $this->numExtensionBlocks; $j++) {
            $pos          = ($this->extensionBlock + 1) * self::BIG_BLOCK_SIZE;
            $blocksToRead = min($this->numBigBlockDepotBlocks - $bbdBlocks, self::BIG_BLOCK_SIZE / 4 - 1);

            for ($i = $bbdBlocks; $i < $bbdBlocks + $blocksToRead; $i++) {
                $bigBlockDepotBlocks[$i] = ReaderUtil::getInt4d($this->fileData, $pos);
                $pos                     += 4;
            }

            $bbdBlocks += $blocksToRead;

            if ($bbdBlocks < $this->numBigBlockDepotBlocks) {
                $this->extensionBlock = ReaderUtil::getInt4d($this->fileData, $pos);
            }
        }

        // readBigBlockDepot
        $pos   = 0;
        $index = 0;
        for ($i = 0; $i < $this->numBigBlockDepotBlocks; $i++) {
            $pos = ($bigBlockDepotBlocks[$i] + 1) * self::BIG_BLOCK_SIZE;

            for ($j = 0; $j < self::BIG_BLOCK_SIZE / 4; $j++) {
                $this->bigBlockChain[$index] = ReaderUtil::getInt4d($this->fileData, $pos);
                $pos                         += 4;
                $index++;
            }
        }

        $index    = 0;
        $sbdBlock = $this->sbdStartBlock;
        while ($sbdBlock != -2) {
            $pos = ($sbdBlock + 1) * self::BIG_BLOCK_SIZE;

            for ($j = 0; $j < self::BIG_BLOCK_SIZE / 4; $j++) {
                $this->smallBlockChain[$index] = ReaderUtil::getInt4d($this->fileData, $pos);
                $pos                           += 4;
                $index++;
            }

            $sbdBlock = $this->bigBlockChain[$sbdBlock];
        }

        $entry = $this->readData($this->rootStartBlock);
        $this->readPropertySets($entry);
    }

    public function getWorkbookData()
    {
        if ($this->props[$this->wrkbook]['size'] < self::SMALL_BLOCK_THRESHOLD) {
            $rootdata   = $this->readData($this->props[$this->rootEntry]['startBlock']);
            $streamData = '';
            $block      = $this->props[$this->wrkbook]['startBlock'];

            while ($block != -2) {
                $pos        = $block * self::SMALL_BLOCK_SIZE;
                $streamData .= substr($rootdata, $pos, self::SMALL_BLOCK_SIZE);
                $block      = $this->smallBlockChain[$block];
            }
            return $streamData;
        } else {
            $numBlocks = $this->props[$this->wrkbook]['size'] / self::BIG_BLOCK_SIZE;

            if ($this->props[$this->wrkbook]['size'] % self::BIG_BLOCK_SIZE != 0) {
                $numBlocks++;
            }

            if ($numBlocks == 0) {
                return '';
            }

            $streamData = '';
            $block      = $this->props[$this->wrkbook]['startBlock'];

            while ($block != -2) {
                $pos        = ($block + 1) * self::BIG_BLOCK_SIZE;
                $streamData .= substr($this->fileData, $pos, self::BIG_BLOCK_SIZE);
                $block      = $this->bigBlockChain[$block];
            }

            return $streamData;
        }
    }

    private function readData($startBlock)
    {
        $block = $startBlock;
        $data  = '';

        while ($block != -2) {
            $pos   = ($block + 1) * self::BIG_BLOCK_SIZE;
            $data  = $data . substr($this->fileData, $pos, self::BIG_BLOCK_SIZE);
            $block = $this->bigBlockChain[$block];
        }

        return $data;
    }

    private function readPropertySets($entry)
    {
        $offset = 0;
        while ($offset < strlen($entry)) {
            $d          = substr($entry, $offset, self::PROPERTY_STORAGE_BLOCK_SIZE);
            $nameSize   = ord($d[self::SIZE_OF_NAME_POS]) | (ord($d[self::SIZE_OF_NAME_POS + 1]) << 8);
            $type       = ord($d[self::TYPE_POS]);
            $startBlock = ReaderUtil::getInt4d($d, self::START_BLOCK_POS);
            $size       = ReaderUtil::getInt4d($d, self::SIZE_POS);
            $name       = '';

            for ($i = 0; $i < $nameSize; $i++) {
                $name .= $d[$i];
            }

            $name          = str_replace("\x00", "", $name);
            $this->props[] = ['name' => $name, 'type' => $type, 'startBlock' => $startBlock, 'size' => $size];

            if ((strtolower($name) == "workbook") || (strtolower($name) == "book")) {
                $this->wrkbook = count($this->props) - 1;
            }

            if ($name == "Root Entry") {
                $this->rootEntry = count($this->props) - 1;
            }

            $offset += self::PROPERTY_STORAGE_BLOCK_SIZE;
        }
    }
}
