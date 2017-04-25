<?php
$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>

<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">

<title>Stock Ticker</title>

<link href="/css/bootstrap.min.css" rel="stylesheet">

</head>
 
 <body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Stock Ticker</a>
        </div>
      </div>
    </nav>



 
<h2>Stock Ticker</h2>

<div class="container">
        <table class="table table-striped">
    <thead>
        <tr>
            <th>Symbol</th>
			<th>Name</th>
            <th>Last Trade</th>
			<th>Bid</th>
			<th>Ask</th>
			<th>Change</th>
			<th>% Change</th>
			<th>Volume</th>
        </tr>
    </thead>
<tbody>


<?php
include_once('class.yahoostock.php');

$objYahooStock = new YahooStock;

 
/**
	Add format/parameters to be fetched
	
	#0 s = Symbol
	#1 n = name
	#2 l1 = Last Trade (Price Only)
	#3 a = Bid
	#4 b = Ask
	#5 c1 = Change
	#6 p2 = Percentage Change
	#7 v = Volume
	
	#8 b2 = Ask (Realtime)
	#9 b3 = Bid (Realtime)
	
 */
$objYahooStock->addFormat("snl1abc1p2v"); 
//$objYahooStock->addFormat("snl1b2b3c1p2v"); 
 
/**
	Add company stock code to be fetched
 */


$objYahooStock->addStock("gle.pa");
$objYahooStock->addStock("ac.pa");
$objYahooStock->addStock("civ.pa");
$objYahooStock->addStock("cap.pa"); 
$objYahooStock->addStock("lco.pa");
$objYahooStock->addStock("ho.pa");
$objYahooStock->addStock("lat.pa");
$objYahooStock->addStock("sop.pa");
$objYahooStock->addStock("fr.pa");
$objYahooStock->addStock("pom.pa");
$objYahooStock->addStock("bnp.pa");

 
/**
 * Printing out the data
 */
foreach( $objYahooStock->getQuotes() as $code => $stock)


{

	?>
	
	<!--Added echo str_replace remove quotes "" -->

        <tr>
            <td><?php echo str_replace('"', '', "<a href=http://finance.yahoo.com/echarts?s=$stock[0]+Interactive#symbol=$stock[0];range=5d target=\"_blank\">$stock[0]</a>") ?></td>
            <td><?php echo str_replace('"', '', $stock[1]); ?></td>
            <td><?php echo str_replace('"', '', $stock[2]); ?></td>
            <td><?php echo str_replace('"', '', $stock[3]); ?></td>
            <td><?php echo str_replace('"', '', $stock[4]); ?></td>
			<td><?php echo str_replace('"', '', $stock[5]); ?></td>
			<?php if(($stock[5] < -0.50)) {
						?> <td><button type="button" class="btn btn-danger"><?php echo str_replace('"', '', $stock[6]);?> </button> </td>
					<?php } else if(($stock[5] > -0.50) && ($stock[5] < 0.00)) {
						?> <td><button type="button" class="btn btn-warning"><?php echo str_replace('"', '', $stock[6]);?> </button> </td>
					<?php } else if(($stock[5] = 0.00)) {
						?> <td><button type="button" class="btn btn-info"><?php echo str_replace('"', '', $stock[6]);?> </button> </td>
					<?php } else if(($stock[5] > 0.00) && ($stock[5] < 0.25)) {
						?> <td><button type="button" class="btn btn-primary"><?php echo str_replace('"', '', $stock[6]);?> </button> </td>
					<?php } else{
						?> <td><button type="button" class="btn btn-success"><?php echo str_replace('"', '', $stock[6]);?> </button> </td>			
					<?php }
			?>
			<td><?php echo str_replace('"', '', $stock[7]); ?></td>
					
        </tr>
		
	<?php

}
?>

    </tbody>
	</table>
</div>

<body>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
		
</html>


	
		
