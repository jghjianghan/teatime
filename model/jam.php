<?php
    class Jam{
        protected $jam;
        protected $total;

        public function __construct($jam){
            $this->jam = $jam;
        }

        public function getJam(){
            return $this->jam;
        }

        public function addTrans($total){
            $this->total = $total;
        }
    }
?>