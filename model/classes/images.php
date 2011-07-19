<?php

class IMAGES
{
	public static function _insert($filearray)
	{
		$applicationStateInstance = application::getInstance();		
		$galerieID = $applicationStateInstance->_getGalerieID();
		if(function_exists('exif_read_data'))
		{
			
			$exif = exif_read_data($_FILES['Filedata']['tmp_name'], 'ANY_TAG', true);
			//Blende	
			$blende = null;			
	        if(isset($exif["EXIF"]["FNumber"])) 
	        {
	            list($num, $den) = explode("/",$exif["EXIF"]["FNumber"]);
	            $blende  = "F/" . ($num/$den);
	        }
	        
	        //Belichtungszeit
	        $belichtungszeit = null;
	        if(isset($exif["EXIF"]["ExposureTime"])) 
	        {
	            list($num, $den) = explode("/", $exif["EXIF"]["ExposureTime"]);
	            if ($num > $den) 
	            {
	                $belichtungszeit = "{$num}s";
	            } else {
	                $den = round($den/$num);
	                $belichtungszeit = "1/{$den}s";
	            }
	        }
	        
	        //Brennweite
	        $brennweite = null;
	        if(isset($exif["EXIF"]["FocalLength"])) 
	        {
	            list($num, $den) = explode("/", $exif["EXIF"]["FocalLength"]);
	            $brennweite  = ($num/$den) . "mm";
	       	}
	        
			//ISO Settings
			$isosetting = null;
			if ( isset($exif["EXIF"]["ISOSpeedRatings"]) ) 
			{
	            $isosetting = $exif["EXIF"]["ISOSpeedRatings"];
	        }
	       	
	        //Blitz
	        $blitz = null;
			if ( isset($exif["EXIF"]["Flash"]) ) 
			{
	            if ($exif["EXIF"]["Flash"] == 0 || $exif["EXIF"]["Flash"] == 16 || $exif["EXIF"]["Flash"] == 24)
	            {
	            	$blitz = 'Blitz wurde nicht ausgelöst';
	            }else{
	            	$blitz = 'Blitz wurde ausgelöst';
	            }
	        }
	        
	        //Kameramarke
	        $marke = null;
	        if(isset($exif["IFD0"]["Make"])) 
	        {
	            $marke = ucwords(strtolower($exif["IFD0"]["Make"]));
	        }
	        
	        //Kameramodel
	        $model = null;
		    if(isset($exif["IFD0"]["Model"])) 
	        {
	            $model = ucwords($exif["IFD0"]["Model"]);
	        }
	        
			//Aufnahmezeitpunkt		
			$aufnahmezeit = null;		
	        if(isset($exif["EXIF"]["DateTimeOriginal"])) 
	        {
	        	$aufnahmezeit = explode(' ', $exif["EXIF"]["DateTimeOriginal"]);
	        	$aufnahmedatum = explode(':', $aufnahmezeit[0]);
	        	$aufnahmedatum = $aufnahmedatum[2].'.'.$aufnahmedatum[1].'.'.$aufnahmedatum[0];
	            $aufnahmezeit = $aufnahmedatum.' '.$aufnahmezeit[1].' Uhr';
	
	        }
	        
	       	//Aufnahmezeitpunkt		
			$aenderungszeit = null;		
	        if(isset($exif["IFD0"]["DateTime"])) 
	        {
	            $aenderungszeit = explode(' ', $exif["IFD0"]["DateTime"]);
	        	$aenderungsdatum = explode(':', $aenderungszeit[0]);
	        	$aenderungsdatum = $aenderungsdatum[2].'.'.$aenderungsdatum[1].'.'.$aenderungsdatum[0];
	            $aenderungszeit = $aenderungsdatum.' '.$aenderungszeit[1].' Uhr';
	
	        }
			
		}else{
			$blende = null;
			$belichtungszeit = null;
			$brennweite = null;
			$isosetting = null;
			$blitz = null;
			$marke = null;
			$model = null;
			$aufnahmezeit = null;
			$aenderungszeit = null;	
		}

        
        //Wenn nötig Filename ändern
        $db = new database();
        $alleBilderInstance = $db->_getBilder();
        $alleBilderArray = $alleBilderInstance->_ausgeben();
        
        $bildname = $_FILES['Filedata']['name'];
        
        foreach ($alleBilderArray as $data)
        {
        	if ($data['bildname'] == $_FILES['Filedata']['name'] && $data['galerie'] == $galerieID)
        	{
        		$randomstring = string::genRandomString(4);
        		$bildname = explode('.', $_FILES['Filedata']['name']);
        		$bildname = $bildname[0] . $randomstring . '.' .$bildname[1];
        	}
        }
        
        $tmp = explode('.', $bildname);
        $iconname = $tmp[0] . '_icon.' . $tmp[1];
		$einBild = new bild(	null, 
								$bildname,
								$iconname,
								1,
								$galerieID,
								1,
								$blende,
								$belichtungszeit,
								$brennweite,
								$isosetting,
								$blitz,
								$marke,
								$model,
								$aufnahmezeit,
								$aenderungszeit);
								
		$watermark = $applicationStateInstance->_getWasserzeichen();
		$path = './view/images/galeriebilder/' . $galerieID . '/'.$bildname;
		$bildtosave = self::_imageResizeAndCopy($_FILES['Filedata']['tmp_name'], 600, 600, $path, $watermark);
		$path_icon = './view/images/galeriebilder/' . $galerieID . '/'.$iconname;
		$icontosave = self::_imageResizeAndCopy($_FILES['Filedata']['tmp_name'], 120, 120, $path_icon, 0);
		$db->_insert($einBild); 
		echo "1";
	}

	public static function _imageResizeAndCopy($imgefile, $max_width, $max_height, $dir, $watermark)
	{
		if ($watermark)
		{
			self::_copyWithWatermark($imgefile, $max_width, $max_height, $dir);
		}else{
			self::_copyWithoutWatermark($imgefile, $max_width, $max_height, $dir);
		}

	}
	
	private static function _copyWithoutWatermark($imgefile, $max_width, $max_height, $dir)
	{
		$imageInfo = getimagesize($imgefile);

		$src_width = $imageInfo[0];
		$src_height = $imageInfo[1];

		$new_height = 1;
		$new_width = 1;
		if($src_width >= $src_height)
		{
			$factor = $max_width / $src_width;
			$new_height_tmp = $src_height * $factor;
			$new_width_tmp = $src_width * $factor;
			if($new_height_tmp > $max_height)
			{
				$factor = $max_height / $new_height_tmp;
				$new_width = $new_width_tmp * $factor;
				$new_height = $new_height_tmp * $factor;
			}else{
				$new_height = $new_height_tmp;
				$new_width = $new_width_tmp;
			}
		}else{
			$factor = $max_height / $src_height;
			$new_height_tmp = $src_height * $factor;
			$new_width_tmp = $src_width * $factor;
			if($new_width_tmp > $max_width)
			{
				$factor = $max_width / $new_width_tmp;
				$new_width = $new_width_tmp * $factor;
				$new_height = $new_height_tmp * $factor;
			}else{
				$new_height = $new_height_tmp;
				$new_width = $new_width_tmp;
			}
		}
		$new_height = round($new_height);
		$new_width = round($new_width);


		$src_img = imagecreatefromjpeg($imgefile);
		$dst_img = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $src_width, $src_height);
		imagejpeg($dst_img, $dir, 100);
		imagedestroy($src_img);
	}
	
	private static function _copyWithWatermark($imgefile, $max_width, $max_height, $dir)
	{
		$imageInfo = getimagesize($imgefile);

		$src_width = $imageInfo[0];
		$src_height = $imageInfo[1];

		$new_height = 1;
		$new_width = 1;
		if($src_width >= $src_height)
		{
			$factor = $max_width / $src_width;
			$new_height_tmp = $src_height * $factor;
			$new_width_tmp = $src_width * $factor;
			if($new_height_tmp > $max_height)
			{
				$factor = $max_height / $new_height_tmp;
				$new_width = $new_width_tmp * $factor;
				$new_height = $new_height_tmp * $factor;
			}else{
				$new_height = $new_height_tmp;
				$new_width = $new_width_tmp;
			}
		}else{
			$factor = $max_height / $src_height;
			$new_height_tmp = $src_height * $factor;
			$new_width_tmp = $src_width * $factor;
			if($new_width_tmp > $max_width)
			{
				$factor = $max_width / $new_width_tmp;
				$new_width = $new_width_tmp * $factor;
				$new_height = $new_height_tmp * $factor;
			}else{
				$new_height = $new_height_tmp;
				$new_width = $new_width_tmp;
			}
		}
		$new_height = round($new_height);
		$new_width = round($new_width);


		$src_img = imagecreatefromjpeg($imgefile);
		$dst_img = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $src_width, $src_height);

		$applicationState = application::getInstance();
		$transition = $applicationState->_getWatermarkTransparency();
		#
		if ($new_height > $new_width)
		{
			$watermarkfile = imagecreatefrompng('./view/images/galeriebilder/watermark_klein.png');
		}else{
			$watermarkfile = imagecreatefrompng('./view/images/galeriebilder/watermark.png');
		}
		
		$watermarkpic_width = imagesx($watermarkfile);
		$watermarkpic_height = imagesy($watermarkfile);
		
		/*
		//neue höhe und breite bestimmen
		$new_watermark_height = round(($watermarkpic_height * $new_width) / $watermarkpic_width);
		$new_watermark_width = $new_width;
		
		
		$dst_watermark = imagecreatetruecolor($new_width, $new_watermark_height);
		
		imagealphablending($dst_watermark, false);
   
        // Create a new transparent color for image
        $color = imagecolorallocatealpha($dst_watermark, 0, 0, 0, 127);
   
        // Completely fill the background of the new image with allocated color.
        //imagefill($dst_watermark, 0, 0, $color);
   
        // Restore transparency blending
        imagesavealpha($dst_watermark, true);
		
		
		imagecopyresampled($dst_watermark, $watermarkfile, 0, 0, 0, 0, $new_width, $new_watermark_height, $watermarkpic_width, $watermarkpic_height);
		imagepng($dst_watermark, './view/images/galeriebilder/file.png', 9);

		$watermarkfile = imagecreatefrompng('./view/images/galeriebilder/file.png');
		*/

		$watermarkdest_x = $new_width / 2 - ($watermarkpic_width / 2);

		$watermarkdest_y = $new_height / 2 - ($watermarkpic_height / 2);

		imagecopymerge($dst_img, $watermarkfile, $watermarkdest_x, $watermarkdest_y, 0, 0, $watermarkpic_width, $watermarkpic_height, $transition);
		
		imagejpeg($dst_img, $dir, 100);
		imagedestroy($watermarkfile);
		imagedestroy($src_img);
		
	}
}