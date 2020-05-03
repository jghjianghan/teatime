<?php
    class Kasir{
        protected $waktu;
        protected $namaKasir;
        protected $jumlahHarga;

        public function __construct($waktu, $namaKasir, $jumlahHarga){
            $this->waktu = $waktu;
            $this->namaKasir = $namaKasir;
            $this->jumlahHarga = $jumlahHarga;
        }

        public function getWaktu(){
            return $this->waktu;
        }
        public function getNamaKasir(){
            return $this->namaKasir;
        }
        public function getJumlahHarga(){
            return $this->jumlahHarga;
        }
    }
?>