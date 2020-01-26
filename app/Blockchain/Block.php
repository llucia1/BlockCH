<?php

namespace App\Blockchain;

class Block
{
    public $nonce;

    public function __construct($index, $timestamp, $data, $previousHash = 0)
    {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->hash = $this->calculateHash();
        $this->nonce = 0;
    }

    private function calculateHash()
    {

	    $block = $this->index.$this->previousHash.$this->timestamp.((string)$this->data).$this->nonce;
	    $hash = $this->getHash($block);
        return $hash;

    }
 
    private function getHash($block) {
        return hash("sha256", $block);
    }

    private function verify($block, $hash) {
        return ($hash == $this->getHash($block));
    }
   
}