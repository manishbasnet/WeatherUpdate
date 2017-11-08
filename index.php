<?php

$weather = "";
$error = "";

if(array_key_exists('city', $_GET)){

  $city = str_replace(' ', '', $_GET['city']);


  $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest ");

if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $error = "That city could not be found.";

} else {
  
  $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest ");  

  $pageArray = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $forecastPage);

  if (sizeof($pageArray) > 1) {
    


    $secondPageArray = explode('</span></span></span></p><div class="forecast-cont"><div class="units-cont">', $pageArray[1]);

    if (sizeof($pageArray) > 1) {
  
 

  $weather = $secondPageArray[0];

     } else {

       $error = "That city could not be found.";

     }



    } else {

       $error = "That city could not be found.";

    }
}


}

?>






<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Weather Scraper</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


    <style type="text/css">
      
    html {

      background: url(background.jpg) no-repeat center center fixed;
      background-size: cover;

    }

    body {

      background: none;
    }

    .container {

      text-align: center;
      margin-top: 100px;
      width: 450px;
    }

    input {

      margin: 20px 0;
    }

    #weather {
 

      margin-top:15px;
    }


    </style>
  </head>
  <body>
   

  <div class="container">

  <h1>What's The Weather?</h1>

      


  <form>


  <fieldset class="form-group">
    <label for="city">Enter the name of a city.</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" name="<?php

if(array_key_exists('city', $_GET)){


     echo $_GET['city']; 

}

     ?>">

</fieldset>

<button type="submit" class="btn btn-primary">Submit</button>




</form>

  <div id="weather">



  <?php 

  if ($weather) {


    echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';

  } else if ($error){


echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';


  }

   ?>
     


   </div>


  </div>






    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>