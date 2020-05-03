<?php
    class Keuangan{
        protected $waktu;
        protected $jumlahHarga;

        public function __construct($waktu,$jumlahHarga){
            $this->waktu = $waktu;
            $this->jumlahHarga = $jumlahHarga;
        }

        public function getwaktu(){
            return $this->waktu;
        }
        public function getJumlahHarga(){
            return $this->jumlahHarga;
        }
    }
