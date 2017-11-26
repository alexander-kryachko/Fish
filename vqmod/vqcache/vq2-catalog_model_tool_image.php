<?php
class ModelToolImage extends Model {
	/**
	*	
	*	@param filename string
	*	@param width 
	*	@param height
	*	@param type char [default, w, h]
	*				default = scale with white space, 
	*				w = fill according to width, 
	*				h = fill according to height
	*	
	*/
	public function resize($filename, $width, $height, $type = "") {
		if (!file_exists(DIR_IMAGE . $filename) || !is_file(DIR_IMAGE . $filename)) {
try {
			
			if($filename == NULL || $filename == '' || !filter_var($filename, FILTER_VALIDATE_URL))	{
				return;
			}
			
			$old_image = $filename;
			$info = pathinfo($filename);
			
			if(!isset($info['extension']))
				return;
			
			$extension = $info['extension'];
			$filename = 'data/'. basename($old_image);
			$new_image =  utf8_substr($filename, 0, utf8_strrpos($filename, '.')) .'.' . $extension;
			
			$img = DIR_IMAGE . $new_image;
			
			$ch = curl_init($old_image);
			//curl_setopt($ch, CURLOPT_NOBODY, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$data = curl_exec($ch);
			$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			if($retcode < 199 || $retcode  > 300) {
				throw new Exception("The url does not exsist: " . $old_image . " Return code : " .$retcode );
				return;
			}
			file_put_contents($img, $data);


			$this->db->query("START TRANSACTION;\n");
			$this->db->query("UPDATE `".DB_PREFIX."product` SET `image` = '" . $this->db->escape(html_entity_decode($new_image, ENT_QUOTES, 'UTF-8')) . "' WHERE `image` = '" . $old_image . "'");
			$this->db->query("UPDATE `".DB_PREFIX."product_image` SET `image` = '" . $this->db->escape(html_entity_decode($new_image, ENT_QUOTES, 'UTF-8')) . "' WHERE `image` = '" . $old_image . "'");
			$this->db->query("UPDATE " . DB_PREFIX . "category SET image = '" . $this->db->escape(html_entity_decode($new_image, ENT_QUOTES, 'UTF-8')) . "' WHERE `image` = '" . $old_image . "'");
			$this->db->query("UPDATE " . DB_PREFIX . "manufacturer SET image = '" . $this->db->escape(html_entity_decode($new_image, ENT_QUOTES, 'UTF-8')) . "' WHERE `image` = '" . $old_image . "'");
			
			if (!file_exists(DIR_IMAGE . $new_image) || !is_file(DIR_IMAGE . $new_image)) {
				$this->db->query("ROLLBACK;");
				return;
			}

			} catch (Exception $e) {
				$errstr = $e->getMessage();
				$errline = $e->getLine();
				$errfile = $e->getFile();
				$errno = $e->getCode();
				if ($this->config->get('config_error_log')) {
					$this->log->write('PHP iURL 2 IMG - A problem occurred with the image : ' . $old_image . ' MSG : '  . get_class($e) . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline );
				}
				$this->db->query("ROLLBACK;");
				return FALSE;
			}
			return;
		} 
		
		$info = pathinfo($filename);
		
		$extension = $info['extension'];
		
		$old_image = $filename;
		$new_image = 'cache/' . $this->slugify(utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . $type .'.' . $extension);
		
		if (!file_exists(DIR_IMAGE . $new_image) || (filemtime(DIR_IMAGE . $old_image) > filemtime(DIR_IMAGE . $new_image))) {
			$path = '';
			
			$directories = explode('/', dirname(str_replace('../', '', $new_image)));
			
			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;
				
				if (!file_exists(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}		
			}

			list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_IMAGE . $old_image);
				$image->resize($width, $height, $type);
				$image->save(DIR_IMAGE . $new_image);
			} else {
				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
			}
		}
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			return $this->config->get('config_ssl') . 'image/' . $new_image;
		} else {
			return $this->config->get('config_url') . 'image/' . $new_image;
		}	
	}
	
	/**
	 * Slugify string.
	 * Used to make filename without rusian letters, spaces, etc.
	 */
	public function slugify($string) {
		return strtolower(trim(preg_replace('~[^0-9a-z\.\/]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
	}
}
?>
