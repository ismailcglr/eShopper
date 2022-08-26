
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <?php if (!empty($uyari)){ echo "<script> 
                                                        swal.fire({icon: 'error',title: 'Uyarı',text: '$uyari',})
                                                        </script>";} ?>
                    <h2>Kullanıcı girişi yapınız...</h2>
                    <?php if (!empty($error)){ echo "<h2 style='background-color: red;color: black;'>".$error."</h2><br>"; }?>
                    <form action="<?= base_url("kullanici/login") ?>" method="post">
                        <input type="email" name="mail" placeholder="Mail Adresiniz" />
                        <input type="password" name="sifre" placeholder="Şifreniz" />
                        <span>
								<input type="checkbox" class="checkbox">
								Beni Hatırla
						</span>
                        <button type="submit">Giriş</button>
                        <br>
                        <a type="text" href="<?= base_url("kullanici/register") ?>" class="btn btn-success ">Kayıt ol</a>
                    </form>
                </div><!--/login form-->
            </div>

        </div>
    </div>
</section><!--/form-->
<script>
    function pop(ali){ swal.fire(ali); }
</script>