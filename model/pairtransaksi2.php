<?php
    class PairTransaksi2{ //Untuk pair dari teh dan jumlahnya
        protected $namaTeh;
        protected $jumlahTeh;

        public function __construct($namaTeh, $jumlahTeh){
            $this->namaTeh = $namaTeh;
            $this->jumlahTeh = $jumlahTeh;
        }

        public function getNamaTeh(){
            return $this->namaTeh;
        }
        public function getJumlahTeh(){
            return $this->jumlahTeh;
        }
    }
?>