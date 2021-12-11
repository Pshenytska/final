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
<?php endif; ?>
<div class="second-wrapper">
    <img class="real-estate" src="image/photo3.jpg">
</div>
<h1><?php echo $headline; ?></h1>
<main style="width:50%;">

    <?php
    $sql = 'SELECT * FROM estate';

    //now we are connecting to the database
    $iConn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(myError(__FILE__, __LINE__, mysqli_connect_error()));
    //create a variable $result

    $result = mysqli_query($iConn, $sql) or die(myError(__FILE__, __LINE__, mysqli_error($iConn)));

    // time for the if statement - if we have more than 0 rows

    if (mysqli_num_rows($result) > 0) {
        //now time for the while loop - and thr while loop will return the array
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<h3>For more information about the house at ' . $row['house_address'] . ', please click <a class="btn" href="houses-view.php? id=' . $row['house_id'] . ' ">here!</a></h3>';
            echo '<ul class="music">';
            echo '<li><b>Real Estate Agent:</b>' . $row['house_agent'] . '</li>';
            echo '<li><b>Broker:</b>' . $row['house_agency'] . '</li>';
            echo '<li><b>Website:</b><a href="' . $row['house_website'] . 'target="_blank"">' . $row['house_website'] . '</a></li>';
            echo '</ul>';
            echo '<hr>';
        } //closing the while statement
    } else {
        echo 'Woops, we have a problem!';
    }
    mysqli_free_result($result);
    mysqli_close($iConn);
    ?>
</main>

<!--ending wrapper-->
<?php
include('includes/footer.php');
