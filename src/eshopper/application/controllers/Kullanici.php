<?php
class Kullanici extends CI_Controller{

    public function login(){
        $data["error"]=$this->session->flashdata("error");
        $this->load->view("website/header");
        $this->load->view("website/login",$data);
        $this->load->view("website/footer");
        if (isset($_POST) && !empty($_POST)){
            $mail=$this->input->post("mail");
            $sifre=$this->input->post("sifre");
            $data=$this->db->select("*")->from("kullanici")->where(["mail"=>$mail,"password"=>$sifre])->get()->row();

            if($data){
                $bilgi=array(
                    "id"=>$data->id,
                    "kadi"=>$data->kadi,
                    "mail"=>$data->mail,
                    "tel"=>$data->tel,
                    "adres"=>$data->adres,
                    "status"=>true
                );
                $this->session->set_userdata("kullaniciBilgi",$bilgi);
                redirect("main/index");
            }else{
                $hata="Mail adresiniz veya şifreniz hatalıdır...";
                $this->session->set_flashdata("error","Mail adresiniz veya şifreniz hatalıdır...");
                redirect("kullanici/login");
            }
        }
    }

    public function logout(){
        $this->session->unset_userdata("kullaniciBilgi");
        redirect("kullanici/login");
    }

    public function register(){
        $this->load->view("website/header");
        $this->load->view("website/register");
        $this->load->view("website/footer");
    if (isset($_POST) && !empty($_POST)){
        $kadi=$this->input->post("kadi");
        $tel=$this->input->post("tel");
        $mail=$this->input->post("mail");
        $sifre=$this->input->post("sifre");
        $adres=$this->input->post("adres");
        $data=array(
            "kadi"=>$kadi,
            "password"=>$sifre,
            "mail"=>$mail,
            "tel"=>$tel,
            "adres"=>$adres
        );
        $al=$this->db->insert("kullanici",$data);
        if ($al){
            redirect("kullanici/login");
        }
    }
    }
}