<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/standard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e32eed67c4.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="header-inner"><a href="index.php">
            <img id="logo" src="image/logo.jpg" alt="logo"></a> </div>
    <header>
        <nav>
            <ul class="navigation">
                <?php
                echo my_nav($nav);
                ?>
            </ul>
        </nav>
    </header>