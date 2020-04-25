<?php
    class Topping{
        protected $id;
        protected $gambar;
        protected $nama;
        protected $harga;

        public function __construct($id,$gambar,$nama,$harga){
            $this->id = $id;
            $this->gambar = $gambar;
            $this->nama = $nama;
            $this->harga = $harga;
        }

        public function getId(){
            return $this->id;
        }public function getGambar(){
            return $this->gambar;
        }public function getNama(){
            return $this->nama;
        }public function getHarga(){
            return $this->harga;
        }
    }
?>