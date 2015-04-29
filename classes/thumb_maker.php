<?

class dThumbMaker{
	function getVersion(){
		return "2.21";
	}
	var $info;
	var $backup;
	
	function dThumbMaker($origFilename=false){
		if($origFilename)
			$this->loadFile($origFilename);
	}
	function __destruct(){ /** Need to be manually called if PHP<5 **/
		@imagedestroy($this->info['im']);
		@imagedestroy($this->backup['im']);
	}
	function loadFile($origFilename){
		if(!file_exists($origFilename)){
			return "Image error - not loaded.";
		}
		$this->info['origFilename'] = $origFilename;
		$this->info['origSize']     = @getimagesize($origFilename);
		switch($this->info['origSize'][2]){
			case 1  /*gif*/ : $this->info['im'] = imagecreatefromgif ($origFilename); break;
			case 2  /*jpg*/ : $this->info['im'] = imagecreatefromjpeg($origFilename); break;
			case 3  /*png*/ : $this->info['im'] = imagecreatefrompng ($origFilename); break;
			case 15 /*wbmp*/: $this->info['im'] = imagecreatefromwbmp($origFilename); break;
			default:
				return "Image error - not format GIF, JPG, PNG or WBMP.";
		}
		$this->backup = false;
		return true;
	}
	function resizeMaxSize($maxW, $maxH=false, $constraint=true){
		$origSize = &$this->info['origSize'];
		$im       = &$this->info['im'];
		$resizeByH = 
		$resizeByW = false;
		
		if($origSize[0] > $maxW && $maxW) $resizeByW = true;
		if($origSize[1] > $maxH && $maxH) $resizeByH = true;
		if($resizeByH && $resizeByW){
			$resizeByH = ($origSize[0]/$maxW<$origSize[1]/$maxH);
			$resizeByW = !$resizeByH;
		}
		if    ($resizeByW){
			if($constraint){
				$newW = $maxW;
				$newH = ($origSize[1]*$maxW)/$origSize[0];
			}
			else{
				$newW = $maxW;
				$newH = $origSize[1];
			}
		}
		elseif($resizeByH){
			if($constraint){
				$newW = ($origSize[0]*$maxH)/$origSize[1];
				$newH = $maxH;
			}
			else{
				$newW = $origSize[0];
				$newH = $maxH;
			}
		}
		else{
			$newW = $origSize[0];
			$newH = $origSize[1];
		}
		if($newW != $origSize[0] || $newH != $origSize[1]){
			$imN = imagecreatetruecolor($newW, $newH);
			imagecopyresampled($imN, $im, 0, 0, 0, 0, $newW, $newH, $origSize[0], $origSize[1]);
			imagedestroy($im);
			$this->info['im'] = $imN;
		}
		$this->info['origSize'][0] = $newW;
		$this->info['origSize'][1] = $newH;
	}
	function resizeExactSize($W, $H, $constraint=true){
		$im       = &$this->info['im'];
		$origSize = &$this->info['origSize'];
		if($W && $H){
			$newW = $W;
			$newH = $H;
		}
		elseif($W){
			if($constraint){
				$newW = $W;
				$newH = ($origSize[1]*$W)/$origSize[0];
			}
			else{
				$newW = $W;
				$newH = $origSize[1];
			}
		}
		elseif($H){
			if($constraint){
				$newW = ($origSize[0]*$H)/$origSize[1];
				$newH = $H;
			}
			else{
				$newW = $origSize[0];
				$newH = $H;
			}
		}
		if($newW != $origSize[0] || $newH != $origSize[1]){
			$imN = imagecreatetruecolor($newW, $newH);
			imagecopyresampled($imN, $im, 0, 0, 0, 0, $newW, $newH, $origSize[0], $origSize[1]);
			imagedestroy($im);
			$this->info['im'] = $imN;
		}
		$this->info['origSize'][0] = $newW;
		$this->info['origSize'][1] = $newH;
	}
	function addWaterMark($fileName, $posX=0, $posY=0, $invertido=true, $opacity=100){
		$origSize = &$this->info['origSize'];
		$im       = &$this->info['im'];
		$origWSize = @getimagesize($fileName);
		switch($origWSize[2]){
			case 1  /*gif*/ : $imW = imagecreatefromgif ($fileName); break;
			case 2  /*jpg*/ : $imW = imagecreatefromjpeg($fileName); break;
			case 3  /*png*/ : $imW = imagecreatefrompng ($fileName); break;
			case 15 /*wbmp*/: $imW = imagecreatefromwbmp($fileName); break;
			default:
				return "Image error - not format GIF, JPG, PNG or WBMP.";
		}
		if($invertido===true || (is_array($invertido)&&$invertido[0]))
			$posX = $origSize[0]-$origWSize[0]-$posX;
		if($invertido===true || (is_array($invertido)&&$invertido[1]))
			$posY = $origSize[1]-$origWSize[1]-$posY;
		
		($opacity != 100)?
			imagecopymerge($im, $imW, $posX, $posY, 0, 0, $origWSize[0], $origWSize[1], $opacity):
			imagecopy($im, $imW, $posX, $posY, 0, 0, $origWSize[0], $origWSize[1]);
		
		imagedestroy($imW);
	}
	function rotate($direction){
		$im       = &$this->info['im'];
		$origSize = &$this->info['origSize'];
		
		if($direction == 0)
			$im = imagerotate($im, 90, 0);
		
		if($direction == 1)
			$im = imagerotate($im, 270, 0);
		
		$this->info['im'] = $im;
		$this->info['origSize'][0] = $origSize[1];
		$this->info['origSize'][1] = $origSize[0];
	}
	function crop($startX, $startY, $endX=false, $endY=false){
		$im       = &$this->info['im'];
		$origSize = &$this->info['origSize'];
		
		if($endX == false)
			$endX = $origSize[0]-$startX;
		
		if($endY == false)
			$endY = $origSize[1]-$startY;
		
		$width  = $endX-$startX;
		$height = $endY-$startY;
		
		$imN = imagecreatetruecolor($width, $height);
		imagecopy($imN, $im, 0, 0, $startX, $startY, $width, $height);
		imagedestroy($im);
		
		$this->info['im'] = $imN;
		$this->info['origSize'][0] = $width;
		$this->info['origSize'][1] = $height;
	}
	function cropCenter($width, $height, $moveX=0, $moveY=0){
		$origSize = &$this->info['origSize'];
		$centerX  = $origSize[0]/2;
		$centerY  = $origSize[1]/2;
		
		$topX = $centerX-$width/2;
		$topY = $centerY-$height/2;
		$endX = $centerX+$width/2;
		$endY = $centerY+$height/2;
		
		return $this->crop($topX+$moveX, $topY+$moveY, $endX+$moveX, $endY+$moveY);
	}
	function createBackup(){
		if($this->backup)
			imagedestroy($this->backup['im']);
		$this->backup = $this->info;
		$this->backup['im'] = imagecreatetruecolor($this->info['origSize'][0], $this->info['origSize'][1]);
		imagecopy($this->backup['im'], $this->info['im'], 0, 0, 0, 0, $this->info['origSize'][0], $this->info['origSize'][1]);
	}
	function restoreBackup(){
		imagedestroy($this->info['im']);
		$this->info = $this->backup;
		$this->info['im'] = imagecreatetruecolor($this->info['origSize'][0], $this->info['origSize'][1]);
		imagecopy($this->info['im'], $this->backup['im'], 0, 0, 0, 0, $this->info['origSize'][0], $this->info['origSize'][1]);
	}
	function build($output_filename=false, $output_as=false, $quality=100){
		$origSize = &$this->info['origSize'];
		$im       = &$this->info['im'];
		
		if($output_filename===false){
			// Output filename wasn't found, let's overwrite original file.
			$output_filename = $this->info['origFilename'];
		}
		
		// Try to auto-determine output format
		if(!$output_as)
			$output_as = preg_replace('/^.*\.([^.]+)$/D', '$1', $output_filename);
		
		if    ($output_as == 'gif')  return imagegif ($im, $output_filename);
		elseif($output_as == 'png')  return imagepng ($im, $output_filename);
		elseif($output_as == 'wbmp') return imagewbmp($im, $output_filename);
		else /* default: jpeg     */ return imagejpeg($im, $output_filename, $quality);
	}
}

?>