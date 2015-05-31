<?php

class Page extends MY_Controller 
{
    
    public function __cosntruct()
    {
        parent::construct();   
    }
    
    // page used for development and set to show as default page for any called non existing class and or method (this is set in config/routes.php)
    public function test()
    {   
        $this->load_view('test', 'whole');
        
        $this->output->enable_profiler(ENVIRONMENT == 'development');
        
        $this->load->model('Meal_rotation_model');
        
        $this->data['next_menu_or_closed'] = $this->Meal_rotation_model->get_tomorrows_lunch_items();

        // for testing the speed between to points in your code
        // $this->benchmark->mark('echo_start');
        // echo 'Andres';
        // $this->benchmark->mark('echo_end');

        // note next_meal_list can be a string if closed next day
        // or an array if open next day
        dump($this->data['next_menu_or_closed']);
    }
    
    // page loaded as default when website called
    // there is an indication in /.htaccess which takes care of call without http:// for production site
	public function index()
    {     
        // gets info for next meal or closed and sends it to index as array
        $data = $this->next_open_meal();
        
        // calls load_view() in MY_Controller class and creates and loads basic layout view
        $this->load_view('index', 'split');
        
        
    }
    
    public function about()
    {        
        $this->load_view('about', 'whole');
    }
       
    public function reviews()
    {        
        $this->load_view('reviews', 'whole');
    }

    public function faq()
    {        
        $this->load_view('faq', 'whole');
    }

    public function catering()
    {        
        $this->load_view('catering', 'whole');
    }

}

?>