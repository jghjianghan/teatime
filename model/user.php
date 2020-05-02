<?php
    class User{
        protected $posisi;
        protected $email;
        protected $nama;
        protected $ttl;
        protected $alamat;

        public function __construct($posisi,$email,$nama,$ttl,$alamat){
            $this->posisi = $posisi;
            $this->email = $email;
            $this->nama = $nama;
            $this->ttl = $ttl;
            $this->alamat = $alamat;
        }

        public function getPosisi(){
            return $this->posisi;
        }public function getEmail(){
            return $this->email;
        }public function getNama(){
            return $this->nama;
        }public function getTtl(){
            return date_format(date_create($this->ttl), "d F Y");
        }public function getAlamat(){
            return $this->alamat;
        }
    }
?>
