<?php 
require_once('ability.php');
$dsn = 'mysql:host=184.154.206.12;dbname=pidrawsc_khgame';
$username = 'pidrawsc_khadmin';
$password = 'qHbdc62MR34Tbjx';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}

function get_all_abilities() {
	global $db;
	
	$query = 'SELECT * FROM abilities';
	$statement=$db->prepare($query);
	$statement->execute();
	$abilityRow = $statement->fetchAll();
	$statement->closeCursor();
        
	$abilities = array();
	
	foreach($abilityRow as $ability){
		$ability;
                $tags = get_tags($ability['abl_id']);
		$abilities[$ability['abl_id']] = new ability(   $ability['abl_id'],
                                                            $ability['tree'],
                                                            $ability['tier'],
                                                            $ability['name'],
                                                            $tags,
                                                            $ability['mp_cost'],
                                                            $ability['abl_range'],
                                                            $ability['aoe'],
                                                            $ability['ac_tgt'],
                                                            $ability['ref_tgt'],
                                                            $ability['will_tgt'],
                                                            $ability['fort_tgt'],
                                                            $ability['damage_formula'],
                                                            $ability['flavortext'],
                                                            $ability['equipped']="NULL");
	}

	return $abilities;
}

function get_abilities_filter($tier, $classification, $element, $target, $tree){
    global $db;
    
        if ($tier === 'NULL' && $classification === 'NULL' && $element === 'NULL' && $target === 'NULL' && $tree === 'NULL'){
            header('Location: ./index.php?action=abilities');
        }
	 $filterString = "";
        if ($tier !== 'NULL') {
            $filterString .= 'tier = :tier';
        }
        if ($classification !== 'NULL') {
            if ($filterString !== ""){
                $filterString .= " AND ";
            }
            $filterString .= 'element1 = :classification';
        }
        if($element !== 'NULL') {
            if ($filterString !== ""){
                $filterString .= " AND ";
            }
            $filterString .= '(element2 = :element OR element3 = :element)';
        }
        
        if($target !== 'NULL'){
            if ($filterString !== ""){
                $filterString .= " AND ";
            }
            $filterString .= 'target = :target';
        }
        if($tree !== 'NULL'){
            if ($filterString !== ""){
                $filterString .= " AND ";
            }
            $filterString .= 'tree = :tree';
        }
    
        $query = 'SELECT * FROM abilities WHERE ' . $filterString;
	$statement = $db->prepare($query);
        if($tier !== 'NULL') {$statement->bindValue(':tier', $tier);}
        if($classification !== 'NULL'){$statement->bindValue(':classification', $classification);}
        if($element !== 'NULL') {$statement->bindValue(':element', $element);}
        if($target !== 'NULL'){$statement->bindValue(':target', $target);}
        if($tree !== 'NULL'){$statement->bindValue(':tree', $tree);}
        //return $statement;
	$statement->execute();
	$abilityRow = $statement->fetchAll();
	
	$abilities = array();
	
	foreach($abilityRow as $ability){
		$ability;
		$abilities[$ability['name']] = new ability($ability['tree'],
							   $ability['type'],
							   $ability['tier'],
							   $ability['name'],
							   $ability['element1'],
							   $ability['element2'],
							   $ability['element3'],
							   $ability['mp_cost'],
							   $ability['atkrange'],
							   $ability['aoe'],
							   $ability['target'],
							   $ability['damage'],
							   $ability['flavor'],
                                                           $ability['equipped'] = "NULL");
	}
	
	$statement->closeCursor();
	
	return $abilities;
}

function check_ability ($charName, $ablName){
    global $db;
    $query = 'SELECT * FROM character_ability
                WHERE character_name = :charName AND ability_name = :ablName ';
	$statement = $db->prepare($query);
        $statement->bindValue(':charName', $charName);
        $statement->bindValue(':ablName', $ablName);
	$statement->execute();
	$check = $statement->fetchAll();
        xdebug_break();
        $statement->closeCursor();
        $out = false;
        if(count($check) > 0){$out = true;}
        return $out;
}
function buy_ability($charName, $ablName){
    $messageOut = "You already know this ability!";
    
    if(check_ability($charName, $ablName)=== false){
       global $db; 
       
       $query = 'INSERT INTO character_ability
                (character_name, ability_name)
                VALUES (:charName, :ablName)';
	$statement = $db->prepare($query);
        $statement->bindValue(':charName', $charName);
        $statement->bindValue(':ablName', $ablName);
	$statement->execute();
        $statement->closeCursor();
        $messageOut = "Ability purchased.";
    }
    return $messageOut;
}

//add active ability to database
function add_ability(ability $newAbility){
    global $db;
    
    //insert 
    $query = 'INSERT INTO abilities (name, tree, tier, mp_cost, aoe, abl_range, damage_formula, flavortext, ac_tgt, ref_tgt, will_tgt, fort_tgt, ap_cost, lux_cost)
              VALUES (:name, :tree, :tier, :mp_cost, :aoe, :abl_range, :damage_formula, :flavortext, :ac_tgt, :ref_tgt, :will_tgt, :fort_tgt, :ap_cost, :lux_cost)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $newAbility->getName());
    $statement->bindValue(':tree', $newAbility->getTree());
    $statement->bindValue(':tier', $newAbility->getTier);
    $statement->bindValue(':mp_cost', $newAbility->getMp_cost);
    $statement->bindValue(':aoe', $newAbility->getAoe());
    $statement->bindValue(':abl_range', $newAbility->getAtkrange());
    $statement->bindValue(':ac_tgt', $newAbility->getAc_tgt());
    $statement->bindValue(':ref_tgt', $newAbility->getRef_tgt());
    $statement->bindValue(':will_tgt', $newAbility->getWill_tgt());
    $statement->bindValue(':fort_tgt', $newAbility->getFort_tgt());
    $statement->bindValue(':damage_formula', $newAbility->getDamage());
    $statement->bindValue(':flavortext', $newAbility->getFlavor());
    $statement->bindValue(':ap_cost', $newAbility->getAp_cost());
    $statement->bindValue(':lux_cost',$newAbility->getLux_cost());
    $statement->execute();
    $statement->closeCursor();
    
    $query2 = 'SELECT abl_id FROM abilities ORDER BY abl_id DESC LIMIT 0,1';
    $statement2 = $db->prepare($query2);
    $statement2->execute();
    $abl_id_raw = $statement2->fetchAll();
    $statement2->closeCursor();
    
    $abl_id = $abl_id_raw[0][0];
    foreach($tags as $tag){
        add_tag($tag, $abl_id);
    }
  
}

function add_augment($newAugment){
    
}



//**************************************TAG WRANGLING*************************************

//return a string-formatted list of all tag names associated with an ability
function get_tags($ability_id){
        global $db;
        
        $query = 'SELECT * FROM abl_tags_link WHERE abl_id = :ability_id' ;
	$statement=$db->prepare($query);
        $statement->bindValue(':ability_id', $ability_id);
	$statement->execute();
	$tagList = $statement->fetchAll();
	$statement->closeCursor();
        $tagGroup = array();
        foreach($tagList as $tag){
           array_push($tagGroup, get_tag_name($tag['tag_id']));
        }
        return implode(", ", $tagGroup);
}

//look up the name of a tag by tag id
function get_tag_name($tag_id){
            global $db;
            $tagQuery = 'SELECT tag_name FROM ability_tags WHERE tag_id = :tag_id';
            $statement=$db->prepare($tagQuery);
            $statement->bindValue(':tag_id', $tag_id);
            $statement->execute();
            $tagName = $statement->fetchAll();
            return $tagName[0]['tag_name'];
}

//get a list of all tag names and IDs
function get_tag_list(){
    global $db;
    
    $query = 'SELECT * FROM ability_tags';
    $statement=$db->prepare($query);
    $statement->execute();
    $taglist=$statement->fetchAll();
    $statement->closeCursor();
    
    return $taglist;
}

//add a tag to an ability
function add_tag($tag_id, $abl_id){
    global $db;
    $query = 'INSERT INTO abl_tags_link (abl_id, tag_id)
            VALUES (:abl_id, :tag_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':abl_id', $abl_id);
    $statement->bindValue(':tag_id', $tag_id);
    $statement->execute();
    $statement->closeCursor();
            
}

?>