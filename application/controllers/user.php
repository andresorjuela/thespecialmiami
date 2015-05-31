<?php

class User extends MY_Controller 
{
    
    public function __cosntruct()
    {
        parent::construct();   
    }
    
    public function test()
    {
        // $data['name']= 'Andres';
        
        $this->load_view('test');
        
        $this->output->enable_profiler(ENVIRONMENT == 'development');
        
        $this->benchmark->mark('echo_start');
        // echo 'Andres';
        $this->benchmark->mark('echo_end');
        
        // dump($data['buttons_html']);
    }

	public function login()
    {
        $this->load_view('login', 'whole');
	}
    

}

?>