<?php
/**
 * Simple PHP script example to showcase hwo HTML content
 * can be re-used across multiple HTML files
 * 
 * @author: w.delamare
 * @date: Dec. 2023
 */

class GlobalView {

    


    function include_header() {
        ?>
        <header>
            <h1>The main title</h1>
            <h2>Just a sub title</h2>
        </header>
        <?php
    }


    function include_footer() {
        // This method is used to display the footer of the website
        // It is the same for all pages, so one change here will be reflected on all pages
        ?>
        <footer>
            Copyright!©️TAI <a href="mailto:">Contact</a>
        </footer>
        <?php
    }


    function include_error_message($message) {
        // This method is used to display an error message via the class defined in the CSS file
        echo "<p class='error_message'>" . $message . "</p>";
    }

}

?>