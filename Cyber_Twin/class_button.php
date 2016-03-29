<?php
include('db.php');
class Buttons  {
	
		public $buttons=array();
		


		public function get_buttons($under){
			if(is_null($under)){
				$query="select id,name,show_name from buttons where under is NULL";
				//echo $query;
				//statement($query);
				include('db.php');
				if($fetch=$db->query($query)) {
						$temp = array();
						 while ($row = $fetch->fetch_row()) {
	        				 $temp[$row[0]]=array($row[1],$row[2]);
	        				 //echo $row[0];
	        				 //echo "as";
	    				}
	    			//print_r($temp);
	    			$this->buttons=$temp;
	    				return $this->buttons;
				}
				return false;
			}else{
				$query="select id,name,show_name from buttons where under = $under";
				//echo $query;
				//statement($query);
				include('db.php');
				if($fetch=$db->query($query)) {
						$temp = array();
						 while ($row = $fetch->fetch_row()) {
	        				 $temp[$row[0]]=array($row[1],$row[2]);
	        				 //echo $row[0];
	        				 //echo "as";
	    				}
	    			//print_r($temp);
	    			$this->buttons=$temp;
	    				return $this->buttons;
				}
				return false;	
			}
		}



}
?>