<?php

// class that gets website menu data from db
class Meal_rotation_model extends MY_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // sets next_open_date as YYYY-MM-DD to match format in ts_closedDays table
    // function called in get_tomorrows_lunch_items()
    public function next_open_date()
    {
        // day of the week as 1-7 (Monday-Sunday);
        $this->weekday =  date('N');
        
        // for Monday - Thursday next_open_day is tomorrow
        if($this->weekday <= 4)
        {
            $next_open_date = date('Y-m-d', strtotime('tomorrow'));
        }
        // for Friday - Sunday next_open_day is next Monday
        else
        {
            $next_open_date = date('Y-m-d', strtotime('next Monday'));
        }
        
        // echo 'next_open_day: ' . $this->next_open_day;
        return $next_open_date;
    }   
    
    // gets next day's meal elements from db and makes array $tomorrows_lunch if not closed
    public function get_tomorrows_lunch_items()
    {
        // gets next open day
        $this->next_open_date = $this->next_open_date();
        
        // checks to see if next open day is set to be closed
        // note that if next_open_date is closed this function changes it to a new next_open_date
        $closed_message = $this->check_for_closed();
        
        // sets the menu_id based on the real next_open_date whether closed or not
        $this->menu_id = date('j', strtotime($this->next_open_date));
        // echo 'menu_id: ' . $this->menu_id;
        
        // if closed sends closed message
        if ($closed_message)
        {
            return $closed_message;
        }
        // if open gets lunch information and sends it
        else
        {
            $next_day_lunch = array();

            // query the database by first setting the where condition
            $this->db->where('menu_id', $this->menu_id);
            $query = $this->db->get('ts_menu');

            // turn the result object into a simple array
            if ($query->num_rows() > 0)
            {
                $this->next_day_lunch = $query->row_array();
            }
            
            $check_array = array('first', 'second', 'third', 'side');
            
            foreach($check_array as $item)
            {
                // $course = $item;
                $check_change = $this->next_day_lunch[$item . '_change'];
                // echo 'check: ' . $check_change;
                
                // if there is a change in one of the courses it changes the necessary items in the nex_day_lunch array
                if($check_change != '0')
                {
                    $change_item = $this->check_for_change($item);
                    $this->next_day_lunch[$item] = $change_item[$item];
                    $this->next_day_lunch[$item . '_ingredients'] = $change_item[$item . '_ingredients'];
                    $this->next_day_lunch[$item . '_calories'] = $change_item[$item . '_calories'];
                    $this->next_day_lunch[$item . '_diduknow'] = $change_item[$item . '_diduknow'];
                }
                // if there is no change it makes the change number equal to the menu_id
                else
                {
                    $this->next_day_lunch[$item . '_change'] = $this->menu_id;
                }
            }
        }
        
        $this->next_day_lunch['tomorrows_f'] = $this->word_tomorrows();
        $this->next_day_lunch['img_top'] = $this->img_lunch();
        
        return $this->next_day_lunch;
        
        
    }
    
    // checks to see if tomorrow's menu has been changed and sets correct courses based on it
    public function check_for_change($course)
    {
        // sets the new menu_id for the course changed
        $change = $this->next_day_lunch[$course . '_change'];
        // echo $change;
        
        $ingredients = $course . '_ingredients';
        $calories = $course . '_calories';
        $diduknow = $course . '_diduknow';
        // query the database for the change menu info
        $this->db->select("$course , $ingredients, $calories, $diduknow");
        $this->db->where('menu_id', $change);
        $query = $this->db->get('ts_menu');

        // turn the result object into a simple array
        if ($query->num_rows() > 0)
        {
            $this->next_day_course = $query->row_array();
        }
        return $this->next_day_course;
    }
    
    // Checks if next_open_day is set to be closed
    // function called in get_tomorrows_lunch_items()
    public function check_for_closed()
    {
        // query the database by using sql
        $sql = 'SELECT * FROM ts_closedDays WHERE start_date = ? AND end_date >= ?';
        $query = $this->db->query($sql, array($this->next_open_date, $this->next_open_date));
        
	    //$closedMessage = '';
        //$closedStart = '';
        //$closedEnd = '';
        $closedMessage_html = '';
        
        // turn the result object into a simple array       
        if ($query->num_rows() > 0)
        {
            $this->closed_day_list = $query->row_array();
            
            // get variables from result row
            $closedMessage = $this->closed_day_list['message'];
            $closedStart = $this->closed_day_list['start_date'];
            $closedEnd = $this->closed_day_list['end_date'];
            
            $nextOpenDate_afterClosed = date('l, F jS, Y', strtotime($closedEnd . '+1 Weekday'));
            
            // check to see if closed for 1 day and sets closedMessage_html
            if($closedStart == $closedEnd)
            {
                // if only closed 1 day sets appropriate message
                $start = date('l, F jS, Y', strtotime($closedStart));
                
                $closedMessage_html .= '<h2><br>We will be closed ' . $start;
                $closedMessage_html .= '<br><br>Open again ' . $nextOpenDate_afterClosed . '!</h2>';
                $this->next_open_date = $nextOpenDate_afterClosed;
            }
            // if closed for more than 1 day sets closedMessage_html
            else
            {
                // if closed more than 1 day
                $start = date('l, F jS, Y', strtotime($closedStart));
                $end = date('l, F jS, Y', strtotime($closedEnd));

                $closedMessage_html .= '<h2><br>We will be closed from:</h2>';
                $closedMessage_html .= '<h3>' . $start .'<br>to<br>' . $end .'</h3>';
                $closedMessage_html .= '<br><h2>Open again ' . $nextOpenDate_afterClosed . '!</h2><br></h2>';
                $this->next_open_date = $nextOpenDate_afterClosed;
            }
        }

        return $closedMessage_html;       
    }
    
    public function meal_served()
    {
        // gets menu information for first, second, third and side and puts it into ts_menuRotation table with tomorrow's date, so we can keep track of what meals are served each day and can get stats on most popular menus
    }
    
    public function word_tomorrows()
	{
	
	//Changes Tomorrow's on Friday and Saturday to Monday's
	if (($this->weekday == 5) || ($this->weekday == 6))
		{
        $format_date = date('F jS', strtotime($this->next_open_date));
		$tomorrows  = 'Monday\'s Lunch, ' . $format_date;
		//echo $tomorrows."  "; // for testing
		}
	else 
		{
		$tomorrows = 'Tomorrow\'s Lunch, ';
		}
	return $tomorrows;
	}
    
    public function img_lunch()
    {
        $vartop = '<img src="http://' . base_url() . 'public/img/%d.jpg" alt="Tomorrow\'s Lunch" />';
        $img_top = sprintf($vartop, $this->menu_id);
        
        return $img_top;
    }
    
}
 
?>