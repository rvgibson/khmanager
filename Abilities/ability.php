<?php 

class ability {
        private $id;
	private $tree;
	private $tier;
	private $name;
	private $tags;
	private $mp_cost;
	private $atkrange;
	private $aoe;
	private $ac_tgt;
        private $ref_tgt;
        private $will_tgt;
        private $fort_tgt;
	private $damage;
	private $flavor;
        private $ap_cost;
        private $lux_cost;
        private $equipped;
	
	function __construct($id, $tree, $tier, $name, $tags, $mp_cost, $atkrange, $aoe, $ac_tgt, $ref_tgt, $will_tgt, $fort_tgt, $damage, $flavor, $ap_cost, $lux_cost, $equipped) {
            $this->id = $id;
            $this->tree = $tree;
            $this->tier = $tier;
            $this->name = $name;
            $this->tags = $tags;
            $this->mp_cost = $mp_cost;
            $this->atkrange = $atkrange;
            $this->aoe = $aoe;
            $this->ac_tgt = $ac_tgt;
            $this->ref_tgt = $ref_tgt;
            $this->will_tgt = $will_tgt;
            $this->fort_tgt = $fort_tgt;
            $this->damage = $damage;
            $this->flavor = $flavor;
            $this->ap_cost = $ap_cost;
            $this->lux_cost = $lux_cost;
            $this->equipped = $equipped;
        }
        function getId() {
            return $this->id;
        }

        function getTree() {
            return $this->tree;
        }

        function getTier() {
            return $this->tier;
        }

        function getName() {
            return $this->name;
        }

        function getTags() {
            return $this->tags;
        }

        function getMp_cost() {
            return $this->mp_cost;
        }

        function getAtkrange() {
            return $this->atkrange;
        }

        function getAoe() {
            return $this->aoe;
        }

        function getAc_tgt() {
            return $this->ac_tgt;
        }

        function getRef_tgt() {
            return $this->ref_tgt;
        }

        function getWill_tgt() {
            return $this->will_tgt;
        }

        function getFort_tgt() {
            return $this->fort_tgt;
        }

        function getDamage() {
            return $this->damage;
        }

        function getFlavor() {
            return $this->flavor;
        }

        function getAp_cost() {
            return $this->ap_cost;
        }

        function getLux_cost() {
            return $this->lux_cost;
        }

        function getEquipped() {
            return $this->equipped;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setTree($tree) {
            $this->tree = $tree;
        }

        function setTier($tier) {
            $this->tier = $tier;
        }

        function setName($name) {
            $this->name = $name;
        }

        function setTags($tags) {
            $this->tags = $tags;
        }

        function setMp_cost($mp_cost) {
            $this->mp_cost = $mp_cost;
        }

        function setAtkrange($atkrange) {
            $this->atkrange = $atkrange;
        }

        function setAoe($aoe) {
            $this->aoe = $aoe;
        }

        function setAc_tgt($ac_tgt) {
            $this->ac_tgt = $ac_tgt;
        }

        function setRef_tgt($ref_tgt) {
            $this->ref_tgt = $ref_tgt;
        }

        function setWill_tgt($will_tgt) {
            $this->will_tgt = $will_tgt;
        }

        function setFort_tgt($fort_tgt) {
            $this->fort_tgt = $fort_tgt;
        }

        function setDamage($damage) {
            $this->damage = $damage;
        }

        function setFlavor($flavor) {
            $this->flavor = $flavor;
        }

        function setAp_cost($ap_cost) {
            $this->ap_cost = $ap_cost;
        }

        function setLux_cost($lux_cost) {
            $this->lux_cost = $lux_cost;
        }

        function setEquipped($equipped) {
            $this->equipped = $equipped;
        }

}
?>