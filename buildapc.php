<?php
ob_start();

include('function/userfunction.php');
include('includes/header.php'); 
include('authenticate.php');
include('config/dbcon.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build a PC</title>
    <link rel="stylesheet" href="asset/css/buildapc.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="py-3 bg-danger">
        <div class="container">
            <h6 class="text-red">
                <a style="text-decoration:none" class="text-white" href="buildapc.php">PCPULSE</a>
            </h6>
        </div>
    </div>

    <main>
        <div class="buildapc">
            <div class="chart">
                <div class="content">
                    <canvas class="myChart" id="myChart"></canvas>
                </div>
            </div>
            <div class="selected">
                <h1 class="text-3xl font-bold mb-4 text-center">Parts Selected</h1>

                <div class="button-section">
                    <button name="btn-Components" class="btn" onclick="showSection('selected-parts')">Components</button>
                    <button name="btn-Peripherals" class="btn" onclick="showSection('peripherals')">Peripherals</button>
                    <button name="btn-Summary" class="btn" onclick="showSection('summary')">Summary</button>
                </div>
                

                <div class="selected-parts" style="display:block">
                    <?php
                        $pitem = getSelectedProcessor();
                            if ($pitem): 
                        ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="upproduct/<?= $pitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                                <div class="item-content" value="<?= $pitem['category_id'] ?>,<?= $pitem['rating'] ?>" data-selected="true">
                                    <h4 class="item-name"><?= $pitem['name'] ?></h4>
                                    <button name="btn-addtocart" class="btn">Socket Type:</button>
                                    <button name="btn-addtocart" class="btn">Chipset:</button>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $pitem['cid'] ?>">Clear</button>
                                    <button name="compare-item-btn" class="btn-compare">Compare</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="asset\images\icons\Processor.png" alt="Component Image" class="parts-selected-img">
                                <div class="item-content" data-selected="false">
                                    <h4 class="item-name">No Processor Selected</h4>
                                    <button name="btn-addtocart" class="btn">Socket Type:</button>
                                    <button name="btn-addtocart" class="btn">Chipset:</button>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                    <button name="compare-item-btn" class="btn-compare">Compare</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                    $Mitem = getSelectedMotherboard();
                        if ($Mitem): 
                    ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="upproduct/<?= $Mitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" value="<?= $Mitem['category_id'] ?>,<?= $Mitem['rating'] ?>" data-selected="true">
                                <h4 class="item-name"><?= $Mitem['name'] ?></h4>
                                <button name="btn-addtocart" class="btn">Socket Type:</button>
                                <button name="btn-addtocart" class="btn">PCIe Slot:</button>
                                <button name="btn-addtocart" class="btn">Size:</button>
                                <button name="btn-addtocart" class="btn">RAM:</button>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $Mitem['cid'] ?>">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>    
                    </div>
                    <?php else: ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="asset\images\icons\Motherboard.png" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" data-selected="false">
                                <h4 class="item-name">No Motherboard Selected</h4>
                                <button name="btn-addtocart" class="btn">Socket Type:</button>
                                <button name="btn-addtocart" class="btn">PCIe Slot:</button>
                                <button name="btn-addtocart" class="btn">Size:</button>
                                <button name="btn-addtocart" class="btn">RAM:</button>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php
                    $MEitem = getSelectedMemory();
                    if ($MEitem): 
                    ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="upproduct/<?= $MEitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" value="<?= $MEitem['category_id'] ?>,<?= $MEitem['rating'] ?>" data-selected="true">
                                <h4 class="item-name"><?= $MEitem['name'] ?></h4>
                                <button name="btn-addtocart" class="btn">Type:</button>
                                <button name="btn-addtocart" class="btn">Quantity:</button>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $MEitem['cid'] ?>">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="asset\images\icons\Memory.png" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" data-selected="false">
                                <h4 class="item-name">No RAM card Selected</h4>
                                <button name="btn-addtocart" class="btn">Type:</button>
                                <button name="btn-addtocart" class="btn">Quantity:</button>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php
                    $GPUitem = getSelectedGPU();
                    if ($GPUitem): 
                    ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="upproduct/<?= $GPUitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" value="<?= $GPUitem['category_id'] ?>,<?= $GPUitem['rating'] ?>" data-selected="true">
                                <h4 class="item-name"><?= $GPUitem['name'] ?></h4>
                                <button name="btn-addtocart" class="btn">Type:</button>
                                <button name="btn-addtocart" class="btn">Size:</button>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $GPUitem['cid'] ?>">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div id="items-container" data-selected="false">
                        <div class="selected-items">
                            <img src="asset\images\icons\Gpu.png" alt="Component Image" class="parts-selected-img">
                            <div class="item-content">
                                <h4 class="item-name">No GPU Selected</h4>
                                <button name="btn-addtocart" class="btn">Type:</button>
                                <button name="btn-addtocart" class="btn">Size:</button>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php
                    $SSDitem = getSelectedSSD();
                    if ($SSDitem): 
                    ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="upproduct/<?= $SSDitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" value="<?= $SSDitem['category_id'] ?>,<?= $SSDitem['rating'] ?>" data-selected="true">
                                <h4 class="item-name"><?= $SSDitem['name'] ?></h4>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $SSDitem['cid'] ?>">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="asset\images\icons\M2.png" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" data-selected="false">
                                <h4 class="item-name">No SSD Selected</h4>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php
                    $HDDitem = getSelectedHDD();
                    if ($HDDitem): 
                    ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="upproduct/<?= $HDDitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" value="<?= $HDDitem['category_id'] ?>,<?= $HDDitem['rating'] ?>" data-selected="true">
                                <h4 class="item-name"><?= $HDDitem['name'] ?></h4>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $HDDitem['cid'] ?>">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="asset\images\icons\hdd.png" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" data-selected="false">
                                <h4 class="item-name">No HDD Selected</h4>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php
                    $PSUitem = getSelectedPSU();
                    if ($PSUitem): 
                    ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="upproduct/<?= $PSUitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" value="<?= $PSUitem['category_id'] ?>,<?= $PSUeitem['rating'] ?>" data-selected="true">
                                <h4 class="item-name"><?= $PSUitem['name'] ?></h4>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $PSUitem['cid'] ?>">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="asset\images\icons\powersupply.png" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" data-selected="false">
                                <h4 class="item-name">No Powersupply Selected</h4>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php
                    $Caseitem = getSelectedCASE();
                    if ($Caseitem): 
                    ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="upproduct/<?= $Caseitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" value="<?= $Caseitem['category_id'] ?>,<?= $Caseitem['rating'] ?>" data-selected="true">
                                <h4 class="item-name"><?= $Caseitem['name'] ?></h4>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $Caseitem['cid'] ?>">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="asset\images\icons\case.png" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" data-selected="false">
                                <h4 class="item-name">No Case Selected</h4>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php
                    $Cooleritem = getSelectedCOOLER();
                    if ($Cooleritem): 
                    ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="upproduct/<?= $Cooleritem['image'] ?>" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" value="<?= $Cooleritem['category_id'] ?>,<?= $Cooleritem['rating'] ?>" data-selected="true">
                                <h4 class="item-name"><?= $Cooleritem['name'] ?></h4>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $Cooleritem['cid'] ?>">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div id="items-container">
                        <div class="selected-items">
                            <img src="asset\images\icons\cooler.png" alt="Component Image" class="parts-selected-img">
                            <div class="item-content" data-selected="false">
                                <h4 class="item-name">No Cooling Fan Selected</h4>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                <button name="compare-item-btn" class="btn-compare">Compare</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="peripherals" style="display:none">
                    <div id="items-container">
                        <?php
                        $KBDitem = getSelectedKBD();
                        if ($KBDitem): 
                        ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="upproduct/<?= $KBDitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                                <div class="item-content" value="<?= $KBDitem['category_id'] ?>">
                                    <h4 class="item-name"><?= $KBDitem['name'] ?></h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $KBDitem['cid'] ?>">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="asset\images\icons\KBD.png" alt="Component Image" class="parts-selected-img">
                                <div class="item-content">
                                    <h4 class="item-name">No Keyboard Selected</h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php
                        $Mtritem = getSelectedMonitor();
                        if ($Mtritem): 
                        ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="upproduct/<?= $Mtritem['image'] ?>" alt="Component Image" class="parts-selected-img">
                                <div class="item-content" value="<?= $Mtritem['category_id'] ?>">
                                    <h4 class="item-name"><?= $Mtritem['name'] ?></h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $Mtritem['cid'] ?>">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="asset\images\icons\monitor.png" alt="Component Image" class="parts-selected-img">
                                <div class="item-content">
                                    <h4 class="item-name">No Monitor Selected</h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php
                        $Mseitem = getSelectedMouse();
                        if ($Mseitem): 
                        ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="upproduct/<?= $Mseitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                                <div class="item-content" value="<?= $Mseitem['category_id'] ?>">
                                    <h4 class="item-name"><?= $Mseitem['name'] ?></h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $Mseitem['cid'] ?>">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="asset\images\icons\mouse.png" alt="Component Image" class="parts-selected-img">
                                <div class="item-content">
                                    <h4 class="item-name">No Mouse Selected</h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php
                        $Spkritem = getSelectedSpeaker();
                        if ($Spkritem): 
                        ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="upproduct/<?= $Spkritem['image'] ?>" alt="Component Image" class="parts-selected-img">
                                <div class="item-content" value="<?= $Spkritem['category_id'] ?>">
                                    <h4 class="item-name"><?= $Spkritem['name'] ?></h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $Spkritem['cid'] ?>">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="asset\images\icons\speaker.png" alt="Component Image" class="parts-selected-img">
                                <div class="item-content">
                                    <h4 class="item-name">No Speaker selected</h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php
                        $Hdstitem = getSelectedHeadset();
                        if ($Hdstitem): 
                        ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="upproduct/<?= $Hdstitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                                <div class="item-content" value="<?= $Hdstitem['category_id'] ?>">
                                    <h4 class="item-name"><?= $Hdstitem['name'] ?></h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $Hdstitem['cid'] ?>">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="asset\images\icons\headset.png" alt="Component Image" class="parts-selected-img">
                                <div class="item-content">
                                    <h4 class="item-name">No Headset selected</h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php
                        $Mcphnitem = getSelectedMicrophone();
                        if ($Mcphnitem): 
                        ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="upproduct/<?= $Mcphnitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                                <div class="item-content" value="<?= $Mcphnitem['category_id'] ?>">
                                    <h4 class="item-name"><?= $Mcphnitem['name'] ?></h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $Mcphnitem['cid'] ?>">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="asset\images\icons\mic.png" alt="Component Image" class="parts-selected-img">
                                <div class="item-content">
                                    <h4 class="item-name">No Microphone Selected</h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php
                        $Camitem = getSelectedCamera();
                        if ($Camitem): 
                        ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="upproduct/<?= $Camnitem['image'] ?>" alt="Component Image" class="parts-selected-img">
                                <div class="item-content" value="<?= $Camnitem['category_id'] ?>">
                                    <h4 class="item-name"><?= $Camnitem['name'] ?></h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem" value="<?= $Camnitem['cid'] ?>">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div id="items-container">
                            <div class="selected-items">
                                <img src="asset\images\icons\webcam.png" alt="Component Image" class="parts-selected-img">
                                <div class="item-content">
                                    <h4 class="item-name">No Camera Selected</h4>
                                </div>
                                <div class="btn-div">
                                    <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem">Clear</button>
                                    <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="summary" style="display:none">
                    <div id="items-container">
                    <?php
                        $items = getSelectedItems();
                        if(mysqli_num_rows($items) > 0){
                        ?>
                        <div id="items-container">
                            <?php
                                foreach($items as $citem) {
                                ?>
                            <div class="selected-items">
                                <img src="upproduct/<?= $citem['image'] ?>" alt="Component Image"
                                    class="parts-selected-img">
                                <div class="item-content" value="<?= $citem['category_id'] ?>,<?= $citem['rating'] ?>">
                                    <h4 class="item-name"><?= $citem['name'] ?></h4>
                            </div>
                            <div class="btn-div">
                                <button id="refreshButton" name="clear-itm--btn" class="btn-clear clearItem"
                                    value="<?= $citem['selling_price'] ?>">Clear</button>
                                <button name="btn-addtocart" class="btn">Add to cart</button>
                            </div>
                        </div>
                        <?php
                            }
                            ?>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div class="summary-items">
                        <h1 class="text-3xl font-bold mb-4 text-center">No Items to Summarize</h1>
                    </div>
                    <?php
                    }
                    ?>
                </div>

            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
                integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="asset/js/radarchart.js"></script>
        </div>
        <div class="parts-select">
            <h1 class="text-3xl font-bold mb-4 text-center">Select PC Parts</h1>
            <div class="selection">
                <?php 
                $components = getAllActive("components");
                if(mysqli_num_rows($components) > 0) {
                    foreach($components as $item) { ?>
                        <div class="part-item-container">
                            <div class="part-items" data-slug="<?= $item['slug'] ?>">
                                <img src="uploads/<?= $item['image'] ?>" alt="Component Image" class="parts-select-img">
                                <h4 class="text-center"><?= $item['name'] ?></h4>
                            </div>
                            <div class="dropdown-item-container">
                                <div class="dropdown-content" id="dropdown-<?= $item['slug'] ?>" style="display:none;">
                                    <!-- Dropdown content will be populated here -->
                                </div>
                            </div>
                        </div>
                    <?php }
                } else {
                    echo "There is no data available";
                } ?>
            </div>
        </div>

    </main>
        

    <?php
    include('config/dbcon.php'); // Include your database connection

    // Function to get summed ratings by category
    function getCategoryRatings() {
        global $con; // Assuming $con is your database connection variable
        
        // Query to fetch category_id and ratings from selected_products table
        $query = "SELECT category_id, rating FROM selected_products";
        $query_run = mysqli_query($con, $query);

        // Array to store summed category ratings
        $categoryRatings = [
            'computing' => 0,
            'rendering' => 0,
            'datatransferspeed' => 0,
            'datastorage' => 0,
            'powercapacity' => 0
        ];

        if (mysqli_num_rows($query_run) > 0) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                $category_id = $row['category_id'];
                $rating = $row['rating'];

                // Map category_id to categories and sum the ratings
                switch ($category_id) {
                    case 28:
                        $categoryRatings['computing'] += $rating;
                        break;
                    case 29:
                        $categoryRatings['rendering'] += $rating;
                        break;
                    case 31:
                        $categoryRatings['datatransferspeed'] += $rating;
                        break;
                    case 36:
                        $categoryRatings['datastorage'] += $rating;
                        break;
                    case 37:
                        $categoryRatings['powercapacity'] += $rating;
                        break;
                    default:
                        // Handle other cases if needed
                        break;
                }
            }
        }

        return $categoryRatings;
    }

    // Call the function and get the summed ratings
    $ratings = getCategoryRatings();

    ?>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const itemContent = document.querySelector('.item-content');
        const partItems = document.querySelector('.part-items');
        
        if (itemContent.getAttribute('data-selected') === 'false') {
            partItems.addEventListener('click', function(e) {
                e.preventDefault();  // Prevent access
                alert("Please select a processor first");
            });
        }
    });
    </script>

    <script>
    function showSection(sectionId) {
    const sections = ['selected-parts', 'peripherals', 'summary'];
    
    sections.forEach(id => {
        const element = document.querySelector(`.${id}`);
        if (element) {
            if (id === sectionId) {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        }
    });
    }
    </script>

    <script>

function refreshPage() {
    location.reload();
}

// Select all buttons with the class 'clearItem'
const buttons = document.querySelectorAll('.clearItem');

// Attach the event listener to each button
buttons.forEach(button => {
    button.onclick = refreshPage;
});


        function getComponentByCategoryId(categoryId) {
           return categoryMap[categoryId] || 'Unknown category';
        }

        const ctx = document.getElementById('myChart').getContext('2d');
        const data = {
            labels: [
                'Computing',
                'Rendering',
                'Data Transfer Speed',
                'Power Capacity',
                'Data Storage'
            ],
            datasets: [{
                labels: 'My First Dataset',
                data: '<?php $ratings?>',
                fill: true,
                backgroundColor: 'rgb(242, 244, 245)',
                borderColor: 'rgb(255, 255, 255)',
                pointBackgroundColor: 'rgb(255, 255, 255)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(255, 255, 255)',
            }]
        };

        const config = {
            type: 'radar',
            data,
            options: {
                scales: {
                    r: {
                        beingAtZero: true,
                        min: 0,
                        max: 10,
                        ticks: {
                            stepSize: 1,
                            callback: (value, tick, values) => {
                                console.log(value)
                            }
                        },
                        grid: {
                            color: 'black'
                        }
                    }
                },
                element: {
                    line: {
                        borderWidth: 20
                    }
                }
            }
        };

        const myChart = new Chart(ctx, config);

    </script>

    <script>

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let openDropdown = null; // To store the currently open dropdown

        document.querySelectorAll('.part-items').forEach(item => {
            item.addEventListener('click', function () {
                const slug = this.getAttribute('data-slug');
                const dropdown = document.getElementById(`dropdown-${slug}`);

            //If there's already an open dropdown and it's not the same as the one being clicked
                if (openDropdown && openDropdown !== dropdown) {
                    openDropdown.style.display = "none"; // Close the previously open dropdown
                }

            //Toggle the clicked dropdown
                if (dropdown.style.display === "none" || dropdown.style.display === "") {
                    dropdown.style.display = "block";
                    openDropdown = dropdown; // Update the open dropdown tracker
                        window.scrollTo(0, document.body.scrollHeight);

                //Fetch the products via AJAX
                    fetch(`fetch_products.php?component=${slug}`)
                        .then(response => response.text())
                        .then(data => {
                            dropdown.innerHTML = data;
                        });
                   } else {
                   dropdown.style.display = "none";
                   openDropdown = null; //No dropdown is open now
               }
           });
        });
    });
    </script>

</body>

</html>

<?php ob_end_flush(); ?>
<?php include('includes\footer.php'); ?>
