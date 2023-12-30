<?php
$city = $status = $temp = $country = $desc = $img = $error = $name= "";
if (isset($_POST["Submit"])) {
    $city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
    if (empty($city)) {
        $error = "Please Enter a City Name!";
// ... rest of your PHP code

    } else {
        $API_KEY = "03a38ef4bfbefcb62ea80faa3dd5cc4b";
        $API = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$API_KEY";
        $API_DATA = @file_get_contents($API);
        $weather_data =json_decode($API_DATA,true);

        if($API_DATA === false){
            $error = "Enter a Valid City Name!";
        }else{
            $celcius = $weather_data["main"]["temp"] - 273;
            $name = "<p>Name: ". $weather_data["name"]."</p>";
            $temp = "<p>Temperature: ".$celcius."&#8451:<p>";
            $desc = "<p>Weather Description: ".$weather_data["weather"][0]["description"]."</p>";
            $img = "<img src='http://openweathermap.org/img/w/" .$weather_data['weather'][0]['icon'].".png' alt=''>";
            $country = "<p>Country: ". $weather_data["sys"]["country"]."</p>"; 
        }

       
        

        //print_r($weather_data);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEATHER APP</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <section>
        <div>
            <h1>THE WEATHER APP</h1>
            <form method="post">
                <input type="text" name="city" placeholder="Enter City Name..">
                <input type="submit" value="Submit" name="Submit">
            </form>

            <div class="weather-info">
                <?= $img ?>
                <?= $error ?>
                <?= $name ?>
                <?= $temp ?>
                <?= $desc ?>
                <?= $country ?>
            </div>

        </div>
    </section>
</body>

</html>