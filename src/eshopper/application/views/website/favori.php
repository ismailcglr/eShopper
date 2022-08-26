<div class="features_items">
    <h2 class="title text-center">Favoriler</h2>
    <?php foreach ($rows as $row){ ?>
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img style="height: 350px;width: 350px;" src="<?= base_url("assets/upload/$row->resim"); ?>"/><br><br>
                    <b><?= $row->ad ?></b>
                    <p><?= $row->marka ?></p>
                    <h2><?= $row->fiyat ?> ₺</h2>

                    <button type="button" class="btn btn-default add-to-cart favoricikart" data-favoriad="<?= $row->ad ?>"
                            data-favoriid="<?= $row->id ?>" name="favoricikart">
                            <i class="fa fa-heart"></i> Favoriden Çıkart</button><br>

                    <button  class="btn btn-default add-to-cart sepeteekle" data-urunadi="<?= $row->ad ?>"
                             name="sepeteekle" data-urunid="<?= $row->id ?>" data-urunadet="1"><i class="fa fa-shopping-cart">
                             </i> Sepete Ekle</button>

                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<script>
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
        var urun_adet=$(this).data("urunadet");
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