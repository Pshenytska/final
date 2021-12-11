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
<div id="wrapper">
    <?php echo $headline; ?>
</div>
<article>
    <p class="article"><span class="c-lead-in">You just have to watch</span> the quick clip at which Zillow listings flip from new to pending to see that the Seattle housing market is wild. Properties sell for six figures over asking these days, sometimes in cash.Recent homebuyers—and would-be buyers—see this manifest in bidding wars and escalating offers, and the numbers support the anecdotal tales.</p>
    <p class="article">The median sale price for a King County home was $745,000 in September 2021, according to the Northwest Multiple Listing Service. That’s up from $698,230 that same month in 2020.</p>
</article>
<aside> <?php
        $photos = array(
            'photo1',
            'photo2',
            'photo3',
            'photo4',
            'photo5'
        );

        $photos[0] = 'photo1';
        $photos[1] = 'photo2';
        $photos[2] = 'photo3';
        $photos[3] = 'photo4';
        $photos[4] = 'photo5';

        $i = rand(0, 4);
        $selected_image = '' . $photos[$i] . '.jpg';
        echo '<img class="img" src="image/' . $selected_image . '"  alt=" ' . $photos[$i] . '">'; ?></aside>
<?php include('includes/footer.php'); ?>