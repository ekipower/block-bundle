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

interface DocumentationInterface
{
	public function getDocumentations();
	public function setDocumentations(array $documentations = array());
	public function setDocumentation($name, $value);
	public function getDocumentation($name, $default = null);
}
