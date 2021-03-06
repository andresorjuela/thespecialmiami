<?php

class Site extends CI_Controller 
{
    
    public function __cosntruct()
    {
        parent::construct();   
    }

	public function index()
    {

    // get page name
    if (isset ($_GET['page']))
        {
        $current_file = $_GET['page'];
        }
    else
        {
        $current_file = 'index';
        }

    // echo $data['current_file']; //(ie. index)        

		$this->load->model('Navigation_model');
        
        $navigation_list = $this->Navigation_model->get_navigation_parent_items();
        
        $data['navigation_html'] = $this->build_menu($navigation_list, $current_file);
        
        // print_r($navigation_list);
        
        // $data['navigation'] = $this->Navigation_model->get_navigation_parent_items();

        $this->load->view('layouts/layout.php', $data);
	}
    
    public function build_menu($navigation_list, $current_file)
    {
        for ($i = 0; $i < count($navigation_list); $i++)
            {
                if ($navigation_list[$i] == 'Home')
                {
                $nav_menu[$i] = array('url' => 'index', 'text' => $navigation_list[$i], 'class' => strtolower($navigation_list[$i]));
                }
                else
                {
                $nav_menu[$i] = array('url' => strtolower($navigation_list[$i]), 'text' => $navigation_list[$i], 'class' => strtolower($navigation_list[$i]));
                }
            }

            $data = '';

            for ( $i=0; $i < count($nav_menu); $i++)
                {  
                    if ($nav_menu[$i]['url'] == $current_file)
                        {  
                         $data .= '<li id="current">' . $nav_menu[$i]['text'] . ' </li>'; 
                         }

                    else  // else make link
                        {
                        if (($current_file != 'index') && ($nav_menu[$i]['url'] == 'index'))
                            {
                            $data .= '<li><a href="' . $nav_menu[$i]['url'] . '.php">' . $nav_menu[$i]['text'] . ' </a></li>';
                            }
                        else
                            {
                            $data .= '<li><a href="?page=' . $nav_menu[$i]['url'] . '">' . $nav_menu[$i]['text'] . ' </a></li>';
                            }
                         } 
                }
        return $data;    
    }
}

?>