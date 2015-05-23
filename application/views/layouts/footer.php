<div class="row">				
		<div class="show-for-small-only inline small-12 columns">
			<a href="http://eepurl.com/m91kD" target="_blank">Subscribe to our Daily Email Menu!</a>
		</div>
	
	
	<div class="row">
		<div class="show-for-small-only inline small-12 columns">
			
		
				<?php
				
				/* include class for making header buttons and for connecting to db */
				require_once("php/header_button.php");
				require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';
				
				/* retrieve queried results from db */
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
				?>			
			
		</div>
	</div>

		<div class="small-12 columns" id="bottom_box">
	
		<address>
			<div class="p_white" id="phone">
			(305) 586-4077
			</div>
		
			<div class="p_white" id="email">
			info@thespecialmiami.com
			</div>
		
		
			<aside class="inv_small inline">
		
				<?php
				
				/* include class for making header buttons and for connecting to db */
				require_once("php/header_button.php");
				require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';
				
				/* retrieve queried results from db */
				$sql= "SELECT * FROM ts_headerButtons";
				
				$result = mysql_query($sql, $conn) or die (mysql_error());
				
				/* create html display text for each button in db */
				while ($row = mysql_fetch_assoc($result))
				{
					$Button = new header_button();
				
					$name = $row['name'];
					$link = $row['link'];
					$type = 'gif';
				
					$Button->display($name, $link, $type);
				}
				?>
				
			</aside>
		
		
		
		</address>
		
		</div>

		<div class="small-12 columns">
	
			<div id="login">
				
					<h5>
					<li>
					<?=$logout_message?> <?=$login_link?>
					</li>
					</h5>
			
			</div>
				
		</div>
	</div>