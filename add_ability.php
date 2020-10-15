<?php
require_once('./Abilities/ability_db.php');
require_once('./Abilities/ability.php');
$taglist = get_tag_list();
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
            <div class="container">
                <h2>Add Active Ability</h2>
                
                <form action="index.php" method='POST'>
                    <div class="form-row">
                        <div class="col-6">
                    <label>Ability Name</label>
                    <input type="text" class="form-control" id="abl_name" name="abl_name">
                    </div>
                    
                    <div class="col">
           
                    <label>Tree </label> <select name="abl_tree" id="abl_tree" class="form-control">
                            <option value="NULL"> </option>
                            <option value="Power">Power</option>
                            <option value="Magic">Magic</option>
                            <option value="Speed">Speed</option>
                            <option value="Heart">Heart</option>
                        </select>
                    </div>
                    <div class="col">
                    <label>Tier </label> <select name="abl_tier" id="abl_tier" class="form-control">
                            <option value="NULL"> </option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option></select>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="col">
                    <label>Range </label> 
                    <input type="text" class="form-control" id="atk_range" name="atk_range">
                    </div>
                    <div class="col">
                    <label>AoE </label>
                    <input type="text" class="form-control" id="aoe" name="aoe">
                    </div>
                    <div class="col">
                    <label>MP Cost </label>
                    <input type="text" class="form-control" id="mp_cost" name="mp_cost">
                    </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                        <label>Damage Formula </label> <input type="text" class="form-control" id="dmg_formula" name="dmg_formula">
                    </div>
                        <div class="col">
                            <label>Target Defense </label><br/> 
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="ac_tgt" name="ac_tgt[]" value="1" class="form-check-input"><label class="form-check-label">AC</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="ref_tgt" name="ref_tgt[]" value="1" class="form-check-input"><label class="form-check-label">REF</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="fort_tgt" name="fort_tgt[]" value="1" class="form-check-input"><label class="form-check-label">FORT</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="awill_tgt" name="will_tgt[]" value="1" class="form-check-input"><label class="form-check-label">WILL</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label>Tags: </label><br/> 
                    <?php foreach($taglist as $tag){
                        $tagid = $tag[0];
                        $tagText = $tag[1]; ?>
                     <div class="form-check form-check-inline">
    <input type="checkbox" class="form-check-input" name="tag_list[]" value="<?php echo $tagid;?>" id="tagslist">
    <label class="form-check-label" for="<?php echo $tagText;?>"><?php echo $tagText;?></label>
                    </div><?php };?>
                    </div>
                    <div class="form-group">
                        <label>Description: </label> <textarea class="form-control" rows="5" id="abilityDescription" name="abilityDesc"></textarea>
                    </div>
                    <input type="hidden" name="action" value="add_abl">
                        <input type="submit" value="Add Ability">
                </form>
            </div> 
         
            
                <div id="last_ability_added"></div>
            
       
         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
    </body>
</html>
