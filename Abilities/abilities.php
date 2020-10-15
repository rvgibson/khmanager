<?php
require_once('ability_db.php');
require_once ('ability.php');
$abilities = $_SESSION['Ability_list'];
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Abilities</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link type="text/css" rel="stylesheet" href="./main2.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>	
       
    </head>
    <body>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="main.css">
    </head>
    <body>
       <header>
            
        </header>
             <nav>
                <ul>
                    <li><a href="index.php?action=main">Home</a></li>
                    <li><a href="index.php?action=abilities">All Abilities</a></li>
                    <li><a href="./add_ability.php">Add Actives</a></li>
                    <li><a href="index.php?action=add_agument">Add Passives</a></li>
                </ul>
            </nav>
        
            <div class="row">   
                <div id="abilityList" class="col-8">	
                    <table class="table table-striped"><tr><th>Name</th><th>Tree</th><th>Tier</th><th>Tags</th><th>Range</th><th>Target</th><th>AoE</th><th>Damage Formula</th></tr>
                        <?php 
                                foreach($abilities as $ability):          ?>
                         <form action="." method="POST">
                            <tr class="clickable" onclick="hideDiv()"id="<?php echo $ability->getName(); ?>">
                            <td><?php echo $ability->getName(); ?></td>
                            <td><?php echo htmlspecialchars($ability->getTree()); ?></td>
                            <td><?php echo htmlspecialchars($ability->getTier()); ?></td>
                            <td><?php echo htmlspecialchars($ability->getTags()); ?></td> 
                            <td><?php echo htmlspecialchars($ability->getAtkrange()); ?></td>
                            <td>PLACEHOLDER</td>
                            <td><?php echo htmlspecialchars($ability->getAoe()); ?></td>
                            <td><?php echo htmlspecialchars($ability->getDamage()); ?></td>
                            <input type="hidden" name="ablName" value="<?php echo $ability->getName(); ?>">
                            <input type="hidden" name="charName" value="<?php if(isset($activeCharacter) && $activeCharacter !== "null"){echo $activeCharacter->getChar_name();} ?>">
                            <input type="hidden" name="action" value="buyAbility">
                            <!--<td><input type="submit" value="Buy Ability" action="." method="Post" <?php if(!isset($activeCharacter) || $activeCharacter === "null" || $_SESSION['loginToken'] === false){echo "disabled";}?>></td>-->
                        </tr>
                         </form>
                        <?php endforeach; ?>
                    </table>
                </div>
                
                
                <div class ="infobar col-3">
                    <div id="abilityDesc">
                    <?php 
                                foreach($abilities as $ability):          ?>
                    <div style="display: none"  id="<?php echo $ability->getName(); ?>div">
                        <span style="font-weight: bold"><?php echo $ability->getName(); ?></span><br>
                        
                        <?php echo $ability->getFlavor();?></div>
                    <?php endforeach; ?>
                </div>
                <script type="text/javascript"> 
                    var prevSelected;
                    
                    $("tr").click(function(){ 
                        var a = this.id+"div";
                        var descOut = document.getElementById(a);
                        descOut.style.display = "block";
                        prevSelected = a;   
                    });

                    function hideDiv(){
                        var hideDiv = document.getElementById(prevSelected);
                           hideDiv.style.display = "none";
                    }
            </script>
        </div>
        </div>
        <div class="row">
        <div class="filterOptions">
                    <h4>Filter:</h4>
                    <form action="index.php" method="POST">
                        
                        <label>Tier: </label><select name="tier">
                            <option value="NULL"> </option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option></select>
                        <label>Type: </label><select name="classification">
                            <option value="NULL"> </option>
                            <option value="Physical">Ability</option>
                            <option value="Augment">Augment</option>
                        </select>
                        <label>Element: </label><select name="element">
                            <option value="NULL"> </option>
                            <option value="Void">Void</option>
                            <option value="Space">Space</option>
                            <option value="Wind">Wind</option>
                            <option value="Ice">Ice</option>
                            <option value="Earth">Earth</option>
                            <option value="Moon">Moon</option>
                            <option value="Fire">Fire</option>
                            <option value="Water">Water</option>
                            <option value="Time">Time</option>
                            <option value="Flower">Flower</option>
                            <option value="Lightning">Lightning</option>
                        </select>
                        <label>Target Defense: </label><select name="target">
                            <option value="NULL"> </option>
                            <option value="AC">AC</option>
                            <option value="FORT">FORT</option>
                            <option value="REF">REF</option>
                            <option value="WILL">WILL</option>
                            <option value="Special">Special</option>
                        </select>
                        <label>Tree: </label><select name="tree">
                            <option value="NULL"> </option>
                            <option value="Power">Power</option>
                            <option value="Magic">Magic</option>
                            <option value="Speed">Speed</option>
                        </select>
                        <input type="hidden" name="action" value="filterAbility">
                        <input type="submit" value="filter">
                    </form>  
                </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
