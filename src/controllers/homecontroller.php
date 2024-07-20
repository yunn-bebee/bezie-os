<?php
class HomeController {
    private function addDelay() {
        sleep(0.6); // Delay for 2 seconds
    }
    public function index() {
        $this -> addDelay();
        require 'src/views/home.php';
    }

    public function about() {
        $this -> addDelay();
        require 'src/views/about.php';
    }

    public function contact() {
        $this -> addDelay();
        require 'src/views/contact.php';
    }
    public function gallery(){
        $this -> addDelay();
        require 'src/views/gallery.php';
    }
    public function gameintro(){
        $this -> addDelay();
        require 'src/views/gameintro.php';
    }
    public function login(){
        $this -> addDelay();
        require 'src/views/login.php';
    }
    public function signup(){
        $this -> addDelay();
        require 'src/views/signup.php';
    }
    
    
   
    public function error(){
        $this -> addDelay();
        require 'src/views/errors.php';
    }
    public function showDictionaryPage() {
        $this -> addDelay();
        require 'src\views\user\child\dictonary.php';
    }
    public function h() {
        $this -> addDelay();
        require 'src\views\user\child\h.php';
    }
}
