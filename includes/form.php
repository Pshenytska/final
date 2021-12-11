<?php
session_start();
include('config.php');
include('includes/hearder.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = 'You must login first!';
    header('Location:login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('Location:login.php');
}

include('includes/header.php');

if (isset($_SESSION['success'])) : ?>
    <div class="success">
        <h3>
            <?php echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </h3>
    </div>
<?php endif;

if (isset($_SESSION['username'])) : ?>
    <div class="welcome-logout">
        <h3>Hello
            <?php echo $_SESSION['username']; ?>
        </h3>
        <p><i class="fas fa-door-open"></i><a href="index.php?logout='1' ">Log Out</a></p>
    </div>

    <?php

    $first_name = '';
    $last_name = '';
    $budget = '';
    $email = '';
    $city = '';
    $type = '';
    $comments = '';
    $agreement = '';
    $phone = '';

    $first_name_Err = '';
    $last_name_Err = '';
    $budget_Err = '';
    $email_Err = '';
    $city_Err = '';
    $type_Err = '';
    $comments_Err = '';
    $agreement_Err = '';
    $phone_Err = '';



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['first_name'])) {
            $first_name_Err = 'Please fill out your First Name';
        } else {
            $first_name = $_POST['first_name'];
        }
        if (empty($_POST['last_name'])) {
            $last_name_Err = 'Please fill out your Last Name';
        } else {
            $last_name = $_POST['last_name'];
        }
        if (empty($_POST['budget'])) {
            $budget_Err = 'Please fill out your budget amount';
        } else {
            $budget = $_POST['budget'];
        }
        if (empty($_POST['email'])) {
            $email_Err = 'Please fill out your email box';
        } else {
            $email = $_POST['email'];
        }
        if (empty($_POST['city'])) {
            $city_Err = 'Please indicate what city you want to a property at';
        } else {
            $city = $_POST['city'];
        }
        if ($_POST['type'] == NULL) {
            $type_Err = 'Please select your financing type';
        } else {
            $type = $_POST['type'];
        }

        if (empty($_POST['comments'])) {
            $comments_Err = 'Please share your comments with us!';
        } else {
            $comments = $_POST['comments'];
        }
        if (empty($_POST['agreement'])) {
            $agreement_Err = 'Sorry, but you must check our agreement!';
        } else {
            $agreement = $_POST['agreement'];
        }

        if (empty($_POST['phone'])) {  // if empty, type in your number
            $phone_Err = 'Your phone number please!';
        } elseif (array_key_exists('phone', $_POST)) {
            if (!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $_POST['phone'])) { // if you are not typing the requested format of xxx-xxx-xxxx, display Invalid format
                $phone_Err = 'Invalid format!';
            } else {
                $phone = $_POST['phone'];
            }
        }

        function travel_city()
        {
            $my_return = '';
            if (!empty($_POST['city'])) {
                $my_return = implode(',', $_POST['city']);
            }
            return $my_return;
        } //closes fuction

        if (isset(
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['email'],
            $_POST['budget'],
            $_POST['city'],
            $_POST['type'],
            $_POST['comments'],
            $_POST['phone']


        )) {

            $to = 'vpshenytska@gmail.com';
            $subject = 'Test Email, ' . date('m/d/y');
            $body = '
The first name is: ' . $first_name . ' ' . PHP_EOL . '
The last name is: ' . $last_name . ' ' . PHP_EOL . '
Budget: ' . $budget . ' ' . PHP_EOL . '
Email: ' . $email . ' ' . PHP_EOL . '
Phone: ' . $phone . ' ' . PHP_EOL . '
Type: ' . $type . ' ' . PHP_EOL . '
Comments: ' . $comments . ' ' . PHP_EOL . '
';

            $headers = array(
                'From' => 'vpshenytska@gmail.com',
                'Reply' => '' . $email . ''


            );

            mail($to, $subject, $body, $headers);
            header('Location:response.php');
        }
    }

    ?>
    <?php echo $headline; ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <fieldset>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" value="<?php if (isset($_POST['first_name'])) echo htmlspecialchars($_POST['first_name']); ?>">
            <span class="error"><?php echo $first_name_Err; ?></span>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" value="<?php if (isset($_POST['last_name'])) echo htmlspecialchars($_POST['last_name']); ?>">
            <span class="error"><?php echo $last_name_Err; ?></span>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>">
            <span class="error"><?php echo $email_Err; ?></span>

            <label for="phone">Phone Number</label>
            <input type="text" name="phone" placeholder="xxx-xxx-xxxx" value="<?php if (isset($_POST['phone'])) echo htmlspecialchars($_POST['phone']); ?>">
            <span class="error"><?php echo $phone_Err; ?></span>

            <label for="budget">Your Downpayment</label>
            <ul>
                <li>
                    <input type="radio" name="budget" value="$1000 - $5000" <?php if (isset($_POST['budget']) && $_POST['budget'] == '$1000 - $5000') echo 'checked="checked"'; ?>>$1000 - $5000
                </li>
                <li>
                    <input type="radio" name="budget" value="$5000 - $15000" <?php if (isset($_POST['budget']) && $_POST['budget'] == '$5000 - $15000') echo 'checked="checked"'; ?>>$5000 - $15000
                </li>
                <li>
                    <input type="radio" name="budget" value="$15000 - $25000" <?php if (isset($_POST['budget']) && $_POST['budget'] == '$15000 - $25000') echo 'checked="checked"'; ?>>$15000 - $25000
                </li>
            </ul>
            <span class="error"><?php echo $budget_Err; ?></span>

            <label for="city">The city you want to buy a property at</label>
            <ul>
                <li>
                    <input type="checkbox" name="city[]" value="Seattle" <?php if (isset($_POST['city']) && in_array('Seattle', $city)) echo 'checked="checked"'; ?>>Seattle
                </li>
                <li>
                    <input type="checkbox" name="city[]" value="Los Angeles" <?php if (isset($_POST['city']) && in_array('Los Angeles', $city)) echo 'checked="checked"'; ?>>Los Angeles
                </li>
                <li>
                    <input type="checkbox" name="city[]" value="Portland" <?php if (isset($_POST['city']) && in_array('Portland', $city)) echo 'checked="checked"'; ?>>Portland
                </li>
                <li>
                    <input type="checkbox" name="city[]" value="Santa Barbara" <?php if (isset($_POST['city']) && in_array('Santa Barbara', $city)) echo 'checked="checked"'; ?>>Santa Barbara
                </li>
                <li>
                    <input type="checkbox" name="city[]" value="San Diego" <?php if (isset($_POST['city']) && in_array('San Diego', $city)) echo 'checked="checked"'; ?>>San Diego
                </li>
            </ul>
            <span class="error"><?php echo $city_Err; ?></span>
            <label for="type">Type of your Financing Institution</label>
            <select name="type">
                <option value="" NULL <?php if (isset($_POST['type']) && $_POST['type'] == NULL) echo 'selected = "unselected"'; ?>>Select One</option>

                <option value="ft" <?php if (isset($_POST['type']) && $_POST['type'] == 'ft') echo 'selected = "unselected"'; ?>>Bank of America</option>

                <option value="fh" <?php if (isset($_POST['type']) && $_POST['type'] == 'fh') echo 'selected = "unselected"'; ?>>Chase</option>

                <option value="fg" <?php if (isset($_POST['type']) && $_POST['type'] == 'fg') echo 'selected = "unselected"'; ?>>Navy Federal</option>

                <option value="sga" <?php if (isset($_POST['type']) && $_POST['type'] == 'sga') echo 'selected = "unselected"'; ?>>Quicken Loans</option>

                <option value="nw" <?php if (isset($_POST['type']) && $_POST['type'] == 'nw') echo 'selected = "unselected"'; ?>>Caliber</option>

                <option value="rt" <?php if (isset($_POST['type']) && $_POST['type'] == 'rt') echo 'selected = "unselected"'; ?>>Fairway</option>

            </select>


            <span class="error"><?php echo $type_Err; ?></span>
            <label for="comments">Comments
                <textarea name="comments"><?php if (isset($_POST['comments'])) echo htmlspecialchars($_POST['comments']); ?></textarea>
            </label>
            <span class="error"><?php echo $comments_Err; ?></span>



            <label for="agreement">Privacy</label>
            <ul>
                <li>
                    <input type="radio" name="agreement" value="agree" <?php if (isset($_POST['agreement']) && $_POST['agreement'] == 'agree') echo 'checked="checked"'; ?>>I agree to the terms and conditions.
                </li>
            </ul>
            <span class="error"><?php echo $agreement_Err; ?>
            </span>
            <input type="submit" value="Send it">
            <a class="btn-2" href=" ">Reset</a>
        </fieldset>
    </form>
<?php endif; ?>