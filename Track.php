<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FILLER - Track and Trace  </title>
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
                    <small><i class="fa fa-phone-alt mr-2"></i>+234 (802) 284-31302</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>
					info@filler.com</small>
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Track your Package</div>
                <div class="card-body">
                    <form action="Track.php" method="post">
                        <div class="form-group">
                            <label for="tracking_number">Enter Tracking Number:</label>
                            <input type="text" class="form-control" id="tracking_number" name="tracking_number" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Track Package">
                    </form>
                </div>
            </div>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tracking_number'])) {
                $tracking_number = $_POST['tracking_number'];

                $host = "localhost";
                $dbname = "rrlpsyjk_faster";
                $username = "rrlpsyjk_faster";
                $password = "Theway_2500";

                try {
                    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $connection->prepare("SELECT * FROM PackageTracker WHERE tracking_number = ?");
                    $stmt->execute([$tracking_number]);

                    $record = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($record) {
                        echo "<div class='mt-5'>";
                        echo "<h3>Tracking Details:</h3>";
                        foreach ($record as $key => $value) {
                            echo "<strong>" . ucfirst($key) . ":</strong> " . htmlspecialchars($value) . "<br>";
                        }
                        echo "</div>";
                    } else {
                        echo "<div class='mt-5 alert alert-danger'>No details found for the provided Tracking ID.</div>";
                    }

                } catch (PDOException $error) {
                    echo "<div class='mt-5 alert alert-danger'>Error: " . $error->getMessage() . "</div>";
                }
            }
            ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">What Our Clients Think</h6>
                <h1 class="mb-4">Valued Feedback from Our Customers</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-1.jpg" style="width: 60px; height: 60px;" alt="Jake Thompson">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Jake Thompson</h6>
                            <small>- CEO, TechStart Inc.</small>
                        </div>
                    </div>
                    <p class="m-0">Their professionalism and dedication ensured that our packages were delivered on time. Highly recommended!</p>
                </div>
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-2.jpg" style="width: 60px; height: 60px;" alt="Maria Gonzales">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Maria Gonzales</h6>
                            <small>- Independent Artist</small>
                        </div>
                    </div>
                    <p class="m-0">Shipping my art pieces through FILLER DELIVERY gave me peace of mind. Everything arrived safely and in pristine condition.</p>
                </div>
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-3.jpg" style="width: 60px; height: 60px;" alt="Rajeev S.">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Rajeev S.</h6>
                            <small>- Restaurant Owner</small>
                        </div>
                    </div>
                    <p class="m-0">From fresh ingredients to essential equipment, they’ve never let me down. Timely and reliable service every time.</p>
                </div>
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-4.jpg" style="width: 60px; height: 60px;" alt="Linda McCartney">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Linda McCartney</h6>
                            <small>- Fashion Designer</small>
                        </div>
                    </div>
                    <p class="m-0">Their meticulous handling of cargo and prompt updates make them my top choice for international shipments.</p>
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
    <!--Add the following script at the bottom of the web page (before </body></html>)-->
<script type="text/javascript">function add_chatinline(){var hccid=10610935;var nt=document.createElement("script");nt.async=true;nt.src="https://mylivechat.com/chatinline.aspx?hccid="+hccid;var ct=document.getElementsByTagName("script")[0];ct.parentNode.insertBefore(nt,ct);}
add_chatinline();</script>
</body>
</html>