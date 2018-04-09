        </div>
    </div>
    <div class="docs-header" style="min-height: 90%;">
        <div class="topic" style="min-height: 100%; z-index: 999;">
            <div class="container">
                <div class="col-md-12">
                    <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">Error!<?php echo $error; ?></div>
                    <?php endif;?>

                    <form class="well" role="form" method="POST" action="<?php echo site_url('aduan/add'); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nomor Identitas (KTP) - <i>Wajib diisiiiiiiiiiiiiiiiiii</i></label>
                            <input type="text" class="form-control" id="no_identitas" name="no_identitas" value="<?php echo set_value('no_identitas'); ?>" maxlength="16">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama - <i>Wajib diisi</i></label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama">Alamat - <i>Wajib diisi</i></label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo set_value('alamat'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nomor Telepon <i>(Optional)</i></label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo set_value('no_hp'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama">Email <i>(Optional)</i></label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
                            <p><i>*Jika diisi, anda dapat mengetahui perkembangan aduan anda melalui email</i></p>
                        </div>
                        <label for="tglLahir">Tanggal Lahir - <i>Wajib diisi</i></label>
                        <div class="form-group input-group date">
                            <select id="tanggal" name="tanggal" style="width: 100px">
                                <?php for ($i=1; $i < 32 ; $i++) {?>
                                    <option value="<?php echo $i; ?>" <?php echo set_select('tanggal', $i); ?>><?php echo $i; ?></option>
                                <?php }?>
                            </select>
                            &nbsp;
                            <select id="bulan" name="bulan" style="width: 100px">
                                <option value="01" <?php echo set_select('bulan', '01'); ?>>Januari</option> 
                                <option value="02" <?php echo set_select('bulan', '02'); ?>>Februari</option>
                                <option value="03" <?php echo set_select('bulan', '03'); ?>>Maret</option>
                                <option value="04" <?php echo set_select('bulan', '04'); ?>>April</option>
                                <option value="05" <?php echo set_select('bulan', '05'); ?>>Mei</option>
                                <option value="06" <?php echo set_select('bulan', '06'); ?>>Juni</option>
                                <option value="07" <?php echo set_select('bulan', '07'); ?>>Juli</option>
                                <option value="08" <?php echo set_select('bulan', '08'); ?>>Agustus</option>
                                <option value="09" <?php echo set_select('bulan', '09'); ?>>September</option>
                                <option value="10" <?php echo set_select('bulan', '10'); ?>>Oktober</option>
                                <option value="11" <?php echo set_select('bulan', '11'); ?>>November</option>
                                <option value="12" <?php echo set_select('bulan', '12'); ?>>Desember</option>
                            </select>
                            &nbsp;
                            <select id="tahun" name="tahun" style="width: 100px">
                                <?php for ($i=1940; $i <= date('Y')-17 ; $i++) {?>
                                    <option value="<?php echo $i; ?>" <?php echo set_select('tahun', $i); ?>><?php echo $i; ?></option>
                                <?php }?>
                            </select>
                            <!-- <input id="tgl_lahir" name="tgl_lahir" type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span> -->
                        </div>
                        <input type="hidden" id="latitude" name="latitude" value="" />
                        <input type="hidden" id="longitude" name="longitude" value="" />
                        <div class="form-group">
                            <label>Tempat Terjadi <i>(Optional)</i></label>
                            <p><i>Gunakan fasilitas peta di bawah ini untuk menunjukkan lokasi objek yang diadukan, semakin akurat semakin baik (gunakan level zoom paling tinggi)</i></p>
                            <div id="googleMap" style="width:500px;height:380px;"></div>
                        </div>
                        <div class="form-group">
                            <label>Topik Pengaduan Anda - <i>Wajib diisi</i></label>
                            <p><i>Deskripsikan dengan singkat inti aduan anda</i></p>
                            <input type="text" class="form-control" id="topik" name="topik" value="<?php echo set_value('topik'); ?>">
                        </div>
                        <div class="form-group">
                            <label>Pilih Departemen - <i>Wajib diisi</i></label>
                            <select class="form-control" id="departemen" name="departemen">
                                <?php foreach ($departemen as $key => $value): ?>
                                <option value="<?php echo $value['id_departemen']; ?>" <?php echo set_select('departemen', $value['id_departemen']); ?>><?php echo $value['nama_departemen']; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="isiKeluhan">Isi Pengaduan Anda - <i>Wajib diisi</i></label>
                            <p><i>Deskripsikan dengan jelas aduan anda</i></p>
                            <textarea class="ckeditor" id="isi" name="isi"><?php echo set_value('isi'); ?></textarea>
                        </div>
                        <div class="form-group">
                               <h4>Unggah Berkas Pendukung (menerima tipe berkas: jpg, png, gif, pdf, doc/docx, xls/xlsx)</h4>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-primary btn-file">
                                            Unggah&hellip; <input type="file" name="files[]" multiple>
                                        </span>
                                    </span>
                                </div>
                        </div>
                        <br>
                        <center><button type="submit" class="btn btn-primary btn-lg">Kirim</button></center>
                    </form>
                    <hr>
                    <script type="text/javascript">
                        $( document ).ready(function() {
                            function initialize() {
                                var location;
                                var mapProp = {
                                    center: new google.maps.LatLng(-7.820951, 112.005936),
                                    zoom: 12,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                };
                                var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

                                var citMarker = new google.maps.Marker({
                                    position: new google.maps.LatLng(51.885403000000000000, -8.534554100000037000)
                                });

                                var infowindow = new google.maps.InfoWindow({
                                    content: ""
                                });

                                google.maps.event.addListener(citMarker, 'click', function() {
                                    map.setZoom(15);
                                    map.setCenter(citMarker.getPosition());
                                    infowindow.open(map, citMarker);
                                });

                                google.maps.event.addListener(map, 'click', function(event) {
                                    location = event.latLng;
                                    var lat = location.lat();
                                    var long = location.lng();
                                    infowindow.content = 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng();
                                    citMarker.position = location;
                                    citMarker.setMap(map);
                                    $('#longitude').val(long);
                                    $('#latitude').val(lat);
                                });
                            }
                            google.maps.event.addDomListener(window, 'load', initialize);

                            // $("#tgl_lahir").datepicker({
                            //     language: "id",
                            //     autoclose: true
                            // });
                            $("#tanggal").select2();
                            $("#bulan").select2();
                            $("#tahun").select2();
                            $("#departemen").select2();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>