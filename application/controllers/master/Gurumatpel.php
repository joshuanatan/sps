
<?php
//manage matpel<?php
defined("BASEPATH") OR exit("No Direct Script");

class Gurumatpel extends CI_Controller{
    public function session_check(){
        if($this->session->id_user == ""){
            redirect("login");

        }
        if($this->session->tahunajaran == ""){
            redirect("user/".$this->session->role."/index");
        }
        /*
        $this->session_check();
        */
    }
    public function __construct(){
        parent::__construct();
        $this->req();
        $this->load->model(array("Mduser","Mdmatapelajaran"));
    }
    public function req(){
        $this->load->model("Mdsistemprofile");
        $where = array(
            "status_profile" => 0
        );
        $data = array(
            "profile" => $this->Mdsistemprofile->select($where)
        );
        $this->session_check();

        $this->load->view("req/html-open");
        $this->load->view("req/head",$data);
        $this->load->view("user/akademik/menu");
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
        $this->session_check();
        
        $this->load->view("req/footer");
        $this->load->view("req/content-container-close");
        $this->load->view("req/html-close");
        $this->load->view("script/js-main");
    }
    public function index(){
        $this->session_check();

        if($this->session->idgurupilihkelas != ""){
            redirect("master/gurumatpel/jurusanterpilih/".$this->session->pilihjurusan);
        }
        $where = array(
            "id_tahun_ajaran" => $this->session->tahunajaran,
            //"id_guru" => $this->session->idgurupilihkelas
        );  
        $where2 = array(
            "penugasan_guru.id_gurutahunan" => $this->session->idgurupilihkelas,
            "kelas.id_tahun_ajaran" => $this->session->tahunajaran
        );
        $where3 = array(
            "id_tahun_ajaran" => $this->session->tahunajaran
        );
        
        $this->load->model("Mdgurutahunan");
        $this->load->model("Mdkelas");
        $this->load->model("Mdgurumatapelajaran");
        $this->load->view("req/open-content");
        /* disini custom contentnya pake apapun yang dibutuhkan */
        
        if($this->session->idgurupilihkelas == "") {
            $data = array(
                "guru" => $this->Mdgurutahunan->select2($where3)->result(),
                "assigned" => $this->Mdgurumatapelajaran->assigned2($where2)->result(),
                "notassigned" => $this->Mdgurumatapelajaran->status2($where)->result()
            );
        }
        
        else { 
            $data = array(
                "guru" => $this->Mdgurutahunan->select2($where3)->result(),
                "assigned" => $this->Mdgurumatapelajaran->assigned($where2)->result(),
                "notassigned" => $this->Mdgurumatapelajaran->status($where)->result()
            );
        }
        $this->load->view("user/akademik/gurumatpel",$data);
        /* endnya disini */
        $this->load->view("req/close-content");
        $this->load->view("req/space");
        $this->close();
        $this->load->view("script/js-calender");
        $this->load->view("script/js-datatable");
    }
    public function ubahguru(){
        $this->session_check();

        $this->load->model("Mdgurutahunan");
        $this->load->model("Mdkelas");
        $this->session->idgurupilihkelas = $this->input->post("guru");
        $where = array(
            "guru_tahunan.id_gurutahunan" => $this->input->post("guru")
        );
        $data = $this->Mdgurutahunan->select2($where)->result();
        foreach($data as $a){
            $jenisjurusan = $a->jenis_matpel;
        }
        redirect("master/gurumatpel/jurusanterpilih/".$jenisjurusan);
    }
    public function jurusanterpilih($jenisjurusan){
        $this->session_check();
        
        switch($jenisjurusan){
            case "IPA":
                $this->session->pilihjurusan = "IPA";
                $where = array(
                    "kelas.jurusan" => "IPA",
                    "id_tahun_ajaran" => $this->session->tahunajaran,
                    //"id_guru" => $this->session->idgurupilihkelas
                );  
                break;
            case "IPS":
                
                $this->session->pilihjurusan = "IPS";
                $where = array(
                    "kelas.jurusan" => "IPS",
                    "id_tahun_ajaran" => $this->session->tahunajaran,
                    //"id_guru" => $this->session->idgurupilihkelas
                );  
                break;
            case "UMUM":
                
                $this->session->pilihjurusan = "UMUM";
                $where = array(
                    "id_tahun_ajaran" => $this->session->tahunajaran,
                    //"id_guru" => $this->session->idgurupilihkelas
                );  
                break;
        }
        $where2 = array(
            "penugasan_guru.id_gurutahunan" => $this->session->idgurupilihkelas,
            "kelas.id_tahun_ajaran" => $this->session->tahunajaran
        );
        $where3 = array(
            "id_tahun_ajaran" => $this->session->tahunajaran
        );
        
        $this->load->model("Mdgurutahunan");
        $this->load->model("Mdkelas");
        $this->load->model("Mdgurumatapelajaran");
        $this->load->view("req/open-content");
        /* disini custom contentnya pake apapun yang dibutuhkan */
        
        
        $data = array(
            "guru" => $this->Mdgurutahunan->select2($where3)->result(),
            "assigned" => $this->Mdgurumatapelajaran->assigned($where2)->result(),
            "notassigned" => $this->Mdgurumatapelajaran->status($where)->result()
        );
        $this->load->view("user/akademik/gurumatpel",$data);
        /* endnya disini */
        $this->load->view("req/close-content");
        $this->load->view("req/space");
        $this->close();
        $this->load->view("script/js-calender");
        $this->load->view("script/js-datatable");
    }
    public function remove($i){
        $this->session_check();
        
        $where = array(
            "id_penugasan" => $i
        );
        $this->load->model("Mdgurumatapelajaran");
        $this->Mdgurumatapelajaran->remove($where);
        redirect("master/gurumatpel");
    }
    public function assign($i){
        $this->session_check();

        $data = array(
            "id_gurutahunan" => $this->session->idgurupilihkelas,
            "id_kelas" => $i,
            "status_penugasan" => 0,
            "tgl_submit_penugasan" => date('Y-m-d')
        );
        $this->load->model("Mdgurumatapelajaran");
        $this->Mdgurumatapelajaran->insert($data);
        redirect("master/gurumatpel");
    }
}
?>