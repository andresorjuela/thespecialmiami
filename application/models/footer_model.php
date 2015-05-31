<?php

// class that gets footer links data from db
class Footer_model extends MY_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    // gets link data from db
    function get_button_items()
    {
        $data = array();
        
        // query the database
        $query = $this->db->query("SELECT name, link FROM ts_headerButtons");
        
        // turn the result object into a simple array with keys name and link
        foreach ($query->result() as $row)
        {
          $button_list[] = array('name' => $row->name, 'link' => $row->link);
        }
        
    return $button_list;        
    }
    
    // with button list and type (gif or jpg) it builds html for footer links
    // used twice, once for large format display (gif) and once for phones (jpg)
    function buildButton_html($button_list, $type)
    {
        $buttons_html = '';
        
        foreach($button_list as $row)
        {
            $name = $row['name'];
            $link = $row['link'];

            $buttons_html .=  '<div class="bottom-links"><a href="' . $row["name"] . '" target="_blank" ><img class="top" style="display:inline" src="http://' . site_url("public/img") . '/' . $row["name"] . 'TheSpecial.' . $type . '" alt="The Special Miami' . strtoupper($row["name"]) . '"width="40" height="41" /></a></div>';
        }
        
        return $buttons_html;
    } 
}

?>