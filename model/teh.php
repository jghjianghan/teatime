<?php
    class Teh{
        protected $id;
        protected $gambar;
        protected $nama;
        protected $hargaRegular;
        protected $hargaLarge;

        public function __construct($id,$gambar,$nama,$hargaRegular,$hargaLarge){
            $this->id = $id;
            $this->gambar = $gambar;
            $this->nama = $nama;
            $this->hargaRegular = $hargaRegular;
            $this->hargaLarge = $hargaLarge;
        }

        public function getId(){
            return $this->id;
        }public function getGambar(){
            return $this->gambar;
        }public function getNama(){
            return $this->nama;
        }public function getHargaRegular(){
            return $this->hargaRegular;
        }public function getHargaLarge(){
            return $this->hargaLarge;
        }
    }
?>