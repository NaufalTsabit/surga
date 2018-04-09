<style type="text/css">
   
    #content1 {
    float: left;
    width: 80%;

    }
    #content2 {
        float: left;
        width: 20%;
        
    }
    #content3 {
        float: right;
        width: 15%;
        
    }
    .verticalLine {
        border-left: thick solid #F8F8FF;
        border-style:none;
    }

    #kolom1 {
        float: left;
        width: 100%;

    }
    #kolom2 {
        float: left;
        width: 100%;
        
    }

    .alignTeks {
        text-align: center;
    }

    @media only screen and (orientation: landscape) {

    .verticalLine {
        border-left: thick solid #F8F8FF;
        
    }

    .alignTeks {
        text-align: right;
    }
  
    #kolom1 {
        float: left;
        width: 35%;

    }
    #kolom2 {
        float: left;
        width: 50%;
        
    }

}
    
</style>




</div>
    </div>
    <div class="docs-header" style="min-height: 80%;">
        <div class="topic" style="min-height: 100%; z-index: 999;">
            <div class="container" >
                <div class="col-md-10 col-md-offset-1">
                    <form id="msform" role="form" method="POST" action="<?php echo site_url('aduan/add'); ?>" enctype="multipart/form-data" style="min-height: 690px">
                    <style type="text/css">
                        label {
                            color: #fff;
                        }
                        .customTextAreaClass{
                            height: 190px !important;
                            transition-property: width, background, height;
                            transition-duration: 0.5s;
                            -webkit-transition-property: width, background, height;
                            -webkit-transition-duration: 0.5s;
                            -0-transition-property: width, background, height;
                            -0-transition-duration: 0.5s;
                            -moz-transition-property: width, background, height;
                            -moz-transition-duration: 0.5s;
                        }
                        #isi {
                            transition-property: width, background, height;
                            transition-duration: 0.5s;
                            -webkit-transition-property: width, background, height;
                            -webkit-transition-duration: 0.5s;
                            -0-transition-property: width, background, height;
                            -0-transition-duration: 0.5s;
                            -moz-transition-property: width, background, height;
                            -moz-transition-duration: 0.5s;
                        }
                    </style>


                        <?php if ($maintance == 1): ?>
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <marquee>
                            <h4 style="color:red; font-weight: bold;"><?php echo $info_maintance; ?></h4>
                            </marquee>
                            <!--
                            <p style="color:black;"><?php echo $info_maintance; ?></p>
                            -->
                        </div>
                        <?php endif;?>
                        <!-- progressbar -->
                        <!-- <ul id="progressbar" style="padding-left: 0">
                            <li class="active">Detail Aduan</li>
                            <li>Data Diri</li>
                            <li>Berkas Pendukung</li>
                        </ul> -->
                        <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4>Gagal!</h4>
                            <p><?php echo $error; ?></p>
                        </div>
                        <?php endif;?>
                        <!-- fieldsets -->
                        <fieldset id="field1">
                          
                            <div class="form-group row">
                                <div id="kolom1" class="alignTeks" style="padding-right: 3%;">
                                <br>
                                <br>
                                  <h2 style="font-weight: bold; margin-top: 0px; margin-bottom: 40px;">
                                  Sistem<br>Layanan<br>Pengaduan<br>Masyarakat<br>Kota Kediri
                                  </h2>
                                  
                                <!--
                                  <h3 style="font-weight: 300; margin-top: -30px; margin-bottom: 40px;">Masukkan hasil testing (hal-hal yang kurang/tidak sesuai) di menu pojok kanan atas yang bertuliskan "Evaluasi"</h3>
                                -->
                                </div>
                                <br>
                                
                                <div id="kolom2" class="verticalLine" style="padding-left: 3%; ">
                                <br>
                                    <label class="col-md-12 control-label" for="isiKeluhan">Isikan Aduan Anda Pada Kotak dibawah ini - <i style="color: #F55384; font-size: 12px;">Wajib diisi</i></label>
                                    <textarea style="width: 100%; resize: vertical; height: 114px;" rows="5" class="form-control <?php echo form_error('isi') ? 'warning' : ''; ?>" id="isi" name="isi"><?php echo set_value('isi') | $landing_isi; ?></textarea>
                                    <br>
                                    <input type="button" name="Next" class="next btn btn-primary pull-right" value="Buat Aduan" />
                                    <br>
                                    <br>
                                    <p class="lead">Atau kirimkan keluhan anda melalui SMS ke nomor <strong style="color: #1E8BC3;">081333702221</strong> dengan format <strong style="color: #1E8BC3;">nik</strong>#<strong style="color: #1E8BC3;">nama</strong>#<strong style="color: #1E8BC3;">isi_aduan</strong>.</p>
                                </div>
                            </div>



                            <!-- di hide karena menyamakan sms -->
                            <div class="form-group row" style="display: none;">
                                <label class="col-md-4 control-label">Topik Pengaduan Anda - <i style="color: #F55384; font-size: 12px;">Wajib diisi</i></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control <?php echo form_error('topik') ? 'warning' : ''; ?>" id="topik" name="topik" value="<?php echo set_value('topik') | $landing_topik; ?>">
                                </div>
                            </div>

                            <!-- di hide karena langsung ke pool -->
                            <div class="form-group row" style="display: none;">
                                <label class="col-md-4 control-label">Pilih Departemen - <i style="color: #F55384; font-size: 12px;">Wajib diisi</i></label>
                                <div class="col-md-8">
                                    <select class="form-control <?php echo form_error('departemen') ? 'warning' : ''; ?>" id="departemen" name="departemen">
                                        <?php foreach ($departemen as $key => $value): ?>
                                        <?php if ($landing_departemen): ?>
                                        <option value="<?php echo $value['id_departemen']; ?>" <?php echo ($landing_departemen == $value['id_departemen']) ? 'selected' : ''; ?>><?php echo $value['nama_departemen']; ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo $value['id_departemen']; ?>" <?php echo set_select('departemen', $value['id_departemen']); ?>><?php echo $value['nama_departemen']; ?></option>
                                        <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>

                           
                                

                          
                            <!--
                            <div class="form-group row">
                                <label class="col-md-4 control-label" for="isiKeluhan">Isi Pengaduan Anda - <i style="color: #F55384; font-size: 12px;">Wajib diisi</i></label>
                                <div class="col-md-8">
                                    <textarea style="width: 100%; resize: vertical; height: 114px;" rows="5" class="form-control <?php echo form_error('isi') ? 'warning' : ''; ?>" id="isi" name="isi"><?php echo set_value('isi') | $landing_isi; ?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="button" name="Next" class="next btn btn-primary pull-right" value="Buat Aduan" />
                                </div>
                            </div>
                              

                            <div class="row" style="margin-top: 20px">
                                <div class="col-md-12 text-center">
                                  <p class="lead">Atau kirimkan keluhan anda melalui SMS ke nomor <strong style="color: #1E8BC3;">081333702221</strong> dengan format <strong style="color: #1E8BC3;">nik</strong>#<strong style="color: #1E8BC3;">nama</strong>#<strong style="color: #1E8BC3;">isi_aduan</strong>.</p>
                                </div>
                            </div>
                            -->
                        </fieldset>

                        <!-- halaman 2-->
                        <fieldset id="field2">
                           

                            <?php if($flag == 0) {?>
                                <br> <br><br><br><br><br><br>
                                 <h4 class="fs-title" style="font-size: 30px; text-align: center">Masukkan Nomor KTP Asli</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Nomor KTP - <i style="color: #F55384; font-size: 12px;">Wajib diisi</i></label>
                                    <div class="col-md-8">
                                        <input size="14" type="text" class="form-control <?php echo form_error('no_identitas') ? 'warning' : ''; ?>" id="no_identitas" name="no_identitas" value="<?php echo set_value('no_identitas'); ?>" maxlength="16">
                                     </div>
                                        
                             
                                </div>
                                <div id="content1">
                                    <input  type="button" align="left" name="previous" class="previous btn btn-warning" value="Kembali" />
                                      
                                                             
                                </div>

                                <div id="content2">
                                     <input  type="submit" align="right" name="cek_ktp"  id="cek_ktp" class="btn btn-info" value="Cek KTP" /> 
          
                                </div>

                            <?php } else {?>

                            <h4 class="fs-title" style="font-size: 30px; text-align: center">DATA ANDA</h4>
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <input type="hidden" class="form-control <?php echo form_error('no_identitas') ? 'warning' : ''; ?>" id="no_identitas" name="no_identitas" value="<?php echo set_value('no_identitas'); ?>" maxlength="16">
                                </div>
                            </div>
                                <div class="form-group row">
                                <label class="col-md-1"></label>
                                <label class="col-md-3 control-label" for="nama">Nama</label>
                                <div class="col-md-8">
                                    
                                    <input type="text" readonly="readonly" style="color:black;" class="form-control <?php echo form_error('nama') ? 'warning' : ''; ?>" id="nama" name="nama" value="<?php echo set_value('nama') | $nama ; ?>" >    
                                    

                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label class="col-md-1"></label>
                                <label  class="col-md-3 control-label" for="nama">Alamat - <i style="color: #F55384; font-size: 12px;">Wajib diisi</i></label>
                                <div class="col-md-8">
                                    
                                    <input type="text" class="form-control <?php echo form_error('alamat') ? 'warning' : ''; ?>" id="alamat" name="alamat" value="<?php echo set_value('alamat') | $alamat; ?>">

                                </div>
                                <!--
                                <input type="button" style="background-color:gray;" value="Edit" onclick="msg()"> 
                                -->
                            </div>
                            <div class="form-group row">
                                <label class="col-md-1"></label>
                                <label  class="col-md-3 control-label" for="nama">Nomor HP</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control <?php echo form_error('no_hp') ? 'warning' : ''; ?>" id="no_hp" name="no_hp" value="<?php echo set_value('no_hp') | $no_hp; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-1"></label>
                                <label  class="col-md-3 control-label" for="nama">Email</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control <?php echo form_error('email') ? 'warning' : ''; ?>" id="email" name="email" value="<?php echo set_value('email') | $email; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-1"></label>
                                <label class="col-md-3 control-label" for="tglLahir">Tanggal Lahir</label>
                                <div class="date col-md-8">
                                    <input type="text" readonly="readonly" style="color:black;" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo set_value('tgl_lahir') | $tgl_lahir ; ?>">
             
                                    <!--
                                    <select id="tanggal" name="tanggal" style="width: 100px">
                                        <?php for ($i=1; $i < 32 ; $i++) {?>
                                            <?php if($day == '') {?>
                                                <option value="<?php echo $i ; ?>" <?php echo set_select('tanggal', $i) ; ?>> <?php echo $i; ?> </option>
                                            <?php } else {?>
            
                                                <option value="<?php echo $i ; ?>" <?php echo set_value('tanggal', $i) ; ?>> <?php echo $i ; ?> </option>
                                            <?php }?>
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
                                    -->
                                    <p class="help-block" style="font-style:italic bold;color: #F55384; font-size: 12.5px;">
                                        * Tanggal lahir sebagai password anda.
                                    </p>
                                </div>
                            </div>
                            <label class="col-md-1"></label>
                            <div class="col-md-3" style="padding-left: 0">
                                <!--
                                <input type="button" name="previous" class="previous btn btn-warning" value="Kembali" />
                                -->
                                <input type="submit" name="reset" id="reset" class="btn btn-warning" value="Batal" />
                            </div>
                           
                                    
                               
                            <div class="col-md-4"><center><input type="button" name="upload" class="next btn btn-info" value="Unggah Berkas Pendukung dan Peta" /></center></div>
                            <div class="col-md-4" style="padding-right: 0"><center><input type="submit" name="submit" id="submit" class="submit btn btn-success pull-right" value="Kirim" /></center></div>

                            <?php }?>  
                               
                                                


                            <!-- fungsi variabel terletak pada class. contoh : pada button dengan nama previous, class diberi nama 
                            previous, btn, dan btn-warning. ini berarti fungsi dari class tersebut telah diinisialisasi. 
                            letaknya dibawah (js) seperti $(.previous)  dan dst. class dibelakangnya hanya merupakan penghias -->
                        </fieldset>

                        <fieldset id="field3">
                            <h4 class="fs-title" style="font-size: 30px; text-align: center">Tambahkan Berkas Pendukung</h4>
                            <label>Unggah Berkas Pendukung</label>
                            <div class="form-group">
                                <p><strong>Catatan: </strong>Unggah Berkas Pendukung (maksimum ukuran berkas: 
                                    <span style="color: #050652">1 MB </span>
                                    dan hanya menerima tipe berkas: 
                                    <span style="color: #050652">jpg, png, gif, pdf, doc/docx, xls/xlsx</span>
                                </p>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-primary btn-file">
                                            Pilih File <input type="file" name="files[]" multiple>
                                        </span>
                                    </span>
                                    <input type="text" class="form-control <?php echo $cur_page == 3 ? 'warning' : ''; ?>" readonly>
                                </div>
                                <div class="cl-md-12">
                                    <div class="col-md-12">
                                    </div>
                                </div>
                                <!-- <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-primary pull-right btn-file">
                                            Unggah&hellip; <input type="file" name="files[]" multiple>
                                        </span>
                                    </span>
                                </div> -->
                            </div>
                            <input type="hidden" id="latitude" name="latitude" value="" />
                            <input type="hidden" id="longitude" name="longitude" value="" />
                            <div class="form-group">
                                <label>Tempat Terjadi</label>
                                <p>Gunakan fasilitas peta di bawah ini untuk menunjukkan lokasi objek yang diadukan, semakin akurat semakin baik (gunakan level zoom paling tinggi)</p>
                                <div id="googleMap" style="width:100%;height:380px;"></div>
                            </div>
                            <div class="col-md-6">
                                <input type="button" name="previous" class="previous btn btn-warning pull-left" value="Kembali" />
                            </div>
                            <div class="col-md-6">
                                <input type="submit" name="submit" class="submit btn btn-success pull-right" value="Kirim" />
                            </div>
                        </fieldset>
                    </form>

                    <script>

                    function msg() {
                        $('#coba').html('<input type="text" class="form-control <?php echo form_error('alamat') ? 'warning' : ''; ?>" id="alamat" name="alamat" value="<?php echo set_value('alamat') | $alamat; ?>">');
                    }
                    //jQuery time
                    $(document).on('change', '.btn-file :file', function() {
                        var input = $(this),
                            numFiles = input.get(0).files ? input.get(0).files.length : 1,
                            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                        input.trigger('fileselect', [numFiles, label]);
                    });
                    var map;
                    var first = true;

                    function initialize() {
                        var location;
                        var mapProp = {
                            center: new google.maps.LatLng(-7.820951, 112.005936),
                            zoom: 14,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

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
                    
                    function cek() {
                        $('.next').click();
                        if (erros == 0) return true;
                        return false;
                    }

                    var current_fs, next_fs, previous_fs;
                    var left, opacity, scale;
                    var animating;
                    var fieldsetn = <?php echo $cur_page; ?>;
                    var erros = 0;

                    if (fieldsetn == 2) {
                        $('#field1').hide();
                        $('#field2').show();
                        $('#field3').hide();
                        $("#progressbar li").eq(1).addClass("active");
                    } else if (fieldsetn == 3) {
                        $('#field1').hide();
                        $('#field2').hide();
                        $('#field3').show();
                        $("#progressbar li").eq(1).addClass("active");
                        $("#progressbar li").eq(2).addClass("active");
                    }

                    $(".cek_ktp").click(function() {
                        if (fieldsetn == 2) {
                            if ($('input[name="no_identitas"]').val().length === 0) {
                                
                                $('input[name="no_identitas"]').addClass('warning');
                                $('input[name="no_identitas"]').attr("placeholder", "No Identitas harus diisi");
                                erros = 1;
                            } else {
                                $('input[name="no_identitas"]').removeClass('warning');
                            }

                        }

                    })

                    // untuk menuju ke halaman selanjutnya
                    $(".next").click(function() {
                        erros = 0;
                        if (fieldsetn == 1) {
                            if ($('input[name="topik"]').val().length === 0) {
                                $('input[name="topik"]').addClass('warning');
                                $('input[name="topik"]').attr("placeholder", "Topik harus diisi");
                                erros = 1;
                            } else {
                                $('input[name="topik"]').removeClass('warning');
                            }
                            if ($('#isi').val().length === 0) {
                                $('#isi').addClass('warning');
                                $('#isi').attr("placeholder", "Isi Aduan harus diisi");
                                // for (name in CKEDITOR.instances) {
                                //     CKEDITOR.instances[name].destroy();
                                // }
                                // $('#isi').ckeditor();
                                erros = 1;
                            } else {
                                $('#isi').removeClass('warning');
                            }
                        } else if (fieldsetn == 2) {
                            if ($('input[name="no_identitas"]').val().length === 0) {
                                $('input[name="no_identitas"]').addClass('warning');
                                $('input[name="no_identitas"]').attr("placeholder", "No Identitas harus diisi");
                                erros = 1;
                            } else {
                                $('input[name="no_identitas"]').removeClass('warning');
                            }
                            if ($('input[name="nama"]').val().length === 0) {
                                $('input[name="nama"]').addClass('warning');
                                $('input[name="nama"]').attr("placeholder", "Nama harus diisi");
                                erros = 1;
                            } else {
                                $('input[name="nama"]').removeClass('warning');
                            }
                            if ($('input[name="alamat"]').val().length === 0) {
                                $('input[name="alamat"]').addClass('warning');
                                $('input[name="alamat"]').attr("placeholder", "Alamat harus diisi");
                                erros = 1;
                            } else {
                                $('input[name="alamat"]').removeClass('warning');
                            }
                        }

                        if (erros === 0) {
                            if (animating) return false;
                            animating = true;
                            fieldsetn = fieldsetn + 1;
                            current_fs = $(this).parent().parent().parent();
                            next_fs = $(this).parent().parent().parent().next();

                            //activate next step on progressbar using the index of next_fs
                            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                            //show the next fieldseta
                            next_fs.show();
                            if (first && fieldsetn == 3) {
                                initialize();
                                first = false;
                            }
                            //hide the current fieldset with style
                            current_fs.animate({
                                opacity: 0
                            }, {
                                step: function(now, mx) {
                                    //as the opacity of current_fs reduces to 0 - stored in "now"
                                    //1. scale current_fs down to 80%
                                    scale = 1 - (1 - now) * 0.2;
                                    //2. bring next_fs from the right(50%)
                                    left = (now * 50) + "%";
                                    //3. increase opacity of next_fs to 1 as it moves in
                                    opacity = 1 - now;
                                    current_fs.css({
                                        'transform': 'scale(' + scale + ')'
                                    });
                                    next_fs.css({
                                        'left': left,
                                        'opacity': opacity
                                    });
                                },
                                duration: 800,
                                complete: function() {
                                    current_fs.hide();
                                    animating = false;
                                },
                                //this comes from the custom easing plugin
                                easing: 'easeInOutBack'
                            });
                        } //fim da animação  
                    }); //fim do click

                    // untuk menuju ke halaman sebelumnya
                    $(".previous").click(function() {
                        if (animating) return false;
                        animating = true;
                        fieldsetn = fieldsetn - 1;

                        current_fs = $(this).parent().parent();
                        previous_fs = $(this).parent().parent().prev();

                        //de-activate current step on progressbar
                        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

                        //show the previous fieldset
                        previous_fs.show();
                        if (first && fieldsetn == 3) {
                            initialize();
                            first = false;
                        }
                        //hide the current fieldset with style
                        current_fs.animate({
                            opacity: 0
                        }, {
                            step: function(now, mx) {
                                //as the opacity of current_fs reduces to 0 - stored in "now"
                                //1. scale previous_fs from 80% to 100%
                                scale = 0.8 + (1 - now) * 0.2;
                                //2. take current_fs to the right(50%) - from 0%
                                left = ((1 - now) * 50) + "%";
                                //3. increase opacity of previous_fs to 1 as it moves in
                                opacity = 1 - now;
                                current_fs.css({
                                    'left': left
                                });
                                previous_fs.css({
                                    'transform': 'scale(' + scale + ')',
                                    'opacity': opacity
                                });
                            },
                            duration: 800,
                            complete: function() {
                                current_fs.hide();
                                animating = false;
                            },
                            //this comes from the custom easing plugin
                            easing: 'easeInOutBack'
                        });
                    });

                    $(document).ready(function() {
                       // $('#coba').html('<input type="text" class="form-control <?php echo form_error('alamat') ? 'warning' : ''; ?>" id="alamat" name="alamat" value="<?php echo set_value('alamat') | $alamat; ?>">');
                 
                        google.maps.event.addDomListener(window, 'load', initialize);
                        // $('#isi').ckeditor();
                        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
                            var input = $(this).parents('.input-group').find(':text'),
                                log = numFiles > 1 ? numFiles + ' File telah dipilih' : label;
                            if (input.length) {
                                input.val(log);
                            } else {
                                if (log) console.log(log);
                            }
                        });

                        $("#tanggal").select2();
                        $("#bulan").select2();
                        $("#tahun").select2();
                        $("#departemen").select2();

                        $('#isi').on("focus", function(event) {
                            if(!$('#isi').hasClass('customTextAreaClass')){
                                $('#isi').addClass('customTextAreaClass');
                            }
                        });
                        $('#isi').on("blur", function(event) {
                            if($('#isi').hasClass('customTextAreaClass')){
                                $('#isi').removeClass('customTextAreaClass');
                            }
                        });

                    });
                    
                    </script>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>