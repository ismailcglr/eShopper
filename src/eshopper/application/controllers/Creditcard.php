<?php
class Creditcard extends CI_Controller{
    public function payment(){
        if (isset($_POST) && !empty($_POST)){
            $isim=$this->input->post("isim");
            $mail=$this->input->post("eposta");
            $adres=$this->input->post("adres");
            $tel=$this->input->post("tel");
            $sipariskodu=uniqid();

            $data=array(
                "isim"=>$isim,
                "tel"=>$tel,
                "eposta"=>$mail,
                "adres"=>$adres,
                "toplam"=>$this->input->post("toplam"),
                "durum"=>2,
                "sipariskodu"=>$sipariskodu
            );
            $ekle=$this->db->insert("siparisler",$data);
            if ($ekle) {
                $merchant_id='160501'; // Mağaza numarası
                $merchant_key='JMJzjJnzN4jz1wQX'; // Mağaza Parolası - Mağaza paneline giriş yaparak BİLGİ sayfasından alabilirsiniz.
                $merchant_salt='cJFUEQ7a9duuR61H'; // Mağaza Gizli Anahtarı - Mağaza paneline giriş yaparak BİLGİ sayfasından alabilirsiniz.

                ## Kullanıcının IP adresi
                if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
                    $ip = $_SERVER["HTTP_CLIENT_IP"];
                } elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
                    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                } else {
                    $ip = $_SERVER["REMOTE_ADDR"];
                }

                $user_ip=$ip;  // !!! Eğer bu kodu sunucuda değil local makinanızda çalıştırıyorsanız buraya dış ip adresinizi(https://www.whatismyip.com/) yazmalısınız.

                $merchant_oid=$sipariskodu;//sipariş numarası: her işlemde benzersiz olmalıdır! Bu bilgi bildirim sayfanıza yapılacak bildirimde gönderilir.
                $email=$mail; // Müşterinizin sitenizde kayıtlı eposta adresi
                $payment_amount=$this->cart->total()*10;//9.99 TL
                $payment_type='eft';
                $debug_on=1;//hata mesajlarını ekrana bas

                ## İşlem zaman aşımı süresi - dakika cinsinden
                $timeout_limit = "30";

                ## Mağaza canlı modda iken test işlem yapmak için 1 olarak gönderilebilir
                $test_mode = 1;

                $hash_str=$merchant_id.$user_ip.$merchant_oid.$email.$payment_amount.$payment_type.$test_mode;
                $paytr_token=base64_encode(hash_hmac('sha256',$hash_str.$merchant_salt,$merchant_key,true));

                $post_vals=array(
                    'merchant_id'=>$merchant_id,
                    'user_ip'=>$user_ip,
                    'merchant_oid'=>$merchant_oid,
                    'email'=>$email,
                    'payment_amount'=>$payment_amount,
                    'payment_type'=>$payment_type,
                    'paytr_token'=>$paytr_token,
                    'debug_on'=>$debug_on,
                    'timeout_limit'=>$timeout_limit,
                    'test_mode'=>$test_mode
                );

                $ch=curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1) ;
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
                curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 20);

                //XXX: DİKKAT: lokal makinanızda "SSL certificate problem: unable to get local issuer certificate" uyarısı alırsanız eğer
                //aşağıdaki kodu açıp deneyebilirsiniz. ANCAK, güvenlik nedeniyle sunucunuzda (gerçek ortamınızda) bu kodun kapalı kalması çok önemlidir!
                //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                $result = @curl_exec($ch);

                if(curl_errno($ch))
                {
                    die("PAYTR EFT IFRAME connection error. err:".curl_error($ch));
                }
                curl_close($ch);

                $result=json_decode($result,1);

                /*
                    Başarılı yanıt örneği: (token içerir)
                    {"status":"success","token":"28cc613c3d7633cfa4ed0956fdf901e05cf9d9cc0c2ef8db54fa"}

                    Başarısız yanıt örneği:
                    {"status":"failed","reason":"Zorunlu alan degeri gecersiz: merchant_id"}
                */

                if($result['status']=='success')
                {
                     $token=$result['token'];
                }
                else
                {
                    die("PAYTR EFT IFRAME failed. reason:".$result['reason']);
                }
                $data["row"]=$token;
                $this->load->view("iframe",$data);

            }
        }
    }

    public function payment2(){
    if (isset($_POST) && !empty($_POST)){
        $isim=$this->input->post("isim");
        $mail=$this->input->post("eposta");
        $adres=$this->input->post("adres");
        $tel=$this->input->post("tel");
        $sipariskodu=uniqid();
        if (!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip	= $_SERVER['HTTP_CLIENT_IP'];
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip	= $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip	= $_SERVER['REMOTE_ADDR'];
        }
            $data=array(
                "isim"=>$isim,
                "tel"=>$tel,
                "eposta"=>$mail,
                "adres"=>$adres,
                "toplam"=>$this->input->post("toplam"),
                "durum"=>2,
                "sipariskodu"=>$sipariskodu
            );
            $ekle=$this->db->insert("siparisler",$data);
            if ($ekle) {
                $esnekpos["Config"] = array(
                    "MERCHANT" => "TEST1234",
                    "MERCHANT_KEY" => "4oK26hK8MOXrIV1bzTRVPA==",
                    "BACK_URL" => base_url("main/product"),
                    "PRICES_CURRENCY" => "TRY",
                    "ORDER_REF_NUMBER" => $sipariskodu,
                    "ORDER_AMOUNT" => $this->cart->total()
                );
                $esnekpos["CreditCard"] = array(
                    "CC_NUMBER" => " 4111111111111111",
                    "EXP_MONTH" => "12",
                    "EXP_YEAR" => "2022",
                    "CC_CVV" => "000",
                    "CC_OWNER" => "PAYTR TEST",
                    "INSTALLMENT_NUMBER" => "1"
                );
                $esnekpos["Customer"] = array(
                    "FIRST_NAME" => $isim,
                    "LAST_NAME" => "soyadsız",
                    "MAIL" => $mail,
                    "PHONE" => $tel,
                    "CITY" => "İstanbul",
                    "STATE" => "Kağıthane",
                    "ADDRESS" => $adres,
                    "CLIENT_IP" => $ip
                );
                $esnekpos["Product"] = array();
                foreach ($this->cart->contents() as $urun) {
                    $array = array(
                        "PRODUCT_ID" => $urun["id"],
                        "PRODUCT_NAME" => $urun["name"],
                        "PRODUCT_CATEGORY" => "Elektronik",
                        "PRODUCT_DESCRIPTION" => $urun["name"] . "Ürün Açıklaması",
                        "PRODUCT_AMOUNT" => $urun["price"]
                    );
                    array_push($esnekpos["Product"], $array);
                }
                $cikti = json_encode($esnekpos);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://posservicetest.esnekpos.com/api/pay/EYV3DPay',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $cikti,
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $hamzaabi = json_decode($response);
                if ($hamzaabi->STATUS == "SUCCESS") {
                    redirect($hamzaabi->URL_3DS);
                } else {
                    echo "Hata Codu : " . $hamzaabi->RETURN_CODE . "<br>";
                    echo $hamzaabi->RETURN_MESSAGE;
                }
            }
        }
    }

}