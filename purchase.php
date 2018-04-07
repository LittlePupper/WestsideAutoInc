<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

	<head>
		<title>Westside Auto Inc. | Purchase</title>
		<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />

		<!-- CSS -->
		
		<link rel="stylesheet" href="css/app.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="css/foundation.min.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
        
        <!-- NAVIGATION -->
        
        <div class="grid-x">
            <div class="cell">
                <ul class="menu align-right menu-hover-lines">
                    <li><a href="/">Home</a></li>
                    <li class="active"><a href="purchase.php">Purchase</a></li>
                    <li><a href="sale.php">Sale</a></li>
                    <li><a href="customer.php">Customer</a></li>
                    <li><a href="buyer.php">Buyer</a></li>
                    <li><a href="salesperson.php">Salesperson</a></li>
                    <li><a href="warrantyitem.php">Warranty Item</a></li>
                </ul>
            </div>
        </div>
        
        <div class="form">
            <div class="grid-container">
                <div class="large-12 cell">
                    <div class="title">Purchase a vehicle</div>
                    <div class="description">Use this form when a buyer purchases a vehicle.</div>
                </div>
                <form>
                    
                    <fieldset>
                        <div class="grid-x grid-padding-x ">
                            <div class="large-1 cell">
                                <label for="middle-label" class="text-right middle">Buyer</label>
                            </div>
                            <div class="large-5 cell">
                                <select name="style" >
                                    <option alue="convertible">Convertible</option>
                                    <option value="coupe">Coupe</option>
                                    <option value="crossover">Crossover</option>
                                    <option value="hatchback">Hatchback</option>
                                    <option value="mpv">MPV</option>
                                    <option value="sedan">Sedan</option>
                                    <option value="suv">SUV</option>
                                    <option value="station-wagon">Station wagon</option>
                                    <option value="truck">Truck</option>
                                    <option value="van">Van</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    
                    <fieldset>
                        <div class="grid-x grid-padding-x ">    
                            <div class="large-12 cell">
                                <hr>
                            </div>

                            <div class="large-1 cell">
                                <label for="middle-label" class="text-right middle">Date</label>
                            </div>
                            <div class="large-5 cell">
                                <input type="date" name="date" id="middle-label">
                            </div>

                            <div class="large-1 cell">
                                <label for="middle-label" class="text-right middle">Auction</label>
                            </div>
                            <div class="large-5 cell">
                                <input type="checkbox" name="auction" value="auction">
                            </div>

                            <div class="large-1 cell">
                                <label for="middle-label" class="text-right middle">Seller</label>
                            </div>
                            <div class="large-5 cell">
                                <input type="text" name="seller" placeholder="John Doe">
                            </div>

                            <div class="large-1 cell">
                                <label for="middle-label" class="text-right middle">Location</label>
                            </div>
                            <div class="large-5 cell">
                                <input type="text" name="location" placeholder="National Auto Outlet">
                            </div>
                        </div>
                    </fieldset>
                        
                    <fieldset id="car">
                        <div class="vehicle-group">
                            <div class="grid-x grid-padding-x">
                                <div class="large-12 cell">
                                        <hr>
                                    </div>
                                <div class="large-1 cell">
                                    <label for="make" class="text-right middle">Make</label>
                                </div>
                                <div class="large-5 cell">
                                    <input type="text" name="make" placeholder="Volkswagen">
                                </div>

                                <div class="large-1 cell">
                                    <label for="model" class="text-right middle">Model</label>
                                </div>
                                <div class="large-5 cell">
                                    <input type="text" name="model" placeholder="Golf">
                                </div>

                                <div class="large-1 cell">
                                    <label for="year" class="text-right middle">Year</label>
                                </div>
                                <div class="large-5 cell">
                                    <input type="number" name="year" placeholder="2008">
                                </div>

                                <div class="large-1 cell">
                                    <label for="style" class="text-right middle">Style</label>
                                </div>
                                <div class="large-5 cell">
                                    <select name="style">
                                        <option value="convertible">Convertible</option>
                                        <option value="coupe">Coupe</option>
                                        <option value="crossover">Crossover</option>
                                        <option value="hatchback">Hatchback</option>
                                        <option value="mpv">MPV</option>
                                        <option value="sedan">Sedan</option>
                                        <option value="suv">SUV</option>
                                        <option value="station-wagon">Station wagon</option>
                                        <option value="truck">Truck</option>
                                        <option value="van">Van</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>  

                                <div class="large-1 cell">
                                    <label for="color" class="text-right middle">Color</label>
                                </div>
                                <div class="large-5 cell">
                                    <input type="text" name="color" placeholder="Red">
                                </div>

                                <div class="large-1 cell">
                                    <label for="interior" class="text-right middle">Interior</label>
                                </div>
                                <div class="large-5 cell">
                                    <input type="text" name="interior" placeholder="Tan">
                                </div>

                                <div class="large-1 cell">
                                    <label for="mileage" class="text-right middle">Mileage</label>
                                </div>
                                <div class="large-5 cell">
                                    <div class="input-group">
                                        <input class="input-group-field" type="number" name="mileage" placeholder="15000">
                                        <span class="input-group-label">km</span>
                                    </div>
                                </div>

                                <div class="large-1 cell">
                                    <label for="condition" class="text-right middle">Condition</label>
                                </div>
                                <div class="large-5 cell">
                                    <input type="text" name="condition" placeholder="Mint">
                                </div>

                                <div class="large-1 cell">
                                    <label for="bookPrice" class="text-right middle">Book price</label>
                                </div>
                                <div class="large-5 cell">
                                    <div class="input-group">
                                        <span class="input-group-label">$</span>
                                        <input class="input-group-field" name="bookPrice" type="number" placeholder="3549.00">
                                    </div>
                                </div>

                                <div class="large-1 cell">
                                    <label for="pricePaid" class="text-right middle">Price paid</label>
                                </div>
                                <div class="large-5 cell">
                                    <div class="input-group">
                                        <span class="input-group-label">$</span>
                                        <input class="input-group-field" name="pricePaid" type="number" placeholder="2950.00">
                                    </div>
                                </div>
                            </div>  

                            <fieldset id="problem">
                                <div class="grid-x grid-padding-x problem-group"> 
                                    <div class="large-12 cell">
                                        <hr>
                                    </div>                
                                    <div class="large-1 cell">
                                        <label for="problemNo" class="text-right middle">Problem #</label>
                                    </div>
                                    <div class="large-1 cell">
                                        <input type="number" name="problemNo" placeholder="1">
                                    </div>

                                    <div class="large-3 cell">
                                        <label for="estCost" class="text-right middle">Est. cost</label>
                                    </div>
                                    <div class="large-2 cell">
                                        <div class="input-group">
                                            <span class="input-group-label">$</span>
                                            <input class="input-group-field" name="estCost" type="number" placeholder="400.00">
                                        </div>
                                    </div>

                                    <div class="large-3 cell">
                                        <label for="actualCost" class="text-right middle">Actual cost</label>
                                    </div>
                                    <div class="large-2 cell">
                                        <div class="input-group">
                                            <span class="input-group-label">$</span>
                                            <input class="input-group-field" name="actualCost" type="number" placeholder="300.00">
                                        </div>
                                    </div>

                                    <div class="large-1 cell">
                                        <label for="problem" class="text-right middle">Problem</label>
                                    </div>                        
                                    <div class="large-11 cell">
                                        <textarea name="problem" placeholder="The problem is..."></textarea>
                                    </div>
                            </fieldset>
                        
                            <div class="grid-x grid-padding-x">
                                <div class="large-12 cell">
                                    <input type="button" class="button float-right" id="add-problem" name="add-problem" value="Add problem" />
                                </div>
                            </div>
                            
                        </div>
                        
                    </fieldset>
                    
                    <div class="grid-x grid-padding-x">
                        <div class="large-12 cell">
                            <input type="button" class="button float-right" id="add-vehicle" name="add-vehicle" value="Add vehicle" />
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        
        <!-- JQUERY FIRST -->
		
		<script type="text/javascript" src="js/vendor/jquery.js"></script>
        <script type="text/javascript" >
            jQuery(function($){
                var $buttonProblem = $('#add-problem'),
                    $rowProblem = $('.problem-group').clone(),
                    $buttonVehicle = $('#add-vehicle'),
                    $rowVehicle = $('.vehicle-group');

                $buttonProblem.click(function(){
                    $rowProblem.clone().insertBefore( $buttonProblem );
                });
                $buttonVehicle.click(function() {
                   $rowVehicle.clone(true).off().insertBefore( $buttonVehicle); 
                });
            });
        </script>
		
		<!-- OTHER SCRIPTS -->
		
		<script type="text/javascript" src="js/vendor/foundation.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>		
	</body>
</html>