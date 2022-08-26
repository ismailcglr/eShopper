<?php
function value($input){
    $ci=&get_instance();
    if (isset($ci->session->userdata["kullaniciBilgi"])) {
        echo $ci->session->userdata["kullaniciBilgi"]["$input"];
    }
    else{
        echo "";
    }
}

function getFavori($id){
    $ci=&get_instance();
    $al=$ci->db->select("*")->from("favori")->where("product_id",$id)->get()->row();
    if ($al){
        return true;
    }else{
        return false;
    }
}