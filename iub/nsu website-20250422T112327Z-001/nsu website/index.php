
<?php
session_start();
include 'db.php';


if (!isset($_SESSION['user'])) {
    header("Location: student login.html");
    exit();
}


$username = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : '';
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Independent University, Bangladesh (IUB)</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Georgia', serif;
        }

        body {
            background-color: #f2f2f2;
        }

        .top-bar {
            background-color: #e7eaf6;
            color: #000;
            font-size: 13px;
            padding: 5px 20px;
            display: flex;
            justify-content: space-between;
        }

        .top-bar a {
            color: #000;
            margin: 0 10px;
            text-decoration: none;
        }

        .header {
            background-color: #fff;
            text-align: center;
            padding: 20px 10px;
            border-bottom: 1px solid #ccc;
        }

        .header img {
            height: 60px;
            vertical-align: middle;
        }

        .header h1 {
            font-size: 26px;
            display: inline-block;
            margin-left: 15px;
            vertical-align: middle;
            color: #1a1a1a;
        }

        .navbar {
            background-color: #2c2c92;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            padding: 10px 0;
            position: relative;
            z-index: 100;
        }

        .navbar > div {
            position: relative;
        }

        .navbar a {
            color: #fff;
            padding: 12px 16px;
            text-decoration: none;
            font-size: 15px;
            transition: background 0.3s;
            display: inline-block;
        }

        .navbar a:hover {
            background-color: #1a1a70;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            top: 100%;
            left: 0;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            font-size: 14px;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
            color: #2c2c92;
        }

        .navbar > div:hover .dropdown-content {
            display: block;
        }

        .dropdown-content .sub-dropdown {
            position: relative;
        }

        .dropdown-content .sub-dropdown-content {
            display: none;
            position: absolute;
            left: 100%;
            top: 0;
            background-color: #f9f9f9;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content .sub-dropdown:hover .sub-dropdown-content {
            display: block;
        }

        .dropdown-content .sub-dropdown-content a {
            padding: 12px 16px;
        }

        .css-slider {
            position: relative;
            width: 40%;
            margin: 30px auto;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .css-slider input {
            display: none;
        }

        .slides {
            display: flex;
            width: 100%;
            transition: transform 0.6s ease;
        }

        .slide {
            width: 100%;
            flex-shrink: 0;
        }

        .slide img {
            width: 100%;
            height: 320px;
            object-fit: cover;
            display: block;
            border-radius: 12px;
        }

        .navigation {
            position: absolute;
            width: 100%;
            bottom: 10px;
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .navigation label {
            cursor: pointer;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #fff;
            border: 2px solid #ccc;
            transition: background-color 0.3s;
        }

        #slide1:checked ~ .slides {
            transform: translateX(0%);
        }
        #slide2:checked ~ .slides {
            transform: translateX(-10%);
        }
        #slide3:checked ~ .slides {
            transform: translateX(-30%);
        }
        #slide4:checked ~ .slides {
            transform: translateX(-50%);
        }
        #slide5:checked ~ .slides {
            transform: translateX(-66.666%);
        }
        #slide6:checked ~ .slides {
            transform: translateX(-83.333%);
        }

        #slide1:checked ~ .navigation label:nth-child(1),
        #slide2:checked ~ .navigation label:nth-child(2),
        #slide3:checked ~ .navigation label:nth-child(3),
        #slide4:checked ~ .navigation label:nth-child(4),
        #slide5:checked ~ .navigation label:nth-child(5),
        #slide6:checked ~ .navigation label:nth-child(6) {
            background-color: #2c2c92;
        }

        .main-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 30px 10px;
        }

        .box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 300px;
            flex: 1 1 300px;
        }

        .wide-box {
            width: 620px;
        }

        .box h3 {
            margin-bottom: 10px;
            color: #2c2c92;
        }

        .box a {
            color: #2c2c92;
            text-decoration: none;
        }

        .event-list, .notice-list {
            max-height: 200px;
            overflow-y: auto;
        }

        .image-box img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .mini-slider-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .mini-slider-track {
            display: flex;
            animation: miniSlide 10s infinite alternate ease-in-out;
        }

        .mini-slide {
            min-width: 100%;
        }

        .mini-slide img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
        }

        @keyframes miniSlide {
            0% { transform: translateX(0%); }
            50% { transform: translateX(-100%); }
            100% { transform: translateX(0%); }
        }

        .main-footer {
            background-color: #222;
            color: white;
            padding: 50px 0 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer-column h3 {
            color: #e67e22;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column li {
            margin-bottom: 10px;
        }

        .footer-column a {
            color: #ccc;
            transition: color 0.3s;
        }

        .footer-column a:hover {
            color: white;
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #444;
            color: #aaa;
            font-size: 14px;
        }

        /* Academics Highlights Section */
        .academics-highlights {
            width: 100%;
            padding: 20px;
            background-color: #fff;
            margin: 20px 0;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .academics-highlights h2 {
            color: #2c2c92;
            margin-bottom: 20px;
            text-align: center;
        }

        .department-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .department-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            width: 280px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .department-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .department-card h3 {
            color: #2c2c92;
            margin-bottom: 15px;
            border-bottom: 2px solid #e7eaf6;
            padding-bottom: 10px;
        }

        .department-card p {
            margin-bottom: 15px;
            color: #555;
            font-size: 14px;
        }

        .department-card a {
            display: inline-block;
            background-color: #2c2c92;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .department-card a:hover {
            background-color: #1a1a70;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
            }
            
            .navbar > div {
                width: 100%;
            }
            
            .dropdown-content {
                position: static;
                width: 100%;
            }
            
            .dropdown-content .sub-dropdown-content {
                position: static;
                width: 100%;
                padding-left: 20px;
            }

            .css-slider {
                width: 90%;
            }

            .main-content {
                flex-direction: column;
                align-items: center;
            }

            .wide-box {
                width: 300px;
            }
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div>Email: info@iub.edu.bd</div>
        <div>Phone: +880 9612 939393</div>
    </div>

    <!-- Main Header -->
    <header class="header">
        <img src="iub logo.png" alt="IUB Logo">
        <h1>Independent University, Bangladesh</h1>
    </header>

    <!-- Navigation -->
    <nav class="navbar">
        <div>
            <a href="#">Home</a>
        </div>
        
        <div>
            <a href="academics.html">Academics</a>
            <div class="dropdown-content">
                <a href="#">Undergraduate Programs</a>
                <div class="sub-dropdown">
                    <a href="#">School of Engineering & Computer Science</a>
                    <div class="sub-dropdown-content">
                        <a href="cse.html">Computer Science & Engineering (CSE)</a>
                        <a href="eee.html">Electrical & Electronic Engineering (EEE)</a>
                        <a href="ce.html">Civil Engineering (CE)</a>
                        
                    </div>
                </div>
                <div class="sub-dropdown">
                    <a href="#">School of Business</a>
                    <div class="sub-dropdown-content">
                        <a href="bba.html">Bachelor of Business Administration (BBA)</a>
                       
                        
                        <a href="finance.html">Finance & Banking</a>
                    </div>
                </div>
                <div class="sub-dropdown">
                    <a href="#">School of Environmental Science & Management</a>
                    <div class="sub-dropdown-content">
                       
                        <a href="es.html">Environmental Management</a>
                    </div>
                </div>
                <a href="#">Graduate Programs</a>
                <div class="sub-dropdown">
                    <a href="#">Master's Programs</a>
                    <div class="sub-dropdown-content">
                        <a href="msc-cse.html">MSc in Computer Science</a>
                       
                        <a href="mba.html">MBA</a>
                     
                    </div>
                </div>
                <a href="#">PhD Programs</a>
                <a href="#">Diploma & Certificate Courses</a>
                <a href="#">Academic Calendar</a>
            </div>
        </div>
        
        <div>
            <a href="#">Admissions</a>
            <div class="dropdown-content">
                <a href="admission.html">Undergraduate Admissions</a>
                
              
                <a href="graduate admission.html">Graduate Admissions</a>
                
                <a href="tuition fees.html">Tuition & Fees</a>
                <a href="scholarship.html">Scholarships</a>
                <a href="addmission requirement.html">Admission Requirements</a>
            </div>
        </div>
        
        <div>
            <a href="#">Research</a>
            <div class="dropdown-content">
                <a href="research center.html">Research Centers</a>
                <a href="publication.html">Publications</a>
                <a href="#">Faculty Research</a>
                <a href="#">Student Research</a>
                <a href="#">Research Grants</a>
            </div>
        </div>
        
        <div>
            <a href="#">Campus Life</a>
            <div class="dropdown-content">
                <a href="#">Student Organizations</a>
                <a href="#">Events</a>
                <a href="#">Sports</a>
                <a href="#">Housing</a>
                <a href="#">Dining</a>
            </div>
        </div>
        
        <div>
            <a href="#">Facilities</a>
            <div class="dropdown-content">
                <a href="library.html">Library</a>
                <a href="#">Laboratories</a>
                <a href="#">Classrooms</a>
                <a href="#">Auditorium</a>
                <a href="#">Sports Complex</a>
            </div>
        </div>
        
        <div>
            <a href="#">News & Events</a>
            <div class="dropdown-content">
                <a href="#">News</a>
                <a href="#">Events Calendar</a>
                <a href="#">Announcements</a>
                <a href="#">Press Releases</a>
            </div>
        </div>
        
        <div>
            <a href="#">About IUB</a>
            <div class="dropdown-content">
                <a href="#">History</a>
                <a href="#">Mission & Vision</a>
                <a href="#">Administration</a>
                <a href="#">Accreditations</a>
                <a href="#">Contact Us</a>
                <a href="student login.html">student login</a>
                <a href="adminlogin.html">admin login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Slider Section -->
    <div class="css-slider">
        <input type="radio" name="slider" id="slide1" checked>
        <input type="radio" name="slider" id="slide2">
        <input type="radio" name="slider" id="slide3">
        <input type="radio" name="slider" id="slide4">
        <input type="radio" name="slider" id="slide5">
        <input type="radio" name="slider" id="slide6">

        <div class="slides">
            <div class="slide"><img src="image1.jpg" alt="Slide 1"></div>
            <div class="slide"><img src="image2.jpg" alt="Slide 2"></div>
            <div class="slide"><img src="image3.jpg" alt="Slide 3"></div>
            <div class="slide"><img src="image4.jpg" alt="Slide 4"></div>
            <div class="slide"><img src="image5.jpg" alt="Slide 5"></div>
            <div class="slide"><img src="image6.jpg" alt="Slide 6"></div>
        </div>

        <div class="navigation">
            <label for="slide1"></label>
            <label for="slide2"></label>
            <label for="slide3"></label>
            <label for="slide4"></label>
            <label for="slide5"></label>
            <label for="slide6"></label>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="box">
            <h3>UNDERGRADUATE ADMISSIONS</h3>
            <p><strong>Session:</strong> Summer 2025</p>
            <p><a href="#">Undergraduate Admission Test Result: click here</a></p>
            <p><a href="#">Undergraduate Combined Merit Scholarship: click here</a></p>
        </div>

        <div class="box wide-box">
            <h3>IUB ARROWS PROGRAM</h3>
            <div class="image-box">
                <img src="image7.jpg" alt="IUB ARROWS Program">
            </div>
            <p>The IUB ARROWS Program is a specialized undergraduate program designed for nurturing future leaders and changemakers.</p>
        </div>

        <div class="box">
            <h3>Health in Frame</h3>
            <div class="image-box">
                <img src="image8jpg.jpg" alt="Photographic Event">
            </div>
            <p>A Photographic Tale of Bangladesh, April 2025</p>
        </div>

        <div class="box">
            <h3>SLASS Colloquium</h3>
            <div class="mini-slider-container">
                <div class="mini-slider-track">
                    <div class="mini-slide"><img src="image9.jpg" alt="Slide 1"></div>
                    <div class="mini-slide"><img src="image10.jpg" alt="Slide 2"></div>
                </div>
            </div>
        </div>

        <div class="box">
            <h3>Events Calendar</h3>
            <div class="event-list">
                <p><strong>24 Apr:</strong> Economics Lecture – 10:00 AM</p>
                <p><strong>24 Apr:</strong> Health in Frame – 11:00 AM to 5:00 PM</p>
                <p><strong>26 Apr:</strong> Ethics in Public Health Research</p>
            </div>
        </div>

        <div class="box">
            <h3>Notice Board</h3>
            <div class="notice-list">
                <p><strong>Office of the Registrar</strong></p>
                <p>Date: 30/05/2025</p>
                <p>Room Reallocation, Spring 2025</p>
                <p><a href="#">Notification on certificates (PDF)</a></p>
            </div>
        </div>
    </div>

    <!-- Academics Highlights Section -->
    <div class="academics-highlights">
        <h2>Explore Our Academic Departments</h2>
        <div class="department-cards">
            <div class="department-card">
                <h3>Computer Science & Engineering (CSE)</h3>
                <p>The CSE department offers cutting-edge programs in software development, artificial intelligence, and data science.</p>
                <a href="cse.html">Learn More</a>
            </div>
            
            <div class="department-card">
                <h3>Electrical & Electronic Engineering (EEE)</h3>
                <p>Our EEE program focuses on power systems, electronics, and telecommunications with modern laboratory facilities.</p>
                <a href="eee.html">Learn More</a>
            </div>
            
            <div class="department-card">
                <h3>Civil Engineering (CE)</h3>
                <p>The CE department prepares students for infrastructure development with emphasis on sustainable design.</p>
                <a href="ce.html">Learn More</a>
            </div>
            
            <div class="department-card">
                <h3>Business Administration (BBA)</h3>
                <p>Our BBA program develops business leaders with concentrations in marketing, finance, and entrepreneurship.</p>
                <a href="bba.html">Learn More</a>
            </div>
            
            <div class="department-card">
                <h3>Environmental Science</h3>
                <p>Study environmental challenges and solutions with our interdisciplinary environmental science program.</p>
                <a href="es.html">Learn More</a>
            </div>
            
            <div class="department-card">
                <h3>English & Humanities</h3>
                <p>Explore literature, linguistics, and cultural studies in our vibrant English department.</p>
                <a href="english.html">Learn More</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#">Academic Calendar</a></li>
                        <li><a href="#">Library</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Alumni</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Schools</h3>
                    <ul>
                        <li><a href="cse.html">School of Engineering & Computer Science</a></li>
                        <li><a href="bba.html">School of Business</a></li>
                        <li><a href="es.html">School of Environmental Science</a></li>
                        <li><a href="english.html">School of Liberal Arts</a></li>
                        <li><a href="#">School of Social Sciences</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul>
                        <li>Plot 16, Block B, Aftabuddin Ahmed Road</li>
                        <li>Bashundhara R/A, Dhaka 1229</li>
                        <li>Email: info@iub.edu.bd</li>
                        <li>Phone: +880 9612 939393</li>
                        <li>Fax: +880 2 9899735</li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Connect With Us</h3>
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">LinkedIn</a></li>
                        <li><a href="#">YouTube</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                &copy; 2025 Independent University, Bangladesh. All Rights Reserved.
            </div>
        </div>
    </footer>
</body>
</html>