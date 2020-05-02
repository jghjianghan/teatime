<?php
    class Transaksi{
        protected $kode;
        protected $waktu;
        protected $totalHarga;
        public $pesanan = [];
        protected $namaPemesan;
        protected $namaKasir;

        public function __construct($kode,$waktu,$totalHarga,$namaPemesan,$namaKasir){
            $this->kode = $kode;
            $this->waktu = $waktu;
            $this->totalHarga = $totalHarga;
            $this->namaPemesan = $namaPemesan;
            $this->namaKasir = $namaKasir;
        }

        public function getKode(){
            return $this->kode;
        }public function getWaktu(){
            return $this->waktu;
        }public function getTotalHarga(){
            return $this->totalHarga;
        }public function getNamaPemesan(){
            return $this->namaPemesan;
        }public function getNamaKasir(){
            return $this->namaKasir;
        }public function getPesanan(){
            return $this->pesanan;
        }

        public function addPesanan($pesanan2){
            array_push($this->pesanan, $pesanan2);
        }
    }
?>