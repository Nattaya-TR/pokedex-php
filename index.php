<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Pokedex</title>
</head>
<body>
<?php
$base ="https://pokeapi.co/api/v2/pokemon/";
if (isset($_GET['search'])=== false){
    $id = 1;
} else {
    $id= $_GET['search'];
}

$data= file_get_contents($base.$id);
$pokemon = json_decode($data);

//$image = $pokemon['sprites']['front_default'];
//var_dump( $image);
?>

<div id="pokedex">

    <!-- the left container -->
    <div id="left-panel">
        <div id="top-left"></div>
        <div id="top-left1">
            <div id="blue-button">
                <div id=reflect"></div>
            </div>
            <!-- three small light -->
            <div id="top-buttons">
                <div id="top-red-button"></div>
                <div id="top-yellow-button"></div>
                <div id="top-green-button"></div>
            </div>
        </div>
        <!-- screen part -->
        <div id="top-left2">
            <div id="border-screen">
                <div id="button-top1"></div>
                <div id="button-top2"></div>
            </div>
            <!-- screen -->
            <div id="screen">

                <img id='actualEvoImg' src="<?php echo $pokemon->sprites->front_default ?>">


            </div>
            <!-- below screen -->
            <div class="material">

                <form method="get">
                <label for="poke-id"></label>
                    <input type="text" name="search" id="poke-id" placeholder="Id or Name">
                    <input type="submit"  id="run" placeholder="Search pokemon">
                </form>
            </div>

            <div id="display-id">

                <?php echo '<span id="show-id">'.$pokemon->id.'</span>' ?>
            </div>
        </div>
    </div>
    <!-- middle -->
    <div id="middle">
        <div id="hinge1"></div>
        <div id="hinge2"></div>
        <div id="hinge3"></div>
    </div>
    <!-- the right container -->
    <div id="right-panel">
        <div id="top-right"></div>

        <!-- information screen -->
        <div id="info-screen">

            <div class="poke">
                <h4 class="title">

                    <?php echo '<strong class="name">' .$pokemon->name.'</strong>' ?>
                </h4>
            </div>
        </div>

        <?php
        shuffle($pokemon->moves);
        foreach(array_slice($pokemon->moves,0, 4) AS $index => $value) {

           echo '<p class="move" id="move'.($index+1).'">'.$value->move->name.'</p>';
           //echo '<p class="move" id="move2">'.$pokemon['ability']['name']</p>';
           //echo '<p class="move" id="move3">'.$pokemon['ability']['name']</p>';
           //echo '<p class="move" id="move4">'.$pokemon['ability']['name']</p>';
        }
        ?>
        <div id="prevEvo">
             <?php

            $speciesUrl = "https://pokeapi.co/api/v2/pokemon-species/";
            $data = file_get_contents($speciesUrl.$id.'/');
            $evolution = json_decode($data);


            if (isset($evolution->evolves_from_species->name) ){
                echo $evolution->evolves_from_species->name;

            } else{
                echo 'No Evolution';
            }
            ?>
            <?php

            if (isset($evolution->evolves_from_species->name) ){
                $avatar = $evolution->evolves_from_species->name;


                    $api = curl_init("https://pokeapi.co/api/v2/pokemon/$avatar");
                    curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($api);
                    curl_close($api);

                    $newPic = json_decode($response);


                    echo '<img id="previousEvoImg" src="'.$newPic->sprites->front_default.'" >';
                
            }
            ?>
            <b><em class="evolutions"></em></b>
        </div>
    </div>

</div>

</body>

