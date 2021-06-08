<div class="content">
    <div class="row">
        <div class="col-3 col-s-2">
        </div>
        <div class="col-6 col-s-8 col-xs-12">
           <form class="contact" method="POST" action="/default/sendmessage" >
                <h2>Detaylı bilgi ve fiyat için iletişime geçin</h2>
                <div class="form-control">
                    <input placeholder="Adınız Soyadınız" type="text" name="name" required autofocus>
                </div>
                <div class="form-control">
                    <input placeholder="E-Posta Adresiniz" type="email" name="email" >
                </div>
                <div class="form-control">
                    <input placeholder="Telefon numaranız" type="tel" name="phone" required>
                </div>
                <div class="form-control">
                    <input placeholder="Konu" type="text" name="subject" required>
                </div>
                <div class="form-control">
                    <textarea placeholder="Lütfen Mesajınızı Buraya Yazın.." name="text" required></textarea>
                </div>
                <div class="form-control">
                    <button name="submit" type="submit" id="submit">GÖNDER</button>
                </div>
           </form>
        </div>
        <div class="col-3 col-s-2">
        </div>
    </div>
</div>
