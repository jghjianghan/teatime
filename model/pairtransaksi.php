<?php
    class PairTransaksi{ //Untuk pair dari topping dengan jumlahnya
        protected $namaTopping;
        protected $jumlahTopping;

        public function __construct($namaTopping, $jumlahTopping){
            $this->namaTopping = $namaTopping;
            $this->jumlahTopping = $jumlahTopping;
        }

        public function getNamaTopping(){
            return $this->namaTopping;
        }
        public function getJumlahTopping(){
            return $this->jumlahTopping;
        }
    }
