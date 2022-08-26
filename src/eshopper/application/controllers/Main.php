<?php
class Main extends CI_Controller{
    public function index(){
        $this->load->view("website/header");
        $this->load->view("website/index");
        $this->load->view("website/footer");
    }

    public function favori(){
        if (!empty($this->session->userdata["kullaniciBilgi"])){
            $data["rows"]=$this->db
                ->select("product.productad as ad,product.productimage as resim,
                product.productbrand as marka,product.id as id,
                product.productprice as fiyat")
                ->from("favori")
                ->join("product","product.id=favori.product_id")
                ->get()
                ->result();
            $this->load->view("website/header");
            $this->load->view("website/favori",$data);
            $this->load->view("website/footer");
        }else{
            $this->session->set_flashdata("uyari","Favorilere girebilmek için lütfen kullanici girişi yapınız.");
            $data["uyari"]=$this->session->flashdata("uyari");
            $this->load->view("website/header");
            $this->load->view("website/login",$data);
            $this->load->view("website/footer");
        }
    }

    public function favoriadd(){
        if ($_POST){
            $id=$this->input->post("urun_id");
            $ad=$this->input->post("urun_ad");
            $al=$this->db->select("*")->from("favori")->where("product_id",$id)->get()->row();
            if ($al){

            }else{
                $data=array("product_id"=>$id,"favori_ad"=>$ad);
                $this->db->insert("favori",$data);
            }
        }
    }

    public function favoridelete(){
        if ($_POST){
            $product_id=$this->input->post("urun_id");
            $al=$this->db->select("*")->from("favori")->where("product_id",$product_id)->get()->row();
            $veri=array("id"=>$al->id);
            $this->db->delete("favori",$veri);
        }
    }

    public function sepet(){
        $this->load->view("website/header");
        $this->load->view("website/sepet");
        $this->load->view("website/footer");
    }

    public function urunekle(){
        $this->load->view("website/header");
        $this->load->view("website/addproduct");
        $this->load->view("website/footer");
        if (isset($_POST) && !empty($_POST)){
            $ad=$this->input->post("name");
            $fiyat=$this->input->post("price");
            $marka=$this->input->post("brand");
            $data=array(
                "productad"=>$ad,
                "productprice"=>$fiyat,
                "productbrand"=>$marka
            );
            $this->db->insert("product",$data);
            $id=$this->db->insert_id();
            $image_name=$id.".jpg";
            $veri=array("productimage"=>$image_name);
            $this->db->where("id",$id)->update("product",$veri);


            if (isset($_FILES)){
                $number_of_files=sizeof($_FILES["image"]["tmp_name"]);
                $files=$_FILES["image"];
                $errors=array();
                for ($i=0;$i<$number_of_files;$i++){
                    if ($_FILES["image"]["error"][$i] != 0) $errors[$i][]="adasd";
                }
                if (sizeof($errors) == 0){
                    $this->load->library("upload");
                    $config['upload_path'] = FCPATH.'assets/upload/';
                    $config['allowed_types'] = 'ico|jpg|png|jpeg';
                    for ($i=0;$i<$number_of_files;$i++){
                        $_FILES["image"]["name"]=$files["name"][$i];
                        $_FILES["image"]["type"]=$files["type"][$i];
                        $_FILES["image"]["tmp_name"]=$files["tmp_name"][$i];
                        $_FILES["image"]["error"]=$files["error"][$i];
                        $_FILES["image"]["size"]=$files["size"][$i];
                        $config['file_name'] = $image_name;
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload("image")){ }
                        $image_name=$id."-".$i.".jpg";
                    }
                }
            }

        }
    }

    public function product(){
        $data["products"]=$this->db->get("product")->result();
        $this->load->view("website/header");
        $this->load->view("website/sidebar");
        $this->load->view("website/product",$data);
        $this->load->view("website/footer");
    }

    public function product_detail($id){
        $data["product"]=$this->db->where("id",$id)->get("product")->result();
        $data["item"]=$this->db->select("*")->from("product")->get()->result();
        $this->load->view("website/header");
        $this->load->view("website/product_detail",$data);
        $this->load->view("website/footer");
    }

    public function add(){
        if ($_POST){
            $urunid=$this->input->post("urun_id");
            $urunadet=$this->input->post("urun_adet");
            if ($urunadet > 0){
                $var_mi=$this->db->where("id",$urunid)->get("product")->row();
                if ($var_mi){
                    $veri=array(
                        "id"=>$var_mi->id,
                        "name"=>$var_mi->productad,
                        "qty"=>$urunadet,
                        "price"=>$var_mi->productprice
                    );
                    $this->cart->insert($veri);
                }
            }
        }
    }

    public function remove($id){
        if (!$id){
            redirect(base_url());
        }
        $veri=array(
            "rowid" => $id,
            "qty" => 0
        );
        $this->cart->update($veri);
        redirect(base_url("main/sepet"));
    }

    public function emptycard(){
        $this->cart->destroy();
        redirect(base_url());
    }

    public function complete(){
        $this->load->view("website/header");
        $this->load->view("website/form");
        $this->load->view("website/footer");
    }

    public function shorts(){
        $this->load->view("website/header");
        $this->load->view("website/shorts");
        $this->load->view("website/footer");
    }

}