<?php
$page_title = "Home";
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" id="hero">
    <div class="hero-background">
        <div class="hero-overlay"></div>
    </div>
    
    <div class="hero-content">
        <div class="container">
            <div class="hero-text animate-fade-in">
                <h1 class="hero-title">
                    I'm <span class="highlight">Mashitishi B. Phurutsi</span>
                    <br>Proudly Known as <span class="highlight">Mr Mash-IT</span>
                </h1>
                
                <p class="hero-subtitle">
                    A tech-driven educator, digital innovator, and passionate advocate for transforming education in historically disadvantaged communities.
                </p>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">13</span>
                        <span class="stat-label">Years at TUT</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">1000+</span>
                        <span class="stat-label">Students Empowered</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">3</span>
                        <span class="stat-label">Annual Hackathons</span>
                    </div>
                </div>
                
                <div class="hero-cta">
                    <a href="endorse.php" class="btn btn-primary btn-large">
                        <i class="fas fa-thumbs-up"></i>
                        Endorse Me Now
                    </a>
                    <a href="about.php" class="btn btn-secondary btn-large">
                        <i class="fas fa-user"></i>
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="hero-scroll">
        <a href="#mission" class="scroll-indicator">
            <i class="fas fa-chevron-down"></i>
        </a>
    </div>
</section>

<!-- Mission Section -->
<section class="mission" id="mission">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">My Mission</h2>
            <p class="section-subtitle">Transforming education through innovation and community engagement</p>
        </div>
        
        <div class="mission-content">
            <div class="mission-text">
                <p class="lead">
                    With 13 years at TUT's Faculty of ICT and a mission to make learning vibrant and fashionable, 
                    I blend academic leadership with real-world innovation — from founding student-focused hackathons 
                    to advancing cloud-native skills through the ICEP internship program.
                </p>
                
                <p>
                    This platform is your window into bold ideas, community impact, and a smarter, stronger future 
                    for higher education governance.
                </p>
                
                <div class="mission-quote">
                    <blockquote>
                        "For A Smarter, Stronger Council, Vote Phurutsi"
                    </blockquote>
                </div>
            </div>
            
            <div class="mission-image">
                <div class="image-placeholder">
                    <i class="fas fa-graduation-cap"></i>
                    <p>Profile Image</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Impact Section -->
<section class="impact">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Making an Impact</h2>
            <p class="section-subtitle">Key initiatives driving change in education and technology</p>
        </div>
        
        <div class="impact-grid">
            <div class="impact-card">
                <div class="impact-icon">
                    <i class="fas fa-code"></i>
                </div>
                <h3>ICEP Program</h3>
                <p>
                    Founder and director of the Informatics Community Engagement Programme, 
                    empowering over 1000 students in agile and cloud-based development since 2013.
                </p>
                <div class="impact-stats">
                    <span class="stat">1000+ Students</span>
                    <span class="stat">Since 2013</span>
                </div>
            </div>
            
            <div class="impact-card">
                <div class="impact-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3>University Hackathons</h3>
                <p>
                    Founded and leads the University Hackathon Series, energizing student innovation 
                    across Limpopo, Mpumalanga, and Gauteng through three annual hackathons since 2018.
                </p>
                <div class="impact-stats">
                    <span class="stat">3 Provinces</span>
                    <span class="stat">Annual Events</span>
                </div>
            </div>
            
            <div class="impact-card">
                <div class="impact-icon">
                    <i class="fas fa-research"></i>
                </div>
                <h3>Research & Innovation</h3>
                <p>
                    Published researcher in social learning, mobile education, and technology integration 
                    with multiple international conference presentations.
                </p>
                <div class="impact-stats">
                    <span class="stat">6+ Publications</span>
                    <span class="stat">International</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Endorse?</h2>
            <p>Join the movement for a smarter, stronger council. Your endorsement matters.</p>
            <a href="endorse.php" class="btn btn-primary btn-large">
                <i class="fas fa-thumbs-up"></i>
                Endorse Phurutsi Now
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>