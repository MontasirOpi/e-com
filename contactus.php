<?php
session_start();
include("includes/db.php");
include("functions/functions.php");

// Handle form submission
if(isset($_POST['submit'])){
    $senderName = $_POST['name'];
    $senderEmail = $_POST['email'];
    $senderSubject = $_POST['subject'];
    $senderMessage = $_POST['message'];

    $receiverEmail = "rakeshalakh@gmail.com";
    $headers = "From: $senderEmail";

    // Send email to site owner
    mail($receiverEmail, $senderSubject, $senderMessage, $headers);

    // Send confirmation email to sender
    $email = $_POST['email'];
    $subject = "Welcome to our website";
    $msg = "I shall get you soon, thanks for sending email";
    $from = "rakeshalakh@gmail.com";
    mail($email, $subject, $msg, "From: $from");

    $successMessage = "Your mail has been sent.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganpati Cosmetics</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- owl carousel css file cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">
    <style>
        /* Additional styles for the Google Translate widget */
        #google_translate_element {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000; /* Ensure it stays on top of other elements */
        }
    </style>

    <!-- Google Translate script -->
    <script type="text/javascript">
      // Initialize Google Translate Element
      function googleTranslateElementInit() {
        new google.translate.TranslateElement(
          {
            pageLanguage: "en", // Original language of your page
            includedLanguages: "en,bn", // Languages to include: English and Bangla
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE, // Layout style
          },
          "google_translate_element"
        );
      }
    </script>
<!-- Load Google Translate Script -->
<script
      type="text/javascript"
      src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"
    ></script>
</head>
<body>

<!-- header section starts  -->

<header>
    <div class="header-1">
        <a href="index.php" class="logo">
            <img src="website/all/logo5.svg" alt="Logo image" class="hidden-xs">
        </a>
        <div class="col-md-6 offer">
            <a href="#" class="btn btn-sucess btn-sm">
                <?php
                if (!isset($_SESSION['customer_email'])){
                    echo "Welcome Guest";
                } else {
                    echo "Welcome: " . $_SESSION['customer_email'];
                }
                ?>
            </a>
            <a id="pr" href="#"> Shopping Cart Total Price: INR <?php totalPrice(); ?>, Total Items <?php item(); ?></a>
        </div>
    </div>

    <div class="header-2">
        <nav class="navbar">
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="trimer.php">SHOP</a></li>
                <li><a class="active" href="contactus.php">CONTACT</a></li>
                <div class="col-md-6">
                    <ul class="menu">
                        <li>
                            <div class="collapse clearfix" id="search">
                                <form class="navbar-form" method="get" action="result.php">
                                    <div class="input-group">
                                        <input type="text" name="user_query" placeholder="search" class="form-control" required="">
                                        <button type="submit" value="search" name="search" class="btn btn-primary">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li>
                            <a href="cart.php">
                                <i class="fa fa-shopping-cart"></i>
                                <span><?php item(); ?> items in cart</span>
                            </a>
                        </li>
                        <li>
                            <?php
                            if (!isset($_SESSION['customer_email'])){
                                echo "<a href='checkout.php'>My Account</a>";
                            } else {
                                echo "<a href='customer/my_account.php?my_order'>My Account</a>";
                            }
                            ?>
                        </li>
                        <li><a href="cart.php"><i class="fa fa-shopping-cart"></i>Goto Cart</a></li>
                        <li>
                            <?php
                            if (!isset($_SESSION['customer_email'])){
                                echo "<a href='checkout.php'>Login</a>";
                            } else {
                                echo "<a href='logout.php'>Logout</a>";
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </ul>
        </nav>
    </div>
</header>

<!-- header section End  -->

<section class="content" id="content">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><span>Contact Us</span></li>
            </ul>
        </div>
    </div>
</section>

<div class="c-9">
    <div class="rx">
        <div class="box-header">
            <center>
                <h2>Contact Us</h2>
                <p>If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.</p>
            </center>
        </div>
        <div>
            <?php if (isset($successMessage)) { echo "<h2 align='center'>$successMessage</h2>"; } ?>
            <form action="contactus.php" method="post">
                <div class="roup">
                    <label>Name</label>
                    <input type="text" name="name" required="" class="form-control">
                </div>
                <div class="roup">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required="">
                </div>
                <div class="roup">
                    <label>Subject</label>
                    <input type="text" name="subject" class="form-control" required="">
                </div>
                <div class="roup">
                    <label>Message</label>
                    <textarea class="form-control" name="message"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fa fa-user-md"></i> Send message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- footer section starts -->
<?php include("includes/footer.php"); ?>
<!-- footer section ends -->

<div id="google_translate_element"></div>

</body>
</html>
