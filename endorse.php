<?php
$page_title = "Endorse Me";
include 'includes/header.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        // Validate and sanitize input
        $name = sanitizeInput($_POST['name']);
        $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
        $message = sanitizeInput($_POST['message']);
        $endorse_checkbox = isset($_POST['endorse']) ? 1 : 0;
        
        // Validation
        if (empty($name) || empty($message)) {
            throw new Exception("Name and message are required.");
        }
        
        if (!$endorse_checkbox) {
            throw new Exception("You must check the endorsement checkbox.");
        }
        
        if (!empty($email) && !isValidEmail($email)) {
            throw new Exception("Please enter a valid email address.");
        }
        
        // Handle avatar upload
        $avatar_path = null;
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            $upload_dir = 'uploads/avatars/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            $file_extension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($file_extension, $allowed_extensions)) {
                $filename = uniqid() . '.' . $file_extension;
                $avatar_path = $upload_dir . $filename;
                
                if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar_path)) {
                    $avatar_path = null;
                }
            }
        }
        
        // Insert endorsement
        $query = "INSERT INTO endorsements (name, email, message, avatar_path, ip_address, user_agent) 
                  VALUES (:name, :email, :message, :avatar_path, :ip_address, :user_agent)";
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':avatar_path', $avatar_path);
        $stmt->bindParam(':ip_address', $_SERVER['REMOTE_ADDR']);
        $stmt->bindParam(':user_agent', $_SERVER['HTTP_USER_AGENT']);
        
        if ($stmt->execute()) {
            $success_message = "Thank you for your endorsement! Your support means a lot.";
        } else {
            throw new Exception("Failed to submit endorsement. Please try again.");
        }
        
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        logError($error_message, __FILE__, __LINE__);
    }
}
?>

<section class="endorse-hero">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Endorse Phurutsi</h1>
            <p class="section-subtitle">Your voice matters. Join the movement for a smarter, stronger council.</p>
        </div>
    </div>
</section>

<section class="endorse-content">
    <div class="container">
        <div class="endorse-grid">
            <!-- Endorsement Form -->
            <div class="endorse-form-section">
                <div class="form-container">
                    <h2>Submit Your Endorsement</h2>
                    
                    <?php if ($success_message): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($error_message): ?>
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle"></i>
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" enctype="multipart/form-data" class="endorse-form" id="endorseForm">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required maxlength="255">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address (Optional)</label>
                            <input type="email" id="email" name="email" maxlength="255">
                            <small class="form-help">Your email will be kept private</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="avatar">Profile Picture (Optional)</label>
                            <input type="file" id="avatar" name="avatar" accept="image/*">
                            <small class="form-help">Upload a profile picture or we'll use your initials</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Your Endorsement Message *</label>
                            <textarea id="message" name="message" rows="5" required maxlength="1000" 
                                placeholder="Share why you endorse Phurutsi for council..."></textarea>
                            <div class="char-counter">
                                <span id="charCount">0</span>/1000 characters
                            </div>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="endorse" required>
                                <span class="checkmark"></span>
                                I endorse Mashitishi B. Phurutsi as a candidate for council
                            </label>
                        </div>
                        
                        <!-- POPIA Disclaimer -->
                        <div class="popia-disclaimer">
                            <h4>Privacy Notice (POPIA Compliance)</h4>
                            <p>
                                By submitting this form, you consent to the collection and processing of your personal information 
                                for the purpose of this endorsement campaign. Your information will be used solely for campaign 
                                purposes and will not be shared with third parties without your consent. You have the right to 
                                access, correct, or delete your personal information at any time.
                            </p>
                        </div>
                        
                        <!-- Simple Captcha -->
                        <div class="form-group captcha-group">
                            <label for="captcha">Security Check: What is 5 + 3?</label>
                            <input type="number" id="captcha" name="captcha" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-large">
                            <i class="fas fa-thumbs-up"></i>
                            Submit Endorsement
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Endorsements Display -->
            <div class="endorsements-display">
                <h3>Recent Endorsements</h3>
                <div class="endorsements-list" id="endorsementsList">
                    <?php
                    try {
                        $database = new Database();
                        $db = $database->getConnection();
                        
                        $query = "SELECT name, message, avatar_path, created_at 
                                 FROM endorsements 
                                 WHERE is_approved = 1 
                                 ORDER BY created_at DESC 
                                 LIMIT 10";
                        
                        $stmt = $db->prepare($query);
                        $stmt->execute();
                        $endorsements = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if (count($endorsements) > 0) {
                            foreach ($endorsements as $endorsement) {
                                echo '<div class="endorsement-item">';
                                echo '<div class="endorsement-avatar">';
                                
                                if ($endorsement['avatar_path'] && file_exists($endorsement['avatar_path'])) {
                                    echo '<img src="' . $endorsement['avatar_path'] . '" alt="' . htmlspecialchars($endorsement['name']) . '">';
                                } else {
                                    echo '<div class="avatar-initials">' . generateAvatar($endorsement['name']) . '</div>';
                                }
                                
                                echo '</div>';
                                echo '<div class="endorsement-content">';
                                echo '<h4>' . htmlspecialchars($endorsement['name']) . '</h4>';
                                echo '<p>' . htmlspecialchars($endorsement['message']) . '</p>';
                                echo '<small>' . date('M j, Y', strtotime($endorsement['created_at'])) . '</small>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p class="no-endorsements">Be the first to endorse Phurutsi!</p>';
                        }
                    } catch (Exception $e) {
                        echo '<p class="error">Unable to load endorsements at this time.</p>';
                        logError($e->getMessage(), __FILE__, __LINE__);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Character counter for message textarea
document.getElementById('message').addEventListener('input', function() {
    const charCount = this.value.length;
    document.getElementById('charCount').textContent = charCount;
    
    if (charCount > 900) {
        document.getElementById('charCount').style.color = '#e74c3c';
    } else {
        document.getElementById('charCount').style.color = '#666';
    }
});

// Simple captcha validation
document.getElementById('endorseForm').addEventListener('submit', function(e) {
    const captcha = document.getElementById('captcha').value;
    if (parseInt(captcha) !== 8) {
        e.preventDefault();
        alert('Please solve the security question correctly.');
        return false;
    }
});
</script>

<?php include 'includes/footer.php'; ?>