<?php


// Include database connection if needed
include('includes/header.php');
include('../config/dbcon.php');



?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php            
// Set your Lalamove API credentials
$lalamoveAPIKey = "your_lalamove_api_key";
$lalamoveAPISecret = "your_lalamove_api_secret";

// Check if this page is triggered after the admin confirms an order
if (isset($_POST['confirmDelivery'])) {
    // Fetch order details from the database
    $orderId = $_POST['order_id']; // Assuming you get the order ID from the form
    $orderDetailsQuery = "SELECT * FROM orders WHERE id='$orderId'";
    $orderDetailsResult = mysqli_query($con, $orderDetailsQuery);
    $orderDetails = mysqli_fetch_assoc($orderDetailsResult);

    // Get customer and delivery details from the order
    $customerName = $orderDetails['name'];
    $customerPhone = $orderDetails['phone'];
    $deliveryAddress = $orderDetails['address'];
    $zipcode = $orderDetails['zipcode'];

    // Add your specific delivery data
    $deliveryData = [
        "serviceType" => "MOTORCYCLE",
        "specialRequests" => [],
        "requesterContact" => [
            "name" => "Your Shop Name",
            "phone" => "Your Shop Phone Number"
        ],
        "stops" => [
            [
                "coordinates" => [
                    "lat" => "14.6091", // Shop's latitude
                    "lng" => "121.0223" // Shop's longitude
                ],
                "address" => "Your Shop's Address",
                "name" => "Your Shop Name",
                "phone" => "Your Shop Phone"
            ],
            [
                "coordinates" => [
                    "lat" => "14.5512", // Customer's latitude (can be fetched from external API based on address)
                    "lng" => "121.0193" // Customer's longitude
                ],
                "address" => "$deliveryAddress, $zipcode",
                "name" => $customerName,
                "phone" => $customerPhone
            ]
        ],
        "deliveries" => [
            [
                "toStop" => 1,
                "remarks" => "Delivery for Order #$orderId",
                "cashOnDelivery" => [
                    "amount" => $orderDetails['total_price']
                ]
            ]
        ],
        "scheduleAt" => null // Optional: Use this if you want to schedule the delivery at a specific time
    ];

    // Create the request payload
    $jsonData = json_encode($deliveryData);

    // Generate the Lalamove API signature
    $timestamp = time() * 1000; // Convert to milliseconds
    $rawSignature = "$timestamp\r\nPOST\r\n/v3/orders\r\n$jsonData";
    $signature = hash_hmac('sha256', $rawSignature, $lalamoveAPISecret);

    // Initiate CURL request to Lalamove API
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://rest.sandbox.lalamove.com/v3/orders", // Use the production URL for live
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => [
            "Authorization: hmac $timestamp:$signature",
            "Content-Type: application/json",
            "X-Api-Key: $lalamoveAPIKey",
            "Accept: application/json"
        ]
    ]);

    // Execute CURL request
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the response and check if the order creation was successful
    $responseArray = json_decode($response, true);

    if (isset($responseArray['data']['orderId'])) {
        $lalamoveOrderId = $responseArray['data']['orderId'];

        // Save the Lalamove order ID and other details into the database
        $updateOrderQuery = "UPDATE orders SET lalamove_order_id='$lalamoveOrderId' WHERE id='$orderId'";
        if (mysqli_query($con, $updateOrderQuery)) {
            echo "Delivery order successfully created with Lalamove Order ID: $lalamoveOrderId";
        } else {
            echo "Error updating the database: " . mysqli_error($con);
        }
    } else {
        // Handle any errors from the Lalamove API response
        echo "Error creating Lalamove order: " . $responseArray['message'];
    }
} else {
    echo "No delivery request made.";
}
?>
        </div>
    </div>
</div>