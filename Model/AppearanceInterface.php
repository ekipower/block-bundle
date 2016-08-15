<?php
/**
 * This file is part of the Ekipower eZ Website package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\Block\BlockBundle\Model;

interface AppearanceInterface
{
	public function getAppearances();
	public function setAppearances(array $appearances = array());
	public function setAppearance($name, $value);
	public function getAppearance($name, $default = null);
}
