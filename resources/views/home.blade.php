<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tun Rice Milling</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        :root {
            --primary-green: rgb(1, 84, 95);
            --hover-green: rgb(0, 63, 71);
            --light-green: rgb(226, 242, 244);
        }

        .navbar-brand {
            font-weight: bold;
            color: var(--light-green) !important;
        }

        .navbar {
            background-color: var(--primary-green) !important;
        }

        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: var(--light-green) !important;
        }

        .footer {
            background-color: var(--primary-green);
            color: white;
            padding: 2rem 0;
            bottom: 0;
            width: 100%;
        }

        .footer a {
            color: var(--light-green) !important;
            text-decoration: none;
        }

        .footer a:hover {
            color: white !important;
            text-decoration: underline;
        }

        .main-content {
            margin-bottom: 0;
        }

        h1, h2, h5 {
            color: var(--primary-green);
        }

        .section-padding {
            height: 100vh;
            padding: 80px 0;
            display: flex;
            align-items: center;
        }

        .section-content {
            width: 100%;
        }

        #home {
            background-image: url('/images/home-section.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            color: var(--primary-green) important;
        }

        #home::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.60);
            z-index: 1;
        }

        #home .section-content {
            position: relative;
            z-index: 2;
        }

        #home h1 {
            color: var(--primary-green) important;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        #home .lead {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary-green) important;
            font-weight: bold;
        }

        #about {
            background-color: var(--light-green);
            color: var(--primary-green);
        }

        #about h2, #about h3 {
            color: var(--primary-green);
        }

        #contact {
            background-color: white;
        }

        .contact-info i {
            color: var(--primary-green);
            margin-right: 10px;
        }

        .contact-form .form-control {
            border-color: var(--primary-green);
            border-radius: 0;
        }

        .contact-form .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(1, 84, 95, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
        }

        .btn-primary:hover {
            background-color: var(--hover-green);
            border-color: var(--hover-green);
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Tun Rice Milling</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Home Section -->
        <section id="home" class="section-padding">
            <div class="container section-content">
                <h1>Welcome to Tun Rice Milling</h1>
                <p class="lead">Your trusted partner in quality rice milling services.</p>
                <p>We combine traditional expertise with modern technology to deliver the best rice milling solutions for our customers.</p>
            </div>
        </section>

        <!-- About Us Section -->
        <section id="about" class="section-padding">
            <div class="container section-content">
                <h2 class="text-center mb-5">About Us</h2>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h3>Our Story</h3>
                        <p>Established in 2020, Tun Rice Milling has been at the forefront of the rice milling industry, providing top-quality services to farmers and businesses alike.</p>
                        <p>Our state-of-the-art facility combines traditional expertise with modern technology to ensure the highest quality results for our clients.</p>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h3>Our Mission</h3>
                        <p>We strive to provide the most efficient and high-quality rice milling services while maintaining sustainable practices and supporting local farmers.</p>
                        <ul class="list-unstyled">
                            <li>✓ Quality Assurance</li>
                            <li>✓ Modern Technology</li>
                            <li>✓ Expert Team</li>
                            <li>✓ Customer Satisfaction</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Us Section -->
        <section id="contact" class="section-padding">
            <div class="container section-content">
                <h2 class="text-center mb-5">Contact Us</h2>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="contact-info">
                            <h3>Get in Touch</h3>
                            <p><i class="bi bi-geo-alt-fill"></i> 123 Rice Mill Road, Yangon, Myanmar</p>
                            <p><i class="bi bi-telephone-fill"></i> (95) 123-456-789</p>
                            <p><i class="bi bi-envelope-fill"></i> info@tunricemilling.com</p>
                            <p><i class="bi bi-clock-fill"></i> Monday - Saturday: 8:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <form class="contact-form">
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>Tun Rice Milling provides quality rice milling services with modern technology and excellent customer service.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#" class="text-white">About Us</a></li>
                        <li><a href="#" class="text-white">Contact Us</a></li>
                        <li><a href="#" class="text-white">Login</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled">
                        <li>Address: Your Address Here</li>
                        <li>Phone: (123) 456-7890</li>
                        <li>Email: info@tunricemilling.com</li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4">
            <div class="text-center">
                <p>&copy; 2025 Tun Rice Milling. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>