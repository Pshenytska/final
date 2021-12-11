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


    //if isset $_GET['today']

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: houses.php');
    }

    $sql = 'SELECT * FROM estate WHERE house_id = ' . $id . ' ';
    //now we are connecting to the database
    $iConn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(myError(__FILE__, __LINE__, mysqli_connect_error()));

    //create a variable $result

    $result = mysqli_query($iConn, $sql) or die(myError(__FILE__, __LINE__, mysqli_error($iConn)));

    if (mysqli_num_rows($result) > 0) {
        //now time for the while loop - and thr while loop will return the array
        while ($row = mysqli_fetch_assoc($result)) {
            $house_address = stripslashes($row['house_address']);
            $house_description = stripslashes($row['house_description']);
            $house_age = stripslashes($row['house_age']);
            $house_agent = stripslashes($row['house_agent']);
            $house_agency = stripslashes($row['house_agency']);
            $house_website = stripslashes($row['house_website']);
            $blurb = stripslashes($row['blurb']);
            $feedback = '';
        } //end of the while statement
    } else {
        $feedback = 'Something is not working!';
    }

    ?>
    <main>
        <h1>Welcome to <?php echo $house_agent; ?>'s listing page!</h1>
        <?php
        if ($feedback == '') {
            echo '<ul>';
            echo '<li><b>Listing agent:</b> ' . $house_agent . '</li><br>';
            echo '<li><b>Broker Agency:</b> ' . $house_agency . '</li><br>';
            echo '<li><b>House Description:</b> ' . $house_description . '</li><br>';
            echo '<li><b>House Age:</b> ' . $house_age . '</li><br>';
            echo '<li><b>House Address:</b> ' . $house_address . '</li><br>';
            echo '</ul>';
            echo '<p class="description">' . $description . '</p>';
            echo '<p>Return back to the previous page <a class="btn" href="houses.php">HERE</a></p>';
        }

        ?>
    </main>

    <aside>
        <?php
        if ($feedback == '') {
            echo '<img class="center" src="image/house' . $id . '.jpg" alt="' . $house_address . '">';
            echo '<p class="blurb">' . $blurb . '</p>';
        }

        ?>

    </aside>

    <!--ending wrapper-->
<?php
    mysqli_free_result($result);
    mysqli_close($iConn);

    include('includes/footer.php');
endif; ?>