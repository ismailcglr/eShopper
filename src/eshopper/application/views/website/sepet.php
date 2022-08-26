<section id="cart_items">
    <div class="container">
        <div class="table-responsive cart_info">
            <?php if (count($this->cart->contents()) > 0){ ?>
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Ürün Resmi</td>
                    <td class="description">Ürün Adı</td>
                    <td class="price">Fiyat</td>
                    <td class="quantity">Adet</td>
                    <td class="total">Toplam Tutar</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <?php $al=0; foreach ($this->cart->contents() as $urun){ ?>
                <tr>
                    <td class="cart_product">
                        <a href="<?= base_url("main/product_detail/").$urun["id"] ?>"><img style="width: 150px; height: 150px;" src="<?= base_url("assets/upload/").$urun["id"].".jpg" ?>" alt=""></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href=""><?= $urun["name"] ?></a></h4>
                        <p>Urun ID: <?= $urun["id"] ?></p>
                    </td>
                    <td class="cart_price">
                        <p><?= $urun["price"] ?></p>
                    </td>
                    <td class="cart_quantity">
                        <input class="cart_quantity_input" type="text" name="quantity" value="<?= $urun["qty"] ?>" autocomplete="off" size="2">
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price"><?= $urun["subtotal"] ?></p>
                    </td>
                    <td>
                        <a href="<?= base_url('main/remove/'.$urun['rowid']); ?>"
                           onclick='return confirm("onaylıyor musunuz ?");'
                           class="btn btn-danger">Sepetten çıkar</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php }else{
                echo "<div class='alert alert-danger'>Sepetinizde ürün yoktur...</div>";

            } ?>
        </div>
    </div>
</section> <!--/#cart_items-->

<section >
    <div class="container">
        <div class="heading">
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <?php if ($this->cart->total() > 0){ ?>
                    <a href="<?= base_url("main/complete") ?>" class="btn btn-success">Alışverişi Tamamla</a>
                    <a href="<?= base_url('main/emptycard'); ?>"
                        onclick='return confirm("Tüm ürünler çıkarılacak onaylıyor musunuz ?");'
                        class="btn btn-warning">Sepeti Boşalt!</a><br>
                    <h2>GENEL TOPLAM : <?= $this->cart->total(); ?> ₺</h2>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</section><!--/#do_action-->

<script>
    $(document).ready(function(){
        $('.adetguncelle').click(function (){
            var urun_id=$(this).data("urunid");
            var urun_adet=$("#"+urun_id).val();

            if (urun_adet != "" && urun_adet > 0){
                $.ajax({
                    method : 'POST',
                    url : "<?= base_url('main/update') ?>",
                    data : {
                        urun_id:urun_id,
                        urun_adet:urun_adet
                    },
                    success : function (data){
                        if($.trim(data) == "adetbelirtin"){
                            alert("lütfen adet giriniz.");
                        }else{
                            alert("ürün adeti güncellendi...");
                            window.location.reload();
                        }
                    }
                });
            }else{
                alert("lütfen adet belirtin");
            }
        });
    });
</script>