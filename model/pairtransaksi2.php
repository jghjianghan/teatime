<?php
    class PairTransaksi2{
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