<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
<?php
require_once('Abilities/ability_db.php');
//require_once('Characters/character_db.php');
//require_once('Items/item_db.php');
//require_once('Characters/character.php');
//require_once('Characters/sheet_functions.php');
//require_once('Users/user.php');
//require_once('validate.php');

session_start();
if (!isset($_SESSION['loginToken'])) {
    $_SESSION['loginToken'] = false;
}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'main';
    }
}

switch ($action) {
	case 'main':
		include_once('main.html');
		break;
//********************************ABILITY MANAGEMENT**********************************		
	case 'abilities':
//                $_SESSION['List'] = get_all_characters();
//                $characterSelect = filter_input(INPUT_GET, 'character');
//                if(isset($characterSelect) && $characterSelect !== 'null'){$_SESSION['ActiveCharacter'] = $_SESSION['List']["$characterSelect"];}
//                if(isset($_SESSION['ActiveCharacter'])){$activeCharacter =  $_SESSION['ActiveCharacter'];
//                                        $abilitiesEquipped = get_abilities_equipped($activeCharacter->getChar_name());
//                }
		$_SESSION['Ability_list']=get_all_abilities();
		include('Abilities/abilities.php');
		break;
        
        case 'filterAbility':
            $name = filter_input(INPUT_POST, 'abl_name');
            $tree = filter_input(INPUT_POST, 'abl_tree');
            $tier = filter_input(INPUT_POST, 'abl_tier');
            $atkrange = filter_input(INPUT_POST, 'atk_range');
            $aoe = filter_input(INPUT_POST, 'aoe');
            $mp_cost = filter_input(INPUT_POST, 'mp_cost');
            $damage = filter_input(INPUT_POST, 'dmg_formula');
            $_SESSION['Ability_list'] = get_abilities_filter( $tier, $classification, $element, $target, $tree);
            include('Abilities/abilities.php');
            break;
        
        case 'add_abl': 
            $name = filter_input(INPUT_POST, 'abl_name');
            $tree = filter_input(INPUT_POST, 'abl_tree');
            $tier = filter_input(INPUT_POST, 'abl_tier');
            $atkrange = filter_input(INPUT_POST, 'atk_range');
            $aoe = filter_input(INPUT_POST, 'aoe');
            $mp_cost = filter_input(INPUT_POST, 'mp_cost');
            $damage = filter_input(INPUT_POST, 'dmg_formula');
            $ap_cost = filter_input(INPUT_POST, 'ap_cost');
            $lux_cost = filter_input(INPUT_POST, 'lux_cost');
            $tags = $_POST['tag_list'];
            if(isset($_POST['ac_tgt'])){$ac_tgt = 1;}
                else {$ac_tgt = 0;}
            if(isset($_POST['ref_tgt'])){$ref_tgt = 1;}
                else {$ref_tgt = 0;}
            if(isset($_POST['will_tgt'])){$will_tgt = 1;}
                else {$will_tgt = 0;}
            if(isset($_POST['fort_tgt'])){$fort_tgt = 1;}
                else {$fort_tgt = 0;}
            $flavor = filter_input(INPUT_POST, 'abilityDesc');
            $newAbility = new ability(0, $tree, $tier, $name, $tags, $mp_cost, $atkrange, $aoe, $ac_tgt, $ref_tgt, $will_tgt, $fort_tgt, $damage, $flavor, $ap_cost, $lux_cost, 0);
            add_ability($newAbility);
            include_once('add_ability.php');
            break;
        
        case 'add_aug':
           $name = filter_input(INPUT_POST, 'abl_name');
            $tree = filter_input(INPUT_POST, 'abl_tree');
            $tier = filter_input(INPUT_POST, 'abl_tier');
            $aoe = filter_input(INPUT_POST, 'aoe');
            $mp_cost = filter_input(INPUT_POST, 'mp_cost');
            $tags = $_POST['tag_list'];
            $boost_stat = filter_input(INPUT_POST, 'boost_stat');
            $boost_amt = filter_input(INPUT_POST, 'boost_amt');
            $ap_cost = filter_input(INPUT_POST, 'ap_cost');
            $lux_cost = filter_input(INPUT_POST, 'lux_cost');
            $flavor = filter_input(INPUT_POST, 'abilityDesc');
            $newAugument = new augment(0, $tree, $tier, $name, $tags, $mp_cost, $aoe, $boost_stat, $boost_amt, $flavor, $ap_cost, $lux_cost, 0);
            add_augment($newAugment);
            include_once('add_augment.php');
            break;


//***************************CHARACTER SHEET MANAGEMENT ******************************	
        case 'buyAbility':
            $name = filter_input(INPUT_POST, 'charName');
            $ablName = filter_input(INPUT_POST, 'ablName');
            buy_ability($name, $ablName);
            header('Location: index.php?action=abilities');
            break;
            
	case 'party':
          $_SESSION['party_list'] = get_all_characters();
           include('Characters/party.php');
	break;
    
        case 'newCharacter':
            break;
	
	case 'sheets':
                $mode = filter_input(INPUT_GET, 'mode');
                if(!isset($mode)){$mode='edit';}
                $characterSelect = filter_input(INPUT_GET, 'character');
                $_SESSION['List'] = get_all_characters();
                $activeCharacter =  $_SESSION['List']["$characterSelect"];
                $_SESSION['ActiveCharacter'] = $activeCharacter;
                $activeCharName = $activeCharacter->getChar_name();
                $skills = get_character_skills($activeCharName);
                $abilitiesList = get_abilities_by_character($activeCharName);
                $abilitiesEquipped = get_abilities_equipped($activeCharName);
                $equipment = get_equipment($activeCharName);
                $inventory = get_item_by_type("con");
                $calcStats =  calc_stats_out($activeCharacter);
                //$allEquipment = get_item_by_type("acc");
                $maxlife_stats = $activeCharacter->calc_life();
                $maxMP_stats = $activeCharacter->calc_mp();
                $maxAP_stats = $activeCharacter->calc_ap();
                if(empty($_SESSION[$activeCharName]['currentLife'])  || !isset($_SESSION[$activeCharName]['currentLife'])){$_SESSION[$activeCharName]['currentLife'] = $maxlife_stats;}
                if(empty($_SESSION[$activeCharName]['currentMP']) || !isset($_SESSION[$activeCharName]['currentMP'])) {$_SESSION[$activeCharName]['currentMP'] = $maxMP_stats;}
                if(empty($_SESSION[$activeCharName]['currentFocus']) || !isset($_SESSION[$activeCharName]['currentFocus'])){$_SESSION[$activeCharName]['currentFocus'] = "0";}
                $defense = $activeCharacter->active_def();
		include("Characters/sheets.php");
		break;
        
        case 'updateCharacter':
            $name = filter_input(INPUT_POST, 'name');
            $activeCharacter =  $_SESSION['List']["$name"];
            $might = filter_input(INPUT_POST, 'might', FILTER_VALIDATE_INT, array("options"=> array("default"=>$activeCharacter->getMight(),"min_range"=>0, "max_range" => 12)));
            $agility = filter_input(INPUT_POST, 'agility', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getAgility(),"min_range"=>0, "max_range" => 10))); 
            $con = filter_input(INPUT_POST, 'con', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getCon(),"min_range"=>0, "max_range" => 10)));
            $skill = filter_input(INPUT_POST, 'skill', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getSkill(),"min_range"=>0, "max_range" => 10))); 
            $spirit = filter_input(INPUT_POST, 'spirit', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getSpirit(),"min_range"=>0, "max_range" => 10))); 
            $luck = filter_input(INPUT_POST, 'luck', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getLuck(),"min_range"=>0, "max_range" => 10))); 
            $life = filter_input(INPUT_POST, 'life', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getLife(),"min_range"=>0, "max_range" => $con))); 
            $MP = filter_input(INPUT_POST, 'mp', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getMp(),"min_range"=>0, "max_range" => $spirit))); 
            $init = filter_input(INPUT_POST, 'init', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getInit(),"min_range"=>0, "max_range" => $agility)));
            $AP = filter_input(INPUT_POST, 'ap', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getAp(),"min_range"=>0, "max_range" => $skill)));
            $AC = filter_input(INPUT_POST, 'ac', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getAc(),"min_range"=>0, "max_range" => $luck)));
            $fort = filter_input(INPUT_POST, 'fort', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getFort(),"min_range"=>0, "max_range" => $con)));
            $ref = filter_input(INPUT_POST, 'ref', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getRef(),"min_range"=>0, "max_range" => $agility)));
            $will = filter_input(INPUT_POST, 'will',FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getWill(),"min_range"=>0, "max_range" => $spirit)));
            $tohit = filter_input(INPUT_POST, 'tohit', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getTohit(),"min_range"=>0, "max_range" => $skill)));
            $lucky = filter_input(INPUT_POST, 'lucky', FILTER_VALIDATE_INT, array("options" => array("default"=>$activeCharacter->getLucky(),"min_range"=>0, "max_range" => $luck)));
            $ablEquipped = $_POST['ablEquipped']; 
                if (isset($ablEquipped) && !empty($ablEquipped)){
                    unequip_all_abl($name);
                    foreach ($ablEquipped as $abl){
                    update_abilities_equipped($name, $abl, "1");
                    }
                }
//            $itemEquip = filter_input(INPUT_POST, 'itmEquip');
//            if($itemEquip !== 'NULL'){
//                            update_equipment($name, $itemEquip);
//                }
            update_pskills($might, $agility, $con, $skill, $spirit, $luck, $name);
            update_sskills($life, $MP, $init, $AP, $AC, $fort, $ref, $will, $tohit, $lucky, $name);
            header("Location: ./index.php?action=sheets&character=$name&mode=edit");
            break;
        
    
//**********************ITEM MANAGEMENT****************************************
	case 'items':
            $_SESSION['stock_list'] = get_all_items();
            $inventory = get_inventory();
            $munny = get_munny();
            $_SESSION['munny'] = $munny[0][1];
            include('Items/items.php');
		break;
       
        case 'buyItem':
            $itemID = filter_input(INPUT_POST, 'itemID');
            $itemCost = filter_input(INPUT_POST, 'itemCost');
            if ($itemCost <= $_SESSION['munny']){buy_item($itemID);
            cash_out($itemCost);}
            else {
               $error = "Not enough munny!"; 
            }
            header('Location: ./index.php?action=items');
            break;
        
        case 'enemies':
            include('enemies.html');
            break;
        
        case 'combat':
            $name = filter_input(INPUT_POST, 'name');
            $maxLife = filter_input(INPUT_POST, 'maxLife');
            $maxMP = filter_input(INPUT_POST, 'maxMP');
            $_SESSION[$name]['currentLife'] = filter_input(INPUT_POST, 'curLife', FILTER_VALIDATE_INT, array("options" => array("default"=>$_SESSION[$name]['currentLife'],"min_range"=>0)));
            if ($_SESSION[$name]['currentLife'] > $maxLife){ $_SESSION[$name]['currentLife'] = $maxLife;}
            $_SESSION[$name]['currentMP'] = filter_input(INPUT_POST, 'curMP', FILTER_VALIDATE_INT, array("options" => array("default"=>$_SESSION[$name]['currentMP'],"min_range"=>0)));
            if ($_SESSION[$name]['currentMP'] > $maxMP){$_SESSION[$name]['currentMP'] = $maxMP;}
            $_SESSION[$name]['currentFocus'] = filter_input(INPUT_POST, 'curFocus', FILTER_VALIDATE_INT, array("options" => array("default"=>$_SESSION[$name]['currentFocus'],"min_range"=>0)));
            $_SESSION[$name]['currentFocus']+= 2;
            if($_SESSION[$name]['currentFocus'] > 20){$_SESSION[$name]['currentFocus'] = 20;}
            if(isset($_SESSION[$name]['regenCounter'])){$_SESSION[$name]['regenCounter']--;} 
            header("Location: ./index.php?action=sheets&character=$name&mode=combat");
            break;
        
        case 'useItem':
        $name = filter_input(INPUT_POST, 'name');
        $itemUsed = filter_input(INPUT_POST, 'itemID');
        $maxLife = filter_input(INPUT_POST, 'maxLife');
            switch ($itemUsed):
                case '1':
                if($_SESSION[$name]['currentLife'] < $maxLife){use_item($itemUsed);
                                                               $_SESSION[$name]['currentLife'] = intval($_SESSION[$name]['currentLife'] ) + 10;}
                if($_SESSION[$name]['currentLife'] >= $maxLife){$_SESSION[$name]['currentLife'] = $maxLife;}
                break;
            
                case '2':
                if($_SESSION[$name]['currentLife'] < $maxLife){use_item($itemUsed);
                                                                $_SESSION[$name]['currentLife'] = intval($_SESSION[$name]['currentLife'] ) + 20;}
                if($_SESSION[$name]['currentLife'] >= $maxLife){$_SESSION[$name]['currentLife'] = $maxLife;}
                break;
            
                 case '3':
                $_SESSION[$name]['regenCounter'] = 4;
                use_item($itemUsed);
                break;
            
                 case '4':
                if($_SESSION[$name]['currentLife'] < $maxLife){use_item($itemUsed);
                                                                $_SESSION[$name]['currentLife'] = intval($_SESSION[$name]['currentLife']) + 30;}
                if($_SESSION[$name]['currentLife'] >= $maxLife){$_SESSION[$name]['currentLife'] = $maxLife;}
                break;
                
                case '5':
                use_item($itemUsed);
            endswitch;
            header("Location: ./index.php?action=sheets&character=$name&mode=combat");
            break;
        
 //login/register logic
        
                case 'gotoregister':
                    include ('Users/registration.php');
                    exit();
                    break;
            
                case 'gotologin':
                    include ('Users/login.php');
                    exit();
                    break;
        
                 case 'registerUser':    
                $email = filter_input(INPUT_POST, 'email');
                $userName = filter_input(INPUT_POST, 'userName');
                $password = filter_input(INPUT_POST, 'password');
                $errorMessage = validate::isUserValid($userName, $email, $password);
                if ($errorMessage !== '') {
                    $error = $errorMessage;
                    include 'Users/registration.php';
                } else {
                    $thepassword = user::securePassword($password);
                    $user = new user($email, $userName, $thepassword);
                    $user = add_user($user);
                    // log the user in after successful registration
                    $currentUser = get_user($userName);
                    $_SESSION['CurrentUser'] = $currentUser;
                    $viewedUser = $currentUser;
                    $_SESSION['loginToken'] = true;
                     header('Location: index.php?action=party');
                }
                die();
                break;
                
                case 'loginUser':
                $userName = filter_input(INPUT_POST, 'userName');
                $password = filter_input(INPUT_POST, 'password');
                $currentUser = get_user($userName);
                xdebug_break();
                $checkPassword = $currentUser->getPassword();
                if (password_verify($password, $checkPassword)) {
                    $_SESSION['CurrentUser'] = $currentUser;
                    $_SESSION['loginToken'] = true;
                    //include './profile.php';
                    header('Location: index.php?action=party');
                } else {
                    $loginError = 'Incorrect login information';
                    include('Users/login.php');
                }
                die();
                break;
                
                case 'logout':
                session_unset();
                header('Location: index.php?action=main');
                break;
                case 'newChar':
                    //this got incredibly messy -- to be implemented later
                    break;
}

?>