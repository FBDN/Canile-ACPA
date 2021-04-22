<?php

/**
 * Smart, easy and simple Image Manipulation
 * 
 * @author Alessandro Coscia, Milano, Italy, php_staff@yahoo.it
 * http://www.codicefacile.it/smartimage
 * @copyright LGPL
 * @version 0.8.9
 *
 */
namespace Fbdn\Utilities;
class SmartImage {
	/**
	 * Source file (path)
	 */
	private $src;

	/**
	 * GD image's identifier
	 */
	private $gdID;

	/**
	 * Image info
	 */
	private $info;

	/**
	 * Initialize image
	 *
	 * @param string $src
	 * @return SmartImage
	 */
	function __construct($src) {
		// set data
		$this->src = $src;
		$this->info = getimagesize($src);
		$this->oldImages = array();
		// open file
		if ( $this->info[2] == 2 )		$this->gdID = @imagecreatefromjpeg($this->src);
		elseif ( $this->info[2] == 1 )	$this->gdID = @imagecreatefromgif($this->src);
		elseif ( $this->info[2] == 3 ) 	$this->gdID = @imagecreatefrompng($this->src);
	}

	/**
	 * Resize an image
	 *
	 * @param integer $w
	 * @param integer $h
	 * @param boolean $cutImage
	 * @return boolean Everything is ok?
	 */
	public function resize($width, $height, $cutImage = false, $mantieni=false) {
		if ($cutImage)
		return $this->resizeWithCut($width, $height);
		else
		return $this->resizeNormal($width, $height, $mantieni);
	}

	/**
	 * Resize an image without cutting it, only do resize
	 * saving proportions and adapt it to the smaller dimension
	 *
	 * @param integer $w
	 * @param integer $h
	 */
	private function resizeCoord($w_base, $h_base, $width, $height, $x1, $y1) {
		// set data
		$size = $this->info;
		$im = $this->gdID;

		if($width>$height){
			$larghezza=$w_base;
			$altezza=$larghezza*$height/$width;	
		}
		else{
			$altezza=$h_base;
			$larghezza=$altezza*$width/$height;	
		}
		$x_dest=(0+$w_base-$larghezza)/2;
		$y_dest=(0+$h_base-$altezza)/2;			

		// optimize convertion with GD2
		if( ($this->GDVersion() == 2) and ($size[2] != 1) ){
			$new = imagecreatetruecolor($w_base, $h_base);
			$white = imagecolorallocate($new, 255, 255, 255);
			imagefilledrectangle($new,0,0,$w_base,$h_base,$white);	
			$result = imagecopyresampled($new, $im, $x_dest, $y_dest, $x1, $y1, $larghezza, $altezza, $width, $height);
		}
		else{			
			$new = imagecreatetruecolor($w_base, $h_base);
			$white = imagecolorallocate($new, 255, 255, 255);
			imagefilledrectangle($new,0,0,$w_base,$h_base,$white);	
			$result = imagecopyresized($new, $im, $x_dest, $y_dest, $x1, $y1, $larghezza, $altezza, $width, $height);
		}


		@imagedestroy($im);
		$this->gdID = $new;
		$this->updateInfo();

		return $result;
	}
	
	
	private function resizeNormal($w, $h, $mantieni) {
		// set data
		$size = $this->info;
		$im = $this->gdID;
		$newwidth = $size[0];
		$newheight = $size[1];

		if( $newwidth > $w ){
			$newheight = ($w / $newwidth) * $newheight;
			$newwidth = $w;
		}
		if( $newheight > $h ){
			$newwidth = ($h / $newheight) * $newwidth;
			$newheight = $h;
		}		
		
		if($mantieni){
			$x=($w-$newwidth)/2;
			$y=($h-$newheight)/2;
			// optimize convertion with GD2
			if( ($this->GDVersion() == 2) and ($size[2] != 1) ){
				$new = imagecreatetruecolor($w, $h);
				$white = imagecolorallocate($new, 255, 255, 255);
				imagefilledrectangle($new, 0, 0, $w, $h, $white);
				$result = imagecopyresampled($new, $im, $x, $y, 0, 0, $newwidth, $newheight, $size[0], $size[1]);
			}
			else{
				$new = imagecreate($w, $h);
				$white = imagecolorallocate($new, 255, 255, 255);
				imagefilledrectangle($new, 0, 0, $w, $h, $white);
				$result = imagecopyresized($new, $im, $x, $y, 0, 0, $newwidth, $newheight, $size[0], $size[1]);
			}
		}
		else{
			// optimize convertion with GD2
			if( ($this->GDVersion() == 2) and ($size[2] != 1) ){
				$new = imagecreatetruecolor($newwidth, $newheight);
				$result = imagecopyresampled($new, $im, 0, 0, 0, 0, $newwidth, $newheight, $size[0], $size[1]);
			}
			else{
				$new = imagecreate($newwidth, $newheight);
				$result = imagecopyresized($new, $im, 0, 0, 0, 0, $newwidth, $newheight, $size[0], $size[1]);
			}
		}

		@imagedestroy($im);
		$this->gdID = $new;
		$this->updateInfo();

		return $result;
	}

	/**
	 * Resize an image cutting it, do resize
	 * adapt it resizing and cutting the original image
	 *
	 * @param integer $w
	 * @param integer $h
	 */
	private function resizeWithCut($w, $h){
		// set data
		$size = $this->info;
		$im = $this->gdID;

		if( $size[0]>$w or $size[1]>$h ){
			$centerX = $size[0]/2;
			$centerY = $size[1]/2;

			$propX = $w / $size[0];
			$propY = $h / $size[1];

			if( $propX < $propY ){
				$src_x = $centerX - ($w*(1/$propY)/2);
				$src_y = 0;
				$src_w = ceil($w * 1/$propY);
				$src_h = $size[1];
			}
			else {
				$src_x = 0;
				$src_y = $centerY - ($h*(1/$propX)/2);
				$src_w = $size[0];
				$src_h = ceil($h * 1/$propX);
			}

			// Resize
			if( ($this->GDVersion() == 2) AND ($size[2] != 1) ){
				$new = imagecreatetruecolor($w, $h);
				$result = imagecopyresampled($new, $im, 0, 0, $src_x, $src_y, $w, $h, $src_w, $src_h);
			}
			else{
				$new = imagecreate($w, $h);
				$result = imagecopyresized($new, $im, 0, 0, $src_x, $src_y, $w, $h, $src_w, $src_h);
			}
			
			@imagedestroy($im);
		}
		else{
			$new = $im;
		}

		$this->gdID = $new;
		$this->updateInfo();

		return $result;
	}
	
	/**
	 * Add a Water Mark to the image
	 * (filigrana)
	 *
	 * @param string $from
	 * @param string $waterMark
	 */
	public function addWaterMarkImage($waterMark, $opacity = 35, $x = 5, $y = 5){
		// set data
		$size = $this->info;
		$im = $this->gdID;

		// set WaterMark's data	
		$waterMarkSM = new SmartImage($waterMark);
		$imWM = $waterMarkSM->getGDid();
	
		// Add it!
		imageCopyMerge($im, $imWM, $x, $y, 0, 0, imagesx($imWM), imagesy($imWM), $opacity);
		$waterMarkSM->close();
	
		$this->gdID = $im;
	}

	/**
	 * Show Image
	 *
	 * @param integer 0-100 $jpegQuality
	 */
	public function printImage($jpegQuality = 100) {
		$this->outPutImage('', $jpegQuality);
	}

	/**
	 * Save the image on filesystem
	 *
	 * @param string $destination
	 * @param integer 0-100 $jpegQuality
	 */
	public function saveImage($destination, $jpegQuality = 100) {
		$this->outPutImage($destination, $jpegQuality);
	}

	/**
	 * Output an image
	 * accessible throught printImage() and saveImage()
	 *
	 * @param unknown_type $dest
	 * @param unknown_type $jpegQuality
	 */
	private function outPutImage($dest = '', $jpegQuality = 100) {
		$size = $this->info;
		$im = $this->gdID;
		// select mime
		if (!empty($dest))
			list($size['mime'], $size[2]) = $this->findMime($dest);
		
		// if output set headers
		if (empty($dest))	header('Content-Type: ' . $size['mime']);
		
		// output image
		if( $size[2] == 2 )			@imagejpeg($im, $dest, $jpegQuality);
		elseif ( $size[2] == 1 )	@imagegif($im, $dest);
		elseif ( $size[2] == 3 )	@imagepng($im, $dest);
	}

	/**
	 * Mime type for a file
	 *
	 * @param string $file
	 * @return string
	 */
	private function findMime($file) {
		$file .= ".";
		$bit = explode(".", $file);
		$ext = $bit[count($bit)-2];
		if ($ext == 'jpg')		return array('image/jpeg', 2);
		elseif ($ext == 'jpeg')	return array('image/jpeg', 2);
		elseif ($ext == 'gif')	return array('image/gif', 1);
		elseif ($ext == 'png')	return array('image/png', 3);
		else	 				array('image/jpeg', 2);
	}

	/**
	 * Get the GD identifier
	 *
	 * @return GD Identifier
	 */
	public function getGDid() {
		return $this->gdID;
	}
	
	/**
	 * Set GD identifier
	 *
	 * @param GD Identifier $value
	 */
	public function setGDid($value) {
		$this->gdID = $value;
	}

	/**
	 * Free memory
	 */
	public function close() {
		@imagedestroy($this->gdID);
	}
	
	/**
	 * Update info class's variable
	 */
	private function updateInfo() {
		$info = $this->info;
		$im = $this->gdID;
		
		$info[0] = imagesx($im);
		$info[1] = imagesy($im);
		
		$this->info = $info;
	}

	/**
	 * GD Version
	 * @return integer
	 */
	public function GDVersion() {
		if ( !in_array('gd', get_loaded_extensions()) )
		return 0;
		elseif ( $this->isGD2supported() )
		return 2;
		else return 1;
	}

	/**
	 * Find GD Version
	 * @return mixed
	 */
	private function isGD2supported(){
		global $GD2;
		if( isset($GD2) and $GD2 )
		return $GD2;
		else{
			$php_ver_arr = explode('.', phpversion());
			$php_ver = intval($php_ver_arr[0])*100+intval($php_ver_arr[1]);

			if( $php_ver < 402 ){ // PHP <= 4.1.x
				$GD2 = in_array('imagegd2',get_extension_funcs("gd"));
			}
			elseif( $php_ver < 403 ){ // PHP = 4.2.x
				$im = @imagecreatetruecolor(10, 10);
				if( $im ){
					$GD2 = 1;
					@imagedestroy($im);
				}
				else $GD2 = 0;
			}
			else{ // PHP = 4.3.x
				$GD2 = function_exists('imagecreatetruecolor');
			}
		}

		return $GD2;
	}
}

?>