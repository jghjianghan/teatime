<?php
    class PairTransaksi{
        protected $namaTopping;
        protected $jumlahTopping;

        public function __construct($namaTopping, $jumlahTopping){
            $this->namaTopping = $namaTopping;
            $this->jumlahTopping = $jumlahTopping;
        }

        public function getNamaTopping(){
            return $this->namaTeh;
        }
        public function getJumlahTopping(){
            return $this->jumlahPesanan;
        }
    }
?>
