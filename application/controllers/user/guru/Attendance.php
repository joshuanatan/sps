<?php
//ngeload kelas yang diajar
//pilih kelas yang diajar
//ngeload id jadwal di kelas tersebut
//pilih id jadwal (kalau bisa udah default sesuai jam / sesuai matapelajaran saat itu). Logicnya adalah, setiap pertemuan dia harus absen gitu sehingga bisa lanjut terus ke jadwal berikutnya. jadi bisa otomatis gitu
//submit checklist absen
//isi journal setiap pelajaran

defined("BASEPATH") OR exit("No Direct Script");

class Attendance extends CI_Controller{
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
        $this->load->view("req/html-open");
        $this->load->view("req/head",$data);
        $this->load->view("user/guru/menu");
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
    public function index(){
        //$this->load->view("namapage/breadcrumb");
        $this->load->view("req/open-content");
        /* disini custom contentnya pake apapun yang dibutuhkan */
        $this->load->model("Mdgurumatapelajaran");
        $where = array(
            "user.id_user" => $this->session->id_user
        );
        $data = array(
            "kelas" => $this->Mdgurumatapelajaran->selectgurukelas($where)->result()
        );
        $this->load->view("user/guru/attendanceguru",$data);
        /* endnya disini */
        $this->load->view("req/close-content");
        $this->load->view("req/space");
        $this->close();
        $this->load->view("script/js-calender");
        $this->load->view("script/js-datatable");
        $this->load->view("user/guru/script/js-ajax-kelasminggu");
    }
    public function absen(){
        $where = array(
            "id_mingguan" => $this->session->idmingguan
        );
        $this->load->model("Mdabsen");
        $this->Mdabsen->remove($where);
        $siswa = $this->input->post("status");
        $this->load->model("Mdabsen");
        foreach($siswa as $a){
            $data = array(
                "id_mingguan" => $this->session->idmingguan,
                "id_siswaangkatan" => $a,
                "status_absen" => 0,
                "tgl_submit_absen" => date("Y-m-d")
            );
            $this->Mdabsen->insert($data);
        }
        redirect("user/guru/attendance/");
    }
    public function ceksiswa(){
        $this->load->model("Mdkelassiswa");
        $this->load->model("Mdaktivitasmingguan");
        $this->load->model("Mdabsen");
        $this->session->idmingguan = $this->input->post("id_mingguan");
        $kelas = $this->input->post("id_kelas");
        $this->session->idkelas = $kelas;
        $this->load->view("req/open-content");
        /* disini custom contentnya pake apapun yang dibutuhkan */
        $this->load->model("Mdgurumatapelajaran");
        $where = array(
            "user.id_user" => $this->session->id_user
        );
        $where2 = array(
            "kelas.id_kelas" => $kelas
        );
        $where3 = array(
            "id_mingguan" => $this->session->idmingguan
        );
        $data = array(
            "kelas" => $this->Mdgurumatapelajaran->selectgurukelas($where)->result(),
            "siswa" => $this->Mdkelassiswa->select($where2)->result(),
            "absen" => $this->Mdabsen->select($where3)->result(),
            "agenda" => $this->Mdaktivitasmingguan->select($where3)->result()
        );
        $this->load->view("user/guru/attendanceguru2",$data);
        /* endnya disini */
        $this->load->view("req/close-content");
        $this->load->view("req/space");
        $this->close();
        $this->load->view("script/js-calender");
        $this->load->view("script/js-datatable");
        $this->load->view("user/guru/script/js-ajax-kelasminggu");
        //untuk siswa di kelas itu butuh id kelas
        //untuk siswa ang absen butuh id mingguan
    }
    
}