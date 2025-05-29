<?php
$page_title = "Page Not Found";
include 'includes/header.php';
?>

<section class="error-page">
    <div class="container">
        <div class="error-content">
            <div class="error-animation">
                <div class="error-number">
                    <span class="four">4</span>
                    <span class="zero">0</span>
                    <span class="four">4</span>
                </div>
                <div class="error-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            
            <div class="error-text">
                <h1>Oops! Page Not Found</h1>
                <p>The page you're looking for seems to have wandered off. Don't worry, even the best explorers sometimes take a wrong turn!</p>
                
                <div class="error-suggestions">
                    <h3>Here's what you can do:</h3>
                    <ul>
                        <li><i class="fas fa-home"></i> Go back to the <a href="index.php">homepage</a></li>
                        <li><i class="fas fa-thumbs-up"></i> Check out the <a href="endorse.php">endorsement page</a></li>
                        <li><i class="fas fa-user"></i> Learn more <a href="about.php">about Phurutsi</a></li>
                        <li><i class="fas fa-envelope"></i> <a href="contact.php">Contact us</a> if you need help</li>
                    </ul>
                </div>
                
                <div class="error-actions">
                    <a href="index.php" class="btn btn-primary btn-large">
                        <i class="fas fa-home"></i>
                        Take Me Home
                    </a>
                    <button onclick="history.back()" class="btn btn-secondary btn-large">
                        <i class="fas fa-arrow-left"></i>
                        Go Back
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.error-page {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--bg-light), white);
    padding: 2rem 0;
}

.error-content {
    text-align: center;
    max-width: 600px;
}

.error-animation {
    margin-bottom: 3rem;
    position: relative;
}

.error-number {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
}

.error-number span {
    font-size: 8rem;
    font-weight: 700;
    color: var(--secondary-color);
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    animation: bounce 2s ease-in-out infinite;
}

.error-number .zero {
    animation-delay: 0.2s;
    color: var(--accent-color);
}

.error-number .four:last-child {
    animation-delay: 0.4s;
}

.error-icon {
    font-size: 4rem;
    color: var(--text-light);
    animation: float 3s ease-in-out infinite;
}

.error-text h1 {
    font-size: 2.5rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.error-text p {
    font-size: 1.2rem;
    color: var(--text-light);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.error-suggestions {
    background: white;
    padding: 2rem;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    margin-bottom: 2rem;
    text-align: left;
}

.error-suggestions h3 {
    color: var(--primary-color);
    margin-bottom: 1rem;
    text-align: center;
}

.error-suggestions ul {
    list-style: none;
    padding: 0;
}

.error-suggestions li {
    padding: 0.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.error-suggestions li i {
    color: var(--secondary-color);
    width: 20px;
}

.error-suggestions a {
    color: var(--secondary-color);
    text-decoration: none;
    font-weight: 500;
}

.error-suggestions a:hover {
    text-decoration: underline;
}

.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-20px);
    }
    60% {
        transform: translateY(-10px);
    }
}

@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-15px);
    }
    100% {
        transform: translateY(0px);
    }
}

@media (max-width: 768px) {
    .error-number span {
        font-size: 5rem;
    }
    
    .error-text h1 {
        font-size: 2rem;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .error-suggestions {
        text-align: center;
    }
    
    .error-suggestions li {
        justify-content: center;
    }
}
</style>

<?php include 'includes/footer.php'; ?>