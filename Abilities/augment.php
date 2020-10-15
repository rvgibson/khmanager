<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of augment
 *
 * @author thepi
 */
class augment {
     private $id;
	private $tree;
	private $tier;
	private $name;
	private $tags;
	private $mp_cost;
	private $aoe;
	private $boost_stat;
        private $boost_amt;
	private $flavor;
        private $ap_cost;
        private $lux_cost;
        private $equipped;
        
        function __construct($id, $tree, $tier, $name, $tags, $mp_cost, $aoe, $boost_stat, $boost_amt, $flavor, $ap_cost, $lux_cost, $equipped) {
            $this->id = $id;
            $this->tree = $tree;
            $this->tier = $tier;
            $this->name = $name;
            $this->tags = $tags;
            $this->mp_cost = $mp_cost;
            $this->aoe = $aoe;
            $this->boost_stat = $boost_stat;
            $this->boost_amt = $boost_amt;
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

        function getAoe() {
            return $this->aoe;
        }

        function getBoost_stat() {
            return $this->boost_stat;
        }

        function getBoost_amt() {
            return $this->boost_amt;
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

        function setAoe($aoe) {
            $this->aoe = $aoe;
        }

        function setBoost_stat($boost_stat) {
            $this->boost_stat = $boost_stat;
        }

        function setBoost_amt($boost_amt) {
            $this->boost_amt = $boost_amt;
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
