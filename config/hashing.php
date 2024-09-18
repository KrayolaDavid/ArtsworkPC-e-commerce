<?php
$sensitiveData = "mema";
$salt = bin2hex(random_bytes(16));
$pepper = "SecretPepper";

$dataToHash = $sensitiveData . $salt . $pepper;
$storedHash = hash("sha256", $dataToHash);
$storedSalt = $salt; // Store the salt for later verification

// Assume this is the stored sensitive data, salt, and hash retrieved from the database
$sensitiveDataFromDB = "mema";
$storedSaltFromDB = $storedSalt; // Retrieve stored salt from the database
$storedHashFromDB = $storedHash; // Retrieve stored hash from the database

$dataToHashForVerification = $sensitiveDataFromDB . $storedSaltFromDB . $pepper;
$verificationHash = hash("sha256", $dataToHashForVerification);

if ($storedHashFromDB === $verificationHash) {
    echo "Same";
} else {
    echo "Not Same";
}
?>
