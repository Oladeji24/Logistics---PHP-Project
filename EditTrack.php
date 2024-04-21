<?php
$host = "localhost";
$dbname = "queenpac_Track";
$username = "queenpac_queenpac";
$password = "queenpac_queenpac$";

$connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetching all tracking numbers for the dropdown
$stmt = $connection->prepare("SELECT tracking_number FROM PackageTracker");
$stmt->execute();
$tracking_numbers = $stmt->fetchAll(PDO::FETCH_COLUMN);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tracking_number'])) {
    $tracking_number_selected = $_POST['tracking_number'];

    $stmt = $connection->prepare("SELECT * FROM PackageTracker WHERE tracking_number = ?");
    $stmt->execute([$tracking_number_selected]);

    $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Implement the logic to update the package details in the database
    $stmt = $connection->prepare("
        UPDATE PackageTracker SET
            tracking_number = :tracking_number,
            recipient_name = :recipient_name,
            recipient_address = :recipient_address,
            sender_name = :sender_name,
            sender_phone = :sender_phone,
            sender_address = :sender_address,
            ship_date = :ship_date,
            estimated_delivery_date = :estimated_delivery_date,
            status_name = :status_name,
            status_desc = :status_desc,
            location = :location
        WHERE tracking_number = :original_tracking_number
    ");

    $stmt->execute([
        ':tracking_number' => $_POST['tracking_number'],
        ':recipient_name' => $_POST['recipient_name'],
        ':recipient_address' => $_POST['recipient_address'],
        ':sender_name' => $_POST['sender_name'],
        ':sender_phone' => $_POST['sender_phone'],
        ':sender_address' => $_POST['sender_address'],
        ':ship_date' => $_POST['ship_date'],
        ':estimated_delivery_date' => $_POST['estimated_delivery_date'],
        ':status_name' => $_POST['status_name'],
        ':status_desc' => $_POST['status_desc'],
        ':location' => $_POST['location'],
        ':original_tracking_number' => $_POST['original_tracking_number']
    ]);
}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>QUEENPACKMOVER - Track and Trace  </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Logistics="keywords">
    <meta content="Logistics" name="description">

    <!-- Favicon -->
    <link href="img/truck-icon.png" rel="icon">  <!-- Assuming your truck icon is named "truck-icon.png" -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+1 (530) 203-0910</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>info@fasterPackMover.com</small>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-lg-5">
        <a href="index.php" class="navbar-brand ml-lg-3 d-flex align-items-center">
            <div>
                <h1 class="m-0 display-5 text-uppercase text-primary"><i class="fa fa-truck mr-2"></i>Faster</h1>
                <span style="font-size: 16px; display: block; text-align: center; letter-spacing: 0.5px; text-transform: uppercase; font-weight: bold; margin-top: -10px;">PackMover</span>
            </div>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
            <div class="navbar-nav m-auto py-0">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="service.html" class="nav-item nav-link">Service</a>
                <a href="Track.php" class="nav-item nav-link active">Track and Trace</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->
<!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">Track and Trace</h1>
            <div class="d-inline-flex align-items-center text-white">
                 <p class="m-0"><a class="text-white" href="index.php">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Track</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <div class="container mt-5">
    <!-- Dropdown for selecting tracking number -->
    <form action="EditTrack.php" method="post" class="mb-4">
        <div class="form-group">
            <label for="tracking_number">Select a Tracking Number:</label>
            <select name="tracking_number" class="form-control" onchange="this.form.submit()">
                <option value="">--Select--</option>
                <?php
                foreach ($tracking_numbers as $number) {
                    echo "<option value='$number'>$number</option>";
                }
                ?>
            </select>
        </div>
    </form>

    <?php if (isset($record) && $record): ?>
    <!-- Form for editing package details -->
    <form action="EditTrack.php" method="post">

        <div class="form-group">
            <label for="tracking_number">Tracking Number:</label>
            <input type="text" class="form-control" name="tracking_number" value="<?= $record['tracking_number'] ?>">
        </div>

        <div class="form-group">
            <label for="recipient_name">Recipient Name:</label>
            <input type="text" class="form-control" name="recipient_name" value="<?= $record['recipient_name'] ?>">
        </div>

        <div class="form-group">
            <label for="recipient_address">Recipient Address:</label>
            <textarea class="form-control" name="recipient_address"><?= $record['recipient_address'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="sender_name">Sender Name:</label>
            <input type="text" class="form-control" name="sender_name" value="<?= $record['sender_name'] ?>">
        </div>

        <div class="form-group">
            <label for="sender_phone">Sender Phone:</label>
            <input type="tel" class="form-control" name="sender_phone" value="<?= $record['sender_phone'] ?>">
        </div>

        <div class="form-group">
            <label for="sender_address">Sender Address:</label>
            <textarea class="form-control" name="sender_address"><?= $record['sender_address'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="ship_date">Ship Date:</label>
            <input type="date" class="form-control" name="ship_date" value="<?= $record['ship_date'] ?>">
        </div>

        <div class="form-group">
            <label for="estimated_delivery_date">Estimated Delivery Date:</label>
            <input type="date" class="form-control" name="estimated_delivery_date" value="<?= $record['estimated_delivery_date'] ?>">
        </div>
                ...

        <div class="form-group">
            <label for="status_name">Status:</label>
            <select class="form-control" name="status_name">
                <option value="In-Transit" <?= ($record['status_name'] == 'In-Transit') ? 'selected' : '' ?>>In-Transit</option>
                <option value="Awaiting Pickup" <?= ($record['status_name'] == 'Awaiting Pickup') ? 'selected' : '' ?>>Awaiting Pickup</option>
                <option value="Delivered" <?= ($record['status_name'] == 'Delivered') ? 'selected' : '' ?>>Delivered</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status_desc">Status Description:</label>
            <textarea class="form-control" name="status_desc"><?= $record['status_desc'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" name="location" value="<?= $record['location'] ?>">
        </div>

        <!-- This hidden input will hold the original tracking number in case it's changed -->
        <input type="hidden" name="original_tracking_number" value="<?= $record['tracking_number'] ?>">

        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="update" value="Update Package">
        </div>

    </form>
    <?php endif; ?>
</div>

<!-- Include Bootstrap and jQuery scripts here -->
<script src="https://code.jquery.com/jquery-3.5.2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">Testimonial</h6>
                <h1 class="mb-4">Our Clients Say</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-1.jpg" style="width: 60px; height: 60px;" alt="">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Client Name</h6>
                            <small>- Profession</small>
                        </div>
                    </div>
                    <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr clita lorem. Dolor ipsum sanct clita</p>
                </div>
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-2.jpg" style="width: 60px; height: 60px;" alt="">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Client Name</h6>
                            <small>- Profession</small>
                        </div>
                    </div>
                    <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr clita lorem. Dolor ipsum sanct clita</p>
                </div>
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-3.jpg" style="width: 60px; height: 60px;" alt="">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Client Name</h6>
                            <small>- Profession</small>
                        </div>
                    </div>
                    <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr clita lorem. Dolor ipsum sanct clita</p>
                </div>
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-4.jpg" style="width: 60px; height: 60px;" alt="">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Client Name</h6>
                            <small>- Profession</small>
                        </div>
                    </div>
                    <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr clita lorem. Dolor ipsum sanct clita</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-6 col-md-6">
                <h3 class="text-primary mb-4">Contact Us</h3>
                <p><i class="fa fa-map-marker-alt mr-2"></i>No 221 Fajuyi street, Ipaja, LA 93311 NIGERIA</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+1 (530) 203-0910</p>
                <p><i class="fa fa-envelope mr-2"></i>info@filler.com</p>
    
                <h4 class="text-primary mb-3 mt-4">Follow Us</h4>
                <div>
                    <a class="btn btn-outline-light btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
    
            <div class="col-lg-6 col-md-6">
                <h3 class="text-primary mb-4">Stay Updated</h3>
                <p>Join our newsletter and get the latest news and offers.</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Enter Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left">
                <p class="m-0 text-white">&copy; 2023 FILLER. All Rights Reserved.</p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Privacy Policy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Terms of Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>