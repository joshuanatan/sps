<?php
class Validate extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function validate($hari){
        $this->load->model("Mdjadwal");
        //echo $this->input->post("hari");
        //echo $this->input->post("jam");
        $where = array(
            "id_kelas" => $this->session->pilihkelas,
        );
        
        $this->session->ajaxhari = $hari;
        $this->session->ajaxjam = $this->input->post("jam");
    
        $result = $this->Mdjadwal->selection($where);
        echo json_encode($result);
    }
}