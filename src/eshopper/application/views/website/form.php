<section class="py-5">
        <div class="row ">
            <form action="<?= base_url("creditcard/payment") ?>" method="post">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <input value="<?= value("kadi") ?>" type="text" class="form-control" name="isim" placeholder="adınız soyadınız">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <input value="<?= value("tel") ?>" type="text" class="form-control" name="tel" placeholder="telefon numaranız">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <input value="<?= value("mail") ?>" type="email" class="form-control" name="eposta" placeholder="mail adresiniz">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <input value="<?= value("adres") ?>"  type="text" class="form-control" name="adres" placeholder="adresinizi giriniz">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="col-md-9">
                                <h3>GENEL TOPLAM : <?= $this->cart->total(); ?> ₺</h3>
                                <input  type="text" name="toplam" hidden value="<?= $this->cart->total(); ?>">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success">ÖDEME YAP</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</section>




