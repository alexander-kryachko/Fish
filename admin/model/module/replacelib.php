<?php
class ModelModuleReplacelib extends Model {
public function addurl($data) {
     $query= $this->db->query("SHOW TABLES LIKE '".DB_PREFIX."replacelib'");
	  if($query->num_rows == 0)
	   {
	   $result=$this->db->query("CREATE TABLE IF NOT EXISTS  ".DB_PREFIX."replacelib (id int(12) NOT NULL AUTO_INCREMENT,
                                 url VARCHAR(128) ,
                                 status TINYINT(11),
                                  PRIMARY KEY (`id`)
                                  )");
	   	foreach($data['min_js'] as $js)
		{
		  $this->db->query("INSERT INTO " . DB_PREFIX . "replacelib set url='".$js."',status=1");
		}
	  }
	   else
	   {  
	   if(isset($data['min_js']))
		{
	           foreach($data['min_js'] as $js)
	         {
	            $result=$this->db->query("SELECT * from " . DB_PREFIX . "replacelib where url='".$js."'");
		        if($result->num_rows == 0)
		        {
		         $this->db->query("INSERT INTO " . DB_PREFIX . "replacelib set url='".$js."',status=1");
		        }
		      else
		       {
		       $this->db->query("UPDATE " . DB_PREFIX . "replacelib SET status=1 WHERE url='".$js."'");
		        }
	        } 
	    }
	      $total_array=array();
		  if(isset($data['min_js']))
          {		  
		  $total_array = array_merge($data['min_js']);
		  }
	       $ids = join(' \' , \'', $total_array);
      	 $result=$this->db->query("UPDATE " . DB_PREFIX . "replacelib set status=0 where url NOT IN ('".$ids."')");
      
      }
	  
   }
   
   public function selectdata($js='')
   {
     $query= $this->db->query("SHOW TABLES LIKE '".DB_PREFIX."replacelib'");
	  if($query->num_rows > 0)
	   {
        $result=$this->db->query("SELECT * from " . DB_PREFIX . "replacelib WHERE url='".$js."'");
	    return $result->rows;
	   }	
   }
   
}
?>