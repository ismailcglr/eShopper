<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 col-sm-offset-1">
                <div class="signup-form"><!--sign up form-->
                    <h2>Yeni Kullanıcı Kaydı</h2>
                    <form action="<?= base_url("kullanici/register") ?>" method="post">
                        <input type="text" name="kadi" placeholder="Adınız"/>
                        <input type="email" name="mail" placeholder="Mail Adresiniz"/>
                        <input type="password" name="sifre" placeholder="Şifreniz"/>
                        <input type="text" name="tel" placeholder="Telefon numaranız">
                        <input type="text" name="adres" placeholder="Adresiniz">
                        <button type="submit" class="btn btn-default">Kayıt ol</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section>