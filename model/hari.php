<?php
    class Hari{
        public $jam = [];
        protected $waktu;

        public function __construct($waktu){
            $this->waktu = $waktu;
        }

        public function getJam(){
            return $this->jam;
        }
        public function getWaktu(){
            return $this->waktu;
        }

        public function addJam($time){
            $this->jam[$time->getJam()] = $time;
        }
    }
?>