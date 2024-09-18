<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Bootstrap Carousel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="d-flex justify-content-center align-items-center">
    <div id="simpleCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="asset/images/slider1.png" height="400px" class="d-block w-200" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="asset/images/slider2.png" height="400px" class="d-block w-200" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="asset/images/slider3.png" height="400px" class="d-block w-200" alt="Slide 3">
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
