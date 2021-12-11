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
<?php
echo '<br>';
if (isset($_GET['today'])) {
    $today = $_GET['today'];
} else {
    $today = date('l');
}
echo $headline;
//switch

switch ($today) {
    case 'Wednesday':
        $coffee = '<h2>Wednesday\'s deal - Quicken Loans</h2>';
        $pic = 'lender1.jpg';
        $alt = 'Quicken Loans';
        $content = 'If you’re purchasing a home, refinancing the one you have or want to learn more about how mortgages work, we want to make sure you have all the tools you need. That’s why we provide technology, education and customer service to help you with the mortgage process – from applying, to getting approved, to managing your loan.';
        break;

    case 'Thursday':
        $coffee = '<h2>Thursday\'s deal is - Bank of America</h2>';
        $pic = 'lender2.jpg';
        $alt = 'Bank of America';
        $content = 'Here\'s what you\'ll get when you work with us:
Low, competitive mortgage rates
Get preapprovedFootnote 1 to lock in a low rate.
We provide a broad range of loan options to fit your personal needs, from mortgages with low down payments to mortgages for higher-value homes, to meet each borrower\'s unique situation.
Our experienced lending specialists can provide guidance from application to closing.';

        break;

    case 'Friday':
        $coffee = '<h2>Friday\'s deal is - CHASE</h2>';
        $pic = 'lender3.jpg';
        $alt = 'Drip Coffee';
        $content = '<b>The pour-over or drip coffee</b> brewing method is one of the fastest and most efficient methods of brewing coffee, producing a cup somewhere between cafeteria and auto-drip.';

        break;

    case 'Saturday':
        $coffee = '<h2>Saturday\'s is - Fairway </h2>';
        $pic = 'lender4.jpg';
        $alt = 'Fairway';
        $content = 'Since opening our doors in 1996, we have not only been dedicated to providing unparalleled customer service, but also to growing continuously. Fairway now employs more than 10,000 team members, including over 2,800 producers and over 700 branch and satellite locations nationwide. Over the years, our team has helped thousands of Americans achieve their dream of homeownership. With a strong focus on purchase business, we continue to grow each year, funding more than $65.8 billion in 2020.';

        break;

    case 'Sunday':
        $coffee = '<h2>Sunday\'s deal - loanDepot </h2>';
        $pic = 'lender5.jpg';
        $alt = 'Loan Depot';
        $content = 'LoanDepot, sometimes stylized as loanDepot, is a Lake Forest, California-based holding company which sells mortgage and non-mortgage lending products.In 2015, the company claimed to be the second largest non-bank provider of direct-to-consumer loans in the United States';

        break;

    case 'Monday':
        $coffee = '<h2>Monday\'s deal is - CALIBER </h2>';
        $pic = 'lender6.jpg';
        $alt = 'Caliber';
        $content = 'Caliber Home Loans is a private lender that operates and originates mortgage loans in all 50 states. Customers have the option to choose from a variety of loans such as new construction, USDA, VA, FHA, jumbo, and conventional loans. Caliber also has dedicated specialists who go through an in-house VA training program to better assist the military lending community.';

        break;

    case 'Tuesday':
        $coffee = '<h2>Tuesday\'s deal is - NAVI FEDERAL</h2>';
        $pic = 'lender7.jpg';
        $alt = 'Navy Federal';
        $content = 'Navy Federal Credit Union (or Navy Federal) is a global credit union headquartered in Vienna, Virginia, chartered and regulated under the authority of the National Credit Union Administration (NCUA). Navy Federal is the largest natural member (or retail) credit union in the United States, both in asset size and in membership. As of September 2021, Navy Federal has $149.6 billion USD in assets, and has 10.8 million members.';
        break;
}
?>


<div id="wrapper">
    <h2>Check out our Loan Carousel Week</h2>
    <?php echo $coffee; ?><img src="image/<?php echo $pic; ?>" alt="<?php echo $alt; ?>">
    <p><?php echo $content; ?></p>

    <aside class="loans">
        <ul>
            <li><a href="loans.php?today=Wednesday" style="color:black;">Wednesday</a></li>
            <li><a href="loans.php?today=Thursday" style="color:black;">Thursday</a></li>
            <li><a href="loans.php?today=Friday" style="color:black;">Friday</a></li>
            <li><a href="loans.php?today=Saturday" style="color:black;">Saturday</a></li>
            <li><a href="loans.php?today=Sunday" style="color:black;">Sunday</a></li>
            <li><a href="loans.php?today=Monday" style="color:black;">Monday</a></li>
            <li><a href="loans.php?today=Tuesday" style="color:black;">Tuesday</a></li>
        </ul>
    </aside>
</div>

<?php include('includes/footer.php'); ?>