<?php
//load detail mata pelajaran
//load persentasi kehadiran
//load data mingguan
//download materi

//kalau tombol assignment dipencet, keluar popup ada soal ada dokumen yg bisa didonlod dan ada tempat upload
//upload dokumen
defined("BASEPATH") OR exit("No Direct Script");

class Index extends CI_Controller{
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
    public function index($i){
        //$this->load->view("namapage/breadcrumb");
        $this->load->view("req/open-content");
        /* disini custom contentnya pake apapun yang dibutuhkan */
        $this->load->view("user/siswa/matapelajaran");
        /* endnya disini */
        $this->load->view("req/close-content");
        $this->load->view("req/space");
        $this->close();
        $this->load->view("script/js-calender");
        $this->load->view("script/js-datatable");
    }
    public function minggu($i){
        //$this->load->view("namapage/breadcrumb");
        $this->load->view("req/open-content");
        /* disini custom contentnya pake apapun yang dibutuhkan */
        $this->load->model("Mdmatapelajaran");
        $this->load->model("Mdgurutahunan");
        $where = array(
            "guru_tahunan.id_gurutahunan" => $i
        );
        $aktivitase = $this->Mdgurutahunan->select($where)->result();
        foreach($aktivitase as $a){
            $namamatpel = $a->nama_matpel;
            $namaguru = $a->nama_depan." ".$a->nama_belakang;
            break;
        }
        $where = array(
            "jadwal.id_gurutahunan" => $i
        );
        $data = array(
            "aktivitas" => $this->Mdmatapelajaran->aktivitas($where)->result(),
            "nama_matpel" => $namamatpel,
            "nama_guru" => $namaguru,
        );
        $this->load->view("user/siswa/matapelajaran",$data);
        /* endnya disini */
        $this->load->view("req/close-content");
        $this->load->view("req/space");
        $this->close();
        $this->load->view("script/js-calender");
        $this->load->view("script/js-datatable");
        $this->load->view("user/siswa/script/js-ajax-cekadaquiz");
        $this->load->view("user/siswa/script/js-ajax-dokumen");
    }
    
    
    public function quiz($i){
        //$this->load->view("namapage/breadcrumb");
        $this->load->view("req/open-content");
        /* disini custom contentnya pake apapun yang dibutuhkan */
        $this->load->model("Mdquiz");
        $where = array(
            "id_mingguan" => $i
        );
        $idquiz = $this->Mdquiz->select($where)->result();
        foreach($idquiz as $b){
            $id_quiz = $b->id_quiz;
        }
        $where2 = array(
            "soal.id_quiz" => $id_quiz,
            "jawaban_quiz.id_user" => $this->session->id_user
        );
        $data = array(
            "quiz" => $this->Mdquiz->select($where)->result(),
            "id_quiz" => $id_quiz,
            "statusquiz" =>$this->Mdquiz->cekpengambilanquiz($where2)->num_rows()
        );
        $this->load->view("user/siswa/quiz",$data);
        /* endnya disini */
        $this->load->view("req/close-content");
        $this->load->view("req/space");
        $this->close();
        $this->load->view("script/js-calender");
        $this->load->view("script/js-datatable");
    }
    public function submitquiz($i){
        $this->load->model("Mdsiswaangkatan");
        $this->load->model("Mdsoal");
        $where = array(
            "user.id_user" => $this->session->id_user
        );
        $result = $this->Mdsiswaangkatan->select($where)->result();
        foreach($result as $a){
            $id_siswa_angkatan = $a->id_siswa_angkatan;
        }
        $this->load->model("Mdquiz");
        $where = array(
            "soal.id_quiz" => $i
        );
        $soal = $this->Mdquiz->select($where)->result();
        $urutansoal = 0;
        $nilai = 0;
        foreach($soal as $a){
            $ans = $this->input->post("soal".$urutansoal);
            $data = array(
                "id_soal" => $a->id_soal,
                "id_user" => $this->session->id_user,
                "jawaban_quiz" => $ans,
                "status_jawaban" => 0,
                "tgl_submit_jawaban"=> date("Y-m-d")
            );
            $this->Mdquiz->masukjawab($data);
            //langsung liat nomor 1 ada salah apa kaga
            $where = array(
                "id_soal" => $a->id_soal,
                "jawaban" => $ans
            );
            $cek = $this->Mdsoal->select($where)->result();
            foreach($cek as $a){
                $nilai++;
            }
            $urutansoal++;
        }
        
        //masukin hasilnya ke niai quiz
        $this->load->model("Mdnilaiquiz");
        $data = array(
            "id_siswa" => $id_siswa_angkatan ,//id siswa tahun ajaran
            "id_quiz" => $i,
            "nilai_quiz" => ($nilai/$urutansoal)*10,
            "status_nilai" => 0,
            "tgl_submit_nilai" => date("Y-m-d")
        );
        $this->Mdnilaiquiz->insert($data);
        redirect("user/siswa/assignment");
    }
    
}
?>