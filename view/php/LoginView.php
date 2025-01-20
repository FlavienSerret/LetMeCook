<?php



class LoginView {

    function display_login_form() {
        ?>
        <form method="post" action="loginController.php">
            <fieldset>
                <legend>Login</legend>
                <input type="text" placeholder="login" id="login" name="login">
                <input type="password" placeholder='password' id='pwd' name="pwd">
                <button type="submit">Submit</button>
            </fieldset>
        </form>
        <?php
    }


    function display_welcome_page() {
        ?>
        <main>
            <h3>Welcome <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] . "!!"; ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <!-- A form to logout -->
            <!-- It redirects to the form controller -->
            <!-- Note that this could have been done with a simple link and a $_GET parameter -->
            <form method="post" action="loginController.php">
                <fieldset>
                    <legend>Logout</legend>
                    <button type="submit">Logout</button>
                </fieldset>
            </form>
        </main>
        <?php
    }

}


?>