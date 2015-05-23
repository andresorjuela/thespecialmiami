

<!DOCTYPE html><html lang='en'>

<html>
    
    <head>
        
    <!-- load head -->
    <?php

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
            
            
            </main>
            
            <footer>
            
            <?php
            // loads the footer
            $this->load->view('layouts/footer.php');

            ?>
            
            </footer>
            
        </div>
        
    </body>
    
</html>