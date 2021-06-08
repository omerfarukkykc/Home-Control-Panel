<div class="content">
    <div class="row">
        <div class="col-3 col-s-2">
           
        </div>
        <div class="col-6 col-s-8">
           <form id="contact" class="contact" >
                <h2>Detaylı bilgi ve fiyat almak için iletişime geçin</h2>
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
<script>
    $('#contact').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/default/setmessage",
            data: $(this).serialize(),
            dataType: "json",
            }).done(function (data) {
            console.log(data);
        });
    })
</script>