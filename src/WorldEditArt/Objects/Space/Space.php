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

namespace WorldEditArt\Objects\Space;

use pocketmine\level\Level;
use WorldEditArt\Objects\BlockStream\Cassette;

abstract class Space{
	/** @var Level $level */
	private $level;

	protected function __construct(Level $level){
		$this->level = $level; // TODO handle LevelUnloadEvent, garbage spaces and streams using that level
	}

	public function getLevel() : Level{
		return $this->level;
	}

	public abstract function getSolidCassette() : Cassette;

	public abstract function getHollowCassette() : Cassette;

	public abstract function getApproxBlockCount() : int;

	public function isValid() : bool{
		return true;
	}

	public function throwValid(){
		if(!$this->isValid()){
			throw new \InvalidStateException("Attempt to call method on an invalid Space object");
		}
	}
}
