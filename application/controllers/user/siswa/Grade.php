<?php
defined("BASEPATH") OR exit("No Direct Script");

class Grade extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->req();
    }
    public function req(){
        $this->load->model("Mdsistemprofile");
        $where = array(
            "status_profile" => 0
        );
        $data = array(
            "profile" => $this->Mdsistemprofile->select($where)
        );
        $this->load->view("req/html-open");
        $this->load->view("req/head",$data);
        $this->load->view("user/siswa/menu");
        $this->load->view("req/content-container-open");
        $this->load->view("req/header-open");
        $this->load->view("req/logo",$data);
        $this->load->view("req/header-widget-open");
        $this->load->view("req/search");
        $this->load->view("req/message");
        $this->load->view("req/notifikasi");
        $this->load->view("req/header-widget-close");
        $this->load->view("req/profile");
        $this->load->view("req/header-close");
    }
    public function close(){
        
        $this->load->view("req/footer");
        $this->load->view("req/content-container-close");
        $this->load->view("req/html-close");
        $this->load->view("script/js-main");
    }
    
    /*akses menu*/
    
    public function index(){
        //$this->load->view("namapage/breadcrumb");
        $this->load->view("req/open-content");
        /* disini custom contentnya pake apapun yang dibutuhkan */
        $this->load->model("Mdmatapelajaran");
        
        $data = array(
            "matpel" => $this->Mdmatapelajaran->matpel()
        );
        $this->load->view("user/siswa/index3",$data);
        /* endnya disini */
        $this->load->view("req/close-content");
        $this->load->view("req/space");
        $this->close();
        $this->load->view("script/js-linechart");
        $this->load->view("script/js-datatable");
        $this->load->view("user/siswa/script/js-ajax-nilai");
    }
    
    /*end akses menu*/
    
}?>