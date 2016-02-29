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

namespace WorldEditArt\Objects\Space\Sphere;

use pocketmine\block\Block;

class HollowSphereBlockStream extends SolidSphereBlockStream{
	/** @var int $minDistSq */
	private $minDistSq;
	/** @var int $maxDistSq */
	private $maxDistSq;

	public function __construct(SphereSpace $sphere, int $padding = 1, int $margin = 0){
		parent::__construct($sphere);
		$radius = $sphere->getRadius();
		$this->minDistSq = ($radius - $padding) ** 2;
		$this->maxDistSq = ($radius + $margin) ** 2;
	}

	protected function accept(Block $block) : bool{
		$ds = $this->center->distanceSquared($block);
		return $this->minDistSq <= $ds and $ds <= $this->maxDistSq;
	}
}
