<!DOCTYPE html><html lang='en'>

<html>
    
    <head>

    <?php
    
    // loads the head: css, meta tags, googleanalytics, scripts...
    $this->load->view('layouts/head.php');

    ?>
        
	</head>
    
    <!-- body open and javascript for order page form -->
	<body onload='document.order_form.email.focus()'>	

        <div class="container">
            
            <header>

            <?php

            // loads the company logo and 3 top links
            $this->load->view('layouts/page_head.php');

            ?>

            <!-- prepares the navigation and loads it -->
            <?php

            // loads the website navigation
            $this->load->view('layouts/navigation.php', $navigation_html);

            ?>	

            </header>
            
            <main>
            
            <?php

            // loads the main holder whole or split
            $this->load->view('layouts/main_' . $main_type . '.php');

            ?>
            
            </main>
            
            <footer>
            
            <?php

            // loads the footer
            $this->load->view('layouts/footer.php', $buttons_html);

            ?>
            
            </footer>
            
        </div>
        
    </body>
    
</html>