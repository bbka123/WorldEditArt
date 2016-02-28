<?php

/*
 * WorldEditArt
 *
 * Copyright (C) 2016 PEMapModder
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PEMapModder
 */

namespace WorldEditArt\Objects\BlockStream;

use pocketmine\block\Block;

class Cassette{
	/** @var BlockStream $stream */
	private $stream;
	/** @var BlockChanger $changer */
	private $changer;

	/** @var int $pointer */
	private $pointer = 0;
	/** @var Block[][] $buffer */
	private $buffer;

	public function __construct(BlockStream $stream, BlockChanger $changer){
		$this->stream = $stream;
		$this->changer = $changer;
	}

	/**
	 * @return Block|null
	 */
	public function next(){
		$current = $this->current();
		if($current !== null){
			$this->pointer++;
		}
		return $current;
	}

	public function previous(){
		if($this->pointer === 0){
			return null;
		}
		return $this->buffer[--$this->pointer];
	}

	public function current(){
		while(!isset($this->buffer[$this->pointer])){
			$next = $this->stream->next();
			if($next === null){
				return null;
			}
			$change = $this->changer->changeBlock($next);
			if($change === null){
				continue;
			}
			$change->position($next);
			return $this->buffer[$this->pointer] = [$next, $change];
		}
		return $this->buffer[$this->pointer];
	}
}
