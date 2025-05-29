<?php
session_start();
require_once 'config/database.php';

// Get current page for navigation highlighting
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>Endorse Phurutsi</title>
    <meta name="description" content="Endorse Mashitishi B. Phurutsi for a smarter, stronger council. Tech-driven educator and digital innovator.">
    <meta name="keywords" content="Phurutsi, endorsement, council, education, technology, innovation">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen">
        <div class="loading-content">
            <div class="loading-spinner"></div>
            <h2 class="loading-text">Loading...</h2>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="index.php">
                    <span class="logo-text">Endorse</span>
                    <span class="logo-highlight">Phurutsi</span>
                </a>
            </div>
            
            <div class="nav-menu" id="nav-menu">
                <a href="index.php" class="nav-link <?php echo $current_page == 'index' ? 'active' : ''; ?>">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="about.php" class="nav-link <?php echo $current_page == 'about' ? 'active' : ''; ?>">
                    <i class="fas fa-user"></i> About
                </a>
                <a href="endorse.php" class="nav-link <?php echo $current_page == 'endorse' ? 'active' : ''; ?>">
                    <i class="fas fa-thumbs-up"></i> Endorse Me
                </a>
                <a href="contact.php" class="nav-link <?php echo $current_page == 'contact' ? 'active' : ''; ?>">
                    <i class="fas fa-envelope"></i> Contact
                </a>
            </div>
            
            <div class="nav-toggle" id="nav-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">