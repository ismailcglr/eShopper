
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    <?php foreach ($products as $product){ ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img style="height: 170px; width: 170px;" src="<?= base_url("assets/upload/".$product->productimage) ?>"/>
                                        <a href="<?= base_url("main/product_detail/$product->id") ?>">
                                            <h2><?= $product->productprice ?> ₺</h2>
                                            <p><?= $product->productad ?></p>
                                        </a>
                                        <input type="number" class="form-control" placeholder="Ürün adeti" id="<?= $product->id ?>"><br>
                                        <button type="button" class="btn btn-success sepeteekle"
                                                data-urunid="<?= $product->id ?>" data-urunadi="<?= $product->productad ?>"
                                                name="sepeteekle">Sepete Ekle!</button>
                                        <?php
                                        if (!empty($this->session->userdata["kullaniciBilgi"])){
                                            if (getFavori($product->id) === false){

                                            ?>
                                        <button type="button" class="btn favoriekle" name="favoriekle"
                                        data-favoriid="<?= $product->id ?>" data-favoriad="<?= $product->productad ?>"
                                        ><i class="fa fa-heart"></i> Favorilere ekle</button>
                                        <?php }else{ ?>
                                            <button type="button" class="btn favoricikart" name="favoricikart"
                                                    data-favoriid="<?= $product->id ?>" data-favoriad="<?= $product->productad ?>"
                                            ><i class="fa fa-heart"></i> Favoriden çıkart</button>
                                        <?php
                                            }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
<script>
    $('.favoriekle').click(function (){
       var urunid=$(this).data("favoriid");
       var urunad=$(this).data("favoriad");
       $.ajax({
            method: 'POST',
            url : "<?= base_url("main/favoriadd"); ?>",
            data : {urun_id:urunid,urun_ad:urunad},
            success : function (data){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-info',
                    cancelButton: 'btn btn-success'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Ürün favoriye eklendi',
                text: urunad,
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Alışverişe devam et.',
                cancelButtonText: 'Favoriye git.',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    window.location.href="<?= base_url("main/favori"); ?>";
                }
            })
            }

       })
    });

    $('.favoricikart').click(function (){
        var urunid=$(this).data("favoriid");
        var urunad=$(this).data("favoriad");
        $.ajax({
            method: 'POST',
            url : "<?= base_url("main/favoridelete"); ?>",
            data : {urun_id:urunid,urun_ad:urunad},
            success : function (data){

                swal.fire({
                    title: 'Ürün favoriden çıkartıldı',
                    text: urunad,
                    icon: 'success',
                })
            }

        })
    });

    $('.sepeteekle').click(function (){
        var urun_adi=$(this).data("urunadi");
        var urun_id=$(this).data("urunid");
        var urun_adet=$("#"+urun_id).val();
        if (urun_adet != "" && urun_adet > 0){
            $.ajax({
                method : 'POST',
                url : "<?= base_url('main/add') ?>",
                data : {
                    urun_id:urun_id,
                    urun_adet:urun_adet
                },
                success : function (data){
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-info',
                            cancelButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire({
                        title: 'Ürün sepete eklendi',
                        text: urun_adi,
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Alışverişe devam et.',
                        cancelButtonText: 'Sepete git.',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {

                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            window.location.href="<?= base_url("main/sepet"); ?>";
                        }
                    })
                }
            });
        }else{
            swal.fire({
                icon: 'info',
                title: 'Uyarı...',
                text: 'Lütfen adet belirtiniz!',
            });
        }
    });
</script>