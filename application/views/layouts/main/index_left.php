<div class="space">
			</div>
			<?php			
			$lunch_type = 'Vegetarian'			
			?>
			
			<h4 class="mobile_date">
			<?=$next_menu_or_closed['tomorrows_f']?>
			</time>
			</h4>
			
		
			<p class="orderbutton_maincourse">
			<a href="?page=order" id="index_order_button">
			ORDER NOW
			</a>
			</p>
		
			
			<h4 class="orderbutton_maincourse">
			Main Course
			</h4>
			
			
			<p class="menu_text">
			<?=$next_menu_or_closed['first']?>
			</p>
			
			<h4 class="orderbutton_maincourse">
			Side
			</h4>
			
			<p class="menu_text menu_to_pic">
			<?=$next_menu_or_closed['side']?>
			</p>
			
			
			
			
			<img src="http://<?=base_url();?>public/img/divider_menu.gif" class="show-for-medium-up" alt="decoration" border="0" />

<?php

//echo 'Subsection: main/index';

//dump($next_menu_or_closed);
      
      ?>