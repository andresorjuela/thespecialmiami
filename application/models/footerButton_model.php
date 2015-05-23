<?php

// class that gets website navigation data from db
class FooterButton_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_footerButton_items()
    {
        $data = array();
        
        // query the database
        $query = $this->db->query("SELECT menu_name FROM ts_navigation LIMIT 5");
        
        // turn the result object into a simple array
        foreach ($query->result() as $row)
        {
          $navigation_list[] = $row->menu_name;
        }
        
        // $query = $this->db->get('ts_navigation', 5);
        
    return $button_list;   
        
        
        $sql= "SELECT * FROM ts_headerButtons";
				
				$result = mysql_query($sql, $conn) or die (mysql_error());
				
				/* create html display text for each button in db */
				while ($row = mysql_fetch_assoc($result))
				{
					$Button = new header_button();
				
					$name = $row['name'];
					$link = $row['link'];
					$type = 'jpg';
				
					$Button->display($name, $link, $type);
				}
        
    }
    
    
    function headerButton_html($name, $link, $type)
    {
        $uc_name = ucfirst($name);
	echo <<<HTML_BLOCK
	
<div class="bottom-links">
	<a href="{$link}" target="_blank" >
		
		<img class="top" style="display:inline" src="img/{$name}TheSpecial.{$type}" alt="The Special Miami {$uc_name}" width="40" height="41" />
	</a>
</div>
HTML_BLOCK;
    }
    
}

?>