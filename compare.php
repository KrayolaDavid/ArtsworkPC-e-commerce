<?php
include('function/userfunction.php');
include('includes/header.php'); 
 ?>

    <div class="container py-5">
        <h1 class="text-center display-4 my-4">Choose Your PC Parts</h1>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
                <div class="card bg-white shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h5 mb-3">CPU</h2>
                        <button onclick="location.href='CPU.php'" class="btn btn-primary w-100">Select CPU</button>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card bg-white shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h5 mb-3">GPU</h2>
                        <button onclick="location.href='GPU.php'" class="btn btn-primary w-100">Select GPU</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-white shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h5 mb-3">RAM</h2>
                        <button onclick="location.href='RAM.php'" class="btn btn-primary w-100">Select RAM</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-white shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h5 mb-3">Motherboard</h2>
                        <button onclick="location.href='MOBO.php'" class="btn btn-primary w-100">Select Motherboard</button>
                    </div>
                </div>
            </div>           
            
            <div class="col">
                <div class="card bg-white shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h5 mb-3">Storage</h2>
                        <button onclick="location.href='Storage.php'" class="btn btn-primary w-100">Select Storage</button>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card bg-light shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h5 mb-3">Power Supply</h2>
                        <button onclick="location.href='PSU.php'" class="btn btn-primary w-100">Select Power Supply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>