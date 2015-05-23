<?php

// class that gets website navigation data from db
class Navigation_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_navigation_parent_items()
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
        
    return $navigation_list;    
        
    }
    
}

?>