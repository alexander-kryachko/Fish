<?php
class ModelModuleReplacelib extends Model 
{
  public function selectdata()
  {
    $query= $this->db->query("SHOW TABLES LIKE '".DB_PREFIX."replacelib'");
	  if($query->num_rows > 0)
	   {
    $query=$this->db->query("select * from ".DB_PREFIX."replacelib where status=1");
	return $query->rows;
	   }
  }
  public function selecttable()
  {
     $query= $this->db->query("SHOW TABLES LIKE '".DB_PREFIX."replacelib'");
	  if($query->num_rows > 0)
	   {
    $query=$this->db->query("select * from ".DB_PREFIX ."extension where code='replacelib'");
	if($query->num_rows==0)
	 {
	return 0;
	 }
	else
    {	
  	return 1;
	}
	} 
  }
  
}
?>