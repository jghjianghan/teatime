<?php
    class Pesanan{
        protected $id;
        protected $jumlahPesanan;
        protected $namaTeh;
        public $topping = [];
        protected $ukuranGelas;
        protected $jumlahEs;
        protected $jumlahGula;

        public function __construct($id, $jumlahPesanan,$namaTeh,$ukuranGelas,$jumlahEs,$jumlahGula){
            $this->id = $id;
            $this->jumlahPesanan = $jumlahPesanan;
            $this->namaTeh = $namaTeh;
            $this->ukuranGelas = $ukuranGelas;
            $this->jumlahEs = $jumlahEs;
            $this->jumlahGula = $jumlahGula;
        }
        public function getId(){
            return $this->id;
        }
        public function getNamaTeh(){
            return $this->namaTeh;
        }public function getTopping(){
            return $this->topping;
        }public function getJumlahEs(){
            return $this->jumlahEs;
        }public function getJumlahGula(){
            return $this->jumlahGula;
        }public function getJumlahPesanan(){
            return $this->jumlahPesanan;
        }public function getUkuranGelas(){
            return $this->ukuranGelas;
        }

        public function addTopping($top,$jumlahtop){
            array_push($this->topping,new PairTransaksi($top,$jumlahtop));
        }
    }
?>