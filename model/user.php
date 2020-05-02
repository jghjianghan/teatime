<?php
    class User{
        protected $id;
        protected $posisi;
        protected $email;
        protected $nama;
        protected $ttl;
        protected $alamat;

        public function __construct($posisi,$email,$nama,$ttl,$alamat,$id){
            $this->id = $id;
            $this->posisi = $posisi;
            $this->email = $email;
            $this->nama = $nama;
            $this->ttl = $ttl;
            $this->alamat = $alamat;
        }

        public function getId(){
            return $this->id;
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
