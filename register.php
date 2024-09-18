<?php
session_start(); 

if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = "You are already logged in";
    header('Location: index.php');
    exit();     
}

include('includes/header.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-item">
            <div class="col-md-4">
                <?php 
                    if(isset($_SESSION['message'])) {
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong> <?= $_SESSION['message']; ?>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Registration Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="function/authcode.php" method="POST" onsubmit="return validateForm()">
                            <div class="mb-3">
                                <label class="form-label">Last name</label>
                                <input type="text" name="lname" class="form-control" placeholder="Enter your Last name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">First name</label>
                                <input type="text" name="fname" class="form-control" placeholder="Enter your First name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Middle name</label>
                                <input type="text" name="mname" class="form-control" placeholder="Enter your Middle name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter your Address" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your Email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password" id="passwordField" required>
                                <span id="passwordError" class="text-danger" style="display: none;">Passwords do not match</span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="cpassword" class="form-control" placeholder="Re-Enter password" id="confirmPasswordField" required>
                                <span id="confirmPasswordError" class="text-danger" style="display: none;">Passwords do not match</span>
                            </div>
                            <button type="submit" name="register_btn" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var password = document.getElementById('passwordField').value;
        var confirmPassword = document.getElementById('confirmPasswordField').value;
        var passwordError = document.getElementById('passwordError');
        var confirmPasswordError = document.getElementById('confirmPasswordError');

        // Reset error messages
        passwordError.style.display = 'none';
        confirmPasswordError.style.display = 'none';

        if (password !== confirmPassword) {
            // Show error messages
            passwordError.style.display = 'block';
            confirmPasswordError.style.display = 'block';
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>

<?php include('includes/footer.php'); ?>
