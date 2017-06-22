<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Make_thumbnails extends Admin_Controller {
/// $filepath = original image location , $thumbpath = thumbnail image location  
    public function create_thumbnails($filepath,$thumbpath,$thumbnail_width,$thumbnail_height){
		 list($original_width, $original_height, $original_type) = getimagesize($filepath);
		if ($original_width > $original_height) {
			$new_width = $thumbnail_width;
			$new_height = intval($original_height * $new_width / $original_width);
		} else {
			$new_height = $thumbnail_height;
			$new_width = intval($original_width * $new_height / $original_height);
		}
		$dest_x = intval(($thumbnail_width - $new_width) / 2);
		$dest_y = intval(($thumbnail_height - $new_height) / 2);

		if ($original_type === 1) {
			$imgt = "ImageGIF";
			$imgcreatefrom = "ImageCreateFromGIF";
		} else if ($original_type === 2) {
			$imgt = "ImageJPEG";
			$imgcreatefrom = "ImageCreateFromJPEG";
		} else if ($original_type === 3) {
			$imgt = "ImagePNG";
			$imgcreatefrom = "ImageCreateFromPNG";
		} else {
			return false;
		}

		$old_image = $imgcreatefrom($filepath);
		$new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
		$white = imagecolorallocate($new_image, 255, 255, 255); 
		imagefill($new_image,0,0,$white);
		imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
		$imgt($new_image, $thumbpath);

		return file_exists($thumbpath);
    }
}

