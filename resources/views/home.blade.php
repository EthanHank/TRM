<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tun Rice Milling</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        html {
            scroll-behavior: smooth;
        }
        .navbar-brand {
            font-weight: bold;
            color: white;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .nav-link {
            color: white !important;
            transition: all 0.5s ease;
            height: 100%;
            border-radius: 20px;
            margin: 0 5px;
            text-align: center;
        }

        .nav-link:hover {
            color: #667eea !important;
            background-color: white;
        }

        .footer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            bottom: 0;
            width: 100%;
        }

        .footer a {
            text-decoration: none;
        }

        .footer a:hover {
            color: white !important;
            text-decoration: underline;
        }

        .main-content {
            margin-bottom: 0;
        }

        h1, h2 {
            color: #667eea;
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
            background-image: url('/images/home-section1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        #home::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.80);
            z-index: 1;
        }

        #home .section-content {
            position: relative;
            z-index: 2;
            color:rgb(56, 81, 191);
        }

        #home h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        #home .lead {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        #about {
            background-color:rgb(241, 245, 255);
            color: #667eea;
        }

        #about h2, #about h3 {
            color: #667eea;
        }

        #merchant {
            background-color: white;
        }

        .contact-info i, .contact-info {
            color: #667eea;
            margin-right: 10px;
        }

        .contact-form .form-control {
            border-color: #667eea;
            border-radius: 0;
            color: #667eea;
        }

        .contact-form .form-control::placeholder{
            color: #667eea;
        }

        .contact-form .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(1, 84, 95, 0.25);
        }

        .btn-primary {
            background-color: #667eea;
            border-color: #667eea;
        }

        .btn-primary:hover {
            color: #667eea;
            background-color: white;
            border-color: #667eea;
            transition: all 0.5s ease;
        }
        @media (max-width: 991px) {
            .nav-link{
                margin: 5px 0;
            }
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
                        <a class="nav-link" href="#merchant">Be a Merchant</a>
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

        <!-- Be Our Merchant Section -->
        <section id="merchant" class="section-padding">
            <div class="container section-content">
                <h2 class="text-center mb-5">Be a Merchant</h2>
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
                        <li><a href="#" class="text-white">Be a Merchant</a></li>
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
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>