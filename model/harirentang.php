<?php
    class HariRentang{
        public $teh = [];
        public $topping = [];
        protected $waktu;

        public function __construct($waktu){
            $this->waktu = $waktu;
        }

        public function getTeh(){
            return $this->teh;
        }
        public function getTopping(){
            return $this->topping;
        }
        public function getWaktu(){
            return $this->waktu;
        }

        public function addTopping($top,$jumlahtop){
            array_push($this->topping,new PairTransaksi($top,$jumlahtop));
        }

        public function addTeh($teh,$jumlahteh){
            array_push($this->teh,new PairTransaksi2($teh,$jumlahteh));
        }
    }
?>