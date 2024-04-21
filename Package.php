<?php
$host = "localhost";
$dbname = "queenpac_Track";
$username = "queenpac_queenpac";
$password = "queenpac_queenpac$";

$connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Handling form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tracking_number = $_POST['tracking_number'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_address = $_POST['recipient_address'];
    $sender_name = $_POST['sender_name'];
    $sender_phone = $_POST['sender_phone'];
    $sender_address = $_POST['sender_address'];
    $ship_date = $_POST['ship_date'];
    $estimated_delivery_date = $_POST['estimated_delivery_date'];
    $status_name = $_POST['status_name'];
    $status_desc = $_POST['status_desc'];
    $location = $_POST['location'];

    $query = "INSERT INTO PackageTracker (tracking_number, recipient_name, recipient_address, sender_name, sender_phone, sender_address, ship_date, estimated_delivery_date, status_name, status_desc, location)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $connection->prepare($query);
    $stmt->execute([$tracking_number, $recipient_name, $recipient_address, $sender_name, $sender_phone, $sender_address, $ship_date, $estimated_delivery_date, $status_name, $status_desc, $location]);

    if ($stmt->rowCount() > 0) {
        echo "Package Created Successfully!";
    } else {
        echo "There was an error submitting the data.";
        // Logging the error for admin review, but not displaying to the user
        error_log(print_r($stmt->errorInfo(), true));
    }
}

// Query to get all records from the table
$query = "SELECT * FROM PackageTracker";
$stmt = $connection->prepare($query);
$stmt->execute();

// Fetch all records
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>QUEENPACKMOVER - Contact  </title>
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
                    <small><i class="fa fa-envelope mr-2"></i>
					info@queenpackmover.com</small>
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
                <h1 class="m-0 display-5 text-uppercase text-primary"><i class="fa fa-truck mr-2"></i>
				QUEEN</h1>
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
                <a href="service.html" class="nav-item nav-link ">Service</a>
                <a href="Track.php" class="nav-item nav-link">Track and Trace</a>
                <a href="contact.php" class="nav-item nav-link active">Contact</a>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">Package Form</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="index.php">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Create Package</p>
            </div>
        </div>
    </div>
    <!-- Header End -->
         <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12"> <!-- Adjusted for better fit -->
            <h2 class="text-center mb-4">All Records</h2>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Package ID</th>
                        <th>Tracking Number</th>
                        <th>Recipient Name</th>
                        <th>Recipient Address</th>
                        <th>Sender Name</th>
                        <th>Sender Phone</th>
                        <th>Sender Address</th>
                        <th>Ship Date</th>
                        <th>Estimated Delivery Date</th>
                        <th>Status Name</th>
                        <th>Status Description</th>
                        <th>Location</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
    <?php foreach ($records as $record): ?>
        <tr>
            <td><?php echo htmlspecialchars($record['package_id']); ?></td>
            <td><?php echo htmlspecialchars($record['tracking_number']); ?></td>
            <td><?php echo htmlspecialchars($record['recipient_name']); ?></td>
            <td><?php echo htmlspecialchars($record['recipient_address']); ?></td>
            <td><?php echo htmlspecialchars($record['sender_name']); ?></td>
            <td><?php echo htmlspecialchars($record['sender_phone']); ?></td>
            <td><?php echo htmlspecialchars($record['sender_address']); ?></td>
            <td><?php echo htmlspecialchars($record['ship_date']); ?></td>
            <td><?php echo htmlspecialchars($record['estimated_delivery_date']); ?></td>
            <td><?php echo htmlspecialchars($record['status_name']); ?></td>
            <td><?php echo htmlspecialchars($record['status_desc']); ?></td>
            <td><?php echo htmlspecialchars($record['location']); ?></td> <!-- Corrected this line -->
            <td><?php echo htmlspecialchars($record['timestamp']); ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
            </table>
        </div>
    </div>
</div>

    <!-- Footer Start -->
<div class="container-fluid bg-dark text-white mt-5 py-5 px-sm-3 px-md-5">
    <div class="row pt-5">
        <div class="col-lg-6 col-md-6">
            <h3 class="text-primary mb-4">Contact Us</h3>
            <p><i class="fa fa-map-marker-alt mr-2"></i>No 221 Fajuyi street, Ipaja, LA 93311 NIGERIA</p>
            <p><i class="fa fa-phone-alt mr-2"></i>+234 (802) 284-31302</p>
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