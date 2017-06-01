<?php
	class Util {
		public static function saveAsZip($path, $zipFile, $files){
			$destination = $path.$zipFile;
			
			$zip = new ZipArchive();
			if($zip->open($destination, ZIPARCHIVE::CREATE) !== true) {
				return false;
			}
			
			foreach($files as $file){
				$zip->addFile($path.$file, $file);
			}
			$zip->close();
		
			foreach($files as $file){
				@unlink($path.$file);
			}
		}
	}
?>