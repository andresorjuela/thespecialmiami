<?php

// created class to add functionality to all my controllers
class MY_Controller extends CI_Controller
{
    // loads the construct functions of CI_Controller
    function __construct()
    {
        parent::__construct();     
    }
    
    // this automatically loads the default layout (head, navigation, foot)
    // arg 1: page name being displayed
    // arg 2: whether main should be 1 or 2 columns (options: whole, split)
    public function load_view($subview, $main_type)
    {    
        // envoques function current_page to set variable
        $this->data['current_page'] = $this->current_page();
        // I can make it public for all controllers by calling it $this->data...
        // and then in all controllers call it by using $this->data...
        
        // gets navigation info from db
		$this->load->model('Navigation_model');
        $navigation_list = $this->Navigation_model->get_navigation_parent_items();
        
        // based on current page builds navigation html
        $this->data['navigation_html'] = $this->Navigation_model->build_menu($navigation_list, $this->data['current_page']);
        
        // sets arg 2 passed to function to variable data to be used in views/layouts/layout.php
        $this->data['main_type'] = $main_type;
        
        // gets footer info from db
        $this->load->model('Footer_model');
        $button_list = $this->Footer_model->get_button_items();
        
        // builds button html for large displays (desktops and tablets)
        $this->data['buttons_html'] = $this->Footer_model->buildButton_html($button_list, 'gif');
        // builds button html for phones
        $this->data['buttonsSmall_html'] = $this->Footer_model->buildButton_html($button_list, 'jpg');
        
        // makes $data available to the view, not working...
        // $this->load->vars($data);
        
        // $this->load->model('Meal_rotation_model');
        
        // uncomment to see output information: query speeds, etc
        // $this->output->enable_profiler(ENVIRONMENT == 'development');
        
        $this->load->view('layouts/layout.php', $this->data);
    }
    
    public function current_page()
    {
        if (uri_string() != '')
        {
            // checks to see if uri_string has a '/' (anything but letters or numbers)
            if(ctype_alnum(uri_string()))
            {
                // assigns uri_string to current page
                $current_page = uri_string(); 
            }
            else
            {
                // removes any class name from uri and leaves only function
                // ex. 'page/about' -> 'about'
                $current_page = substr(uri_string(), (strpos(uri_string(), '/') +1));
            }
        }
        // if uri == '', then we are at root and asign index to current_page
        else
        {
            $current_page = 'index';
        }
        return $current_page;
    }
    
    public function next_open_meal()
    {
        $this->load->model('Meal_rotation_model');
        
        $this->data['next_menu_or_closed'] = $this->Meal_rotation_model->get_tomorrows_lunch_items();
    }
    
    
}

?>