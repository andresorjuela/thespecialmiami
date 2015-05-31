<?php

// class that gets website navigation data from db
class Navigation_model extends MY_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    // gets navigation elements from db and makes array $navigation_list
    function get_navigation_parent_items()
    {
        $data = array();
        
        // query the database
        $query = $this->db->query("SELECT menu_name FROM ts_navigation LIMIT 5");
        // could also use...
        // $query = $this->db->get('ts_navigation', 5);
        
        // turn the result object into a simple array
        foreach ($query->result() as $row)
        {
          $navigation_list[] = $row->menu_name;
        }
   
    return $navigation_list;           
    }
    
    // takes the navigation list and current page info and builds the navigation html
    public function build_menu($navigation_list, $current_page)
    {
        // creates array nav_menu with url, text and class keys
        for ($i = 0; $i < count($navigation_list); $i++)
        {
             // used to change the word home to the url index for homepage url
            if ($navigation_list[$i] == 'Home')
            {
                $nav_menu[$i] = array('url' => 'index', 'text' => $navigation_list[$i], 'class' => strtolower($navigation_list[$i]));
            }
            // all other links but home
            else
            {
                $nav_menu[$i] = array('url' => strtolower($navigation_list[$i]), 'text' => $navigation_list[$i], 'class' => strtolower($navigation_list[$i]));
            }
        }

        $data = '';

        for ( $i=0; $i < count($nav_menu); $i++)
        {  
            // checks for current page index and makes it thin text in menu
            if ($nav_menu[$i]['url'] == $current_page)
            {  
                $data .= '<li id="current">' . $nav_menu[$i]['text'] . ' </li>'; 
            }
            else 
            {
                // if index not current page it makes it a link
                if (($current_page != 'index') && ($nav_menu[$i]['url'] == 'index'))
                {
                    $data .= '<li><a href="http://' . base_url() . '">' . $nav_menu[$i]['text'] . ' </a></li>';
                }
                // makes all other pages not current page links
                else
                {

                    $data .= '<li><a href="http://' . base_url() . 'page/' . $nav_menu[$i]['url'] . '">' . $nav_menu[$i]['text'] . ' </a></li>';
                }
            } 
        }
        return $data;    
    }
}

?>