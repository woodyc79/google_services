<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Tim Lochmüller
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * Sitemap Node
 *
 * @copyright Copyright belongs to the respective authors
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_GoogleServices_Domain_Model_Node extends Tx_GoogleServices_Domain_Model_AbstractModel {

	/**
	 * Location
	 *
	 * @var string
	 */
	protected $loc;

	/**
	 * Last modifcation
	 *
	 * @var string
	 */
	protected $lastmod;

	/**
	 * Change frequency
	 *
	 * @var string
	 */
	protected $changefreq;

	/**
	 * Priority
	 *
	 * @var float
	 */
	protected $priority;

	/**
	 * @var Tx_GoogleServices_Domain_Model_Node_Geo
	 */
	protected $geo;

	/**
	 * @var array
	 */
	protected $images;

	/**
	 * @var Tx_GoogleServices_Domain_Model_Node_Video
	 */
	protected $video;

	/**
	 * @var Tx_GoogleServices_Domain_Model_Node_News
	 */
	protected $news;

	/**
	 *
	 * @return string
	 */
	public function getLoc() {
		return $this->loc;
	}

	/**
	 *
	 * @return string
	 */
	public function getLastmod() {
		return $this->lastmod;
	}

	/**
	 *
	 * @return string
	 */
	public function getChangefreq() {
		if (!strlen($this->changefreq)) {
			return FALSE;
		}
		return $this->changefreq;
	}

	/**
	 *
	 * @return float
	 */
	public function getPriority() {
		if ($this->priority === NULL) {
			return -1;
		}
		return $this->priority;
	}

	/**
	 * @return Tx_GoogleServices_Domain_Model_Node_Geo
	 */
	public function getGeo() {
		return $this->geo;
	}

	/**
	 *
	 * @return array
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * @param Tx_GoogleServices_Domain_Model_Node_Image $image
	 */
	public function addImage(Tx_GoogleServices_Domain_Model_Node_Image $image) {
		$this->images[] = $image;
	}

	/**
	 *
	 * @return Tx_GoogleServices_Domain_Model_Node_Video
	 */
	public function getVideo() {
		return $this->video;
	}

	/**
	 *
	 * @return Tx_GoogleServices_Domain_Model_Node_News
	 */
	public function getNews() {
		return $this->news;
	}

	/**
	 *
	 * @param string $loc
	 *
	 * @throws Exception
	 */
	public function setLoc($loc) {
		if (!filter_var($loc, FILTER_VALIDATE_URL)) {
			throw new Exception('The location of a google sitemap has have to be a valid URL');
		}
		$this->loc = $loc;
	}

	/**
	 *
	 * @param string $lastmod
	 */
	public function setLastmod($lastmod) {

		// timestamp or parsable date

		$this->lastmod = $lastmod;
	}

	/**
	 *
	 * @param string $changefreq
	 *
	 * @throws Exception
	 */
	public function setChangefreq($changefreq) {
		$values = array(
			'always',
			'hourly',
			'daily',
			'weekly',
			'monthly',
			'yearly',
			'never'
		);
		if (\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($changefreq)) {
			// Convert
			# Caching Date
		}

		if (!in_array(trim($changefreq), $values)) {
			throw new Exception('The value of the changefreq have to be one of theses values: ' . implode(',', $values));
		}
		$this->changefreq = $changefreq;
	}

	/**
	 *
	 * @param float $priority
	 *
	 * @throws Exception
	 */
	public function setPriority($priority) {
		if (!is_float($priority)) {
			throw new Exception('Parameter $priority has to be a float value');
		}
		if ($priority < 0) {
			$this->setPriority(0.0);
		}
		if ($priority > 1) {
			$this->setPriority(1.0);
		}
		$this->priority = $priority;
	}

	/**
	 * @param Tx_GoogleServices_Domain_Model_Node_Geo $geo
	 */
	public function setGeo(Tx_GoogleServices_Domain_Model_Node_Geo $geo) {
		$this->geo = $geo;
	}

	/**
	 *
	 * @param array $images
	 */
	public function setImages(array $images) {
		$this->images = $images;
	}

	/**
	 *
	 * @param Tx_GoogleServices_Domain_Model_Node_Video $video
	 */
	public function setVideo(Tx_GoogleServices_Domain_Model_Node_Video $video) {
		$this->video = $video;
	}

	/**
	 *
	 * @param Tx_GoogleServices_Domain_Model_Node_News $news
	 */
	public function setNews(Tx_GoogleServices_Domain_Model_Node_News $news) {
		$this->news = $news;
	}

}