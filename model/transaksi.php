<?php
    class Transaksi{
        protected $kode;
        protected $waktu;
        protected $totalHarga;
        protected $namaPemesan;
        protected $email;

        public function __construct($kode,$waktu,$totalHarga,$namaPemesan,$email){
            $this->kode = $kode;
            $this->waktu = $waktu;
            $this->totalHarga = $totalHarga;
            $this->namaPemesan = $namaPemesan;
            $this->email = $email;
        }

        public function getKode(){
            return $this->id;
        }public function getWaktu(){
            return $this->gambar;
        }public function getTotalHarga(){
            return $this->nama;
        }public function getNamaPemesan(){
            return $this->harga;
        }public function getEmail(){
            return $this->email;
        }
    }
?>