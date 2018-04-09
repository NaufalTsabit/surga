    </div>
</div>
<div class="docs-header" style="min-height: 90%;">
    <div class="topic" style="min-height: 100%; z-index: 999; padding: 0px 0 20px;">
        <div class="container" style="color: rgba(50, 142, 208, 0.9);">
            <div class="col-md-12" style="margin-top: 5%;">
                <style type="text/css">
                    tfoot input {
                        width: 100%;
                        padding: 3px;
                        box-sizing: border-box;
                    }

                    .bordTabel {
                        border: 1px solid black;
                    }

                    .bordTabel td, .bordTabel th {
                        border: 1px solid darkgrey;
                    }
                    .pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover {
                        background-color: #4EA9F7;
                        border-color: #4EA9F7;
                        color: #fff !important;
                    }

                    .modal {
                      text-align: center;
                    }

                    .modal:before {
                      display: inline-block;
                      vertical-align: middle;
                      content: " ";
                      height: 100%;
                    }

                    .modal-dialog {
                      display: inline-block;
                      text-align: left;
                      vertical-align: middle;
                    }
                    .pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
                        color: #aab2bd;
                    }
                    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
                        background-color: #37bc9b;
                        border-color: #37bc9b;
                        color: #fff !important;
                    }
                    .topic .container .pagination>li>a, .topic .container .pagination>li>span {
                        color: #747474;
                        text-decoration: none;
                    }
                    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate  {
                        color: #000;
                        font-weight: bold;
                    }
                    .table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
                        vertical-align: middle;
                        color: #fff;
                        text-align: center;
                    }
                    .badge, .label {
                        background-color: #3BAFDA;
                    }
                    .nav>li>a:focus, .nav>li>a:hover {
                        background-color: #FFF;
                        color: #3BAFDA;
                    }
                     .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
                        text-decoration: none;
                     }
                     .topic .container a {
                        text-decoration: none;
                     }
                    .dataTables_filter {
                         display: none;
                    }
                    .flexigrid div.form-div input[type=text] {                
                                font-size: 16px;  
                                height:35px;      
                    }
                    tr.as {
                        color: black;
                        background-color: #3BAFDA;
                    }
                    .tablepress thead tr th,
                    .tablepress tfoot th {
                        background-color: #000000;
                    }
                    .table {

                        border-color: #000;
                        border-style: solid;
                        outline-color: #000;
                    }
                    
                    h3 {
                        border-bottom: thin groove black;
                        padding-bottom: 0px;

                    }
                     .highcharts-container {
                        width: 100% !important;
                     }

                     h3 {
                            border-bottom: thin groove black;
                            padding-bottom: 0px;

                        }
                </style>

                <h3 style="color:black; font-weight: bold; font-size: 35px;">STATISTIK</h3>
                <div class="tabbable">
                    <ul class="nav nav-pills nav-justified">
                        <li class="active">
                            <a href="#panel-aduan" data-toggle="tab">Statistik Pelayanan</a>
                        </li>
                        <li>
                            <a href="#panel-petugas" data-toggle="tab">Statistik Petugas</a>
                        </li>
                        <li>
                            <a href="#panel-waktu" data-toggle="tab">Statistik Pelayanan Berdasarkan Waktu Terselesaikannya Aduan</a>
                        </li>
                        <li>
                            <a href="#panel-rating" data-toggle="tab">Statistik Rerata Rating Aduan</a>
                        </li>
                        <li>
                            <a href="#panel-download" data-toggle="tab">Download Laporan</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('login'); ?>">Kembali</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="panel-aduan">
                            <div id="alladuancontainer"></div>
                            <br/><br/>
                            <div class="form-group">
                            
                                <select id="bulan" name="bulan" style="width: 200px">
                                    <option <?php if ('1' == date('m')) echo "selected";?> value="1">Januari</option> 
                                    <option <?php if ('2' == date('m')) echo "selected";?> value="2">Februari</option>
                                    <option <?php if ('3' == date('m')) echo "selected";?> value="3">Maret</option>
                                    <option <?php if ('4' == date('m')) echo "selected";?> value="4">April</option>
                                    <option <?php if ('5' == date('m')) echo "selected";?> value="5">Mei</option>
                                    <option <?php if ('6' == date('m')) echo "selected";?> value="6">Juni</option>
                                    <option <?php if ('7' == date('m')) echo "selected";?> value="7">Juli</option>
                                    <option <?php if ('8' == date('m')) echo "selected";?> value="8">Agustus</option>
                                    <option <?php if ('9' == date('m')) echo "selected";?> value="9">September</option>
                                    <option <?php if ('10' == date('m')) echo "selected";?> value="10">Oktober</option>
                                    <option <?php if ('11' == date('m')) echo "selected";?> value="11">November</option>
                                    <option <?php if ('12' == date('m')) echo "selected";?> value="12">Desember</option>
                                </select>
                            
                                &nbsp;
                                <select id="tahun" name="tahun" style="width: 200px">
                                    <?php for ($i = date('Y'); $i >= 2014 ; $i--): ?>
                                        <option value="<?php echo $i;?>" <?php if ($i == date('Y')) echo "selected";?> ><?php echo $i;?></option>
                                    <?php endfor;?>
                                </select>
                            
                                &nbsp;
                                <select id="kategori" name="kategori" style="width: 200px">
									<option value="semua">Semua Kategori</option>
                                    <?php foreach ($kategori as $key => $value): ?>
                                        <option value="<?php echo $value['id_kategori'];?>"><?php echo $value['nama_kategori'];?></option>
                                    <?php endforeach;?>
                                </select>
                            
                                &nbsp;
                                <select id="status" name="status" style="width: 200px">
									<option value="semua">Semua Aduan Masuk</option>
									<option value="terjawab">Aduan Terjawab</option>
									<option value="belum">Aduan Belum Terjawab</option>
                                </select>
                            
                                &nbsp;
								
								Jumlah = 
								<input type="text" id="totaladuan" name="totaladuan" value="-" disabled style="color: #000;font-weight: bold">
								
                            </div>
							
							<div id="googleMap" style="width:100%;height:380px;"></div>
							<br/>
							
							<b>MAP LEGEND = </b> 
								<?php 
								foreach ($kategori as $key => $value): 	
									if( $value['id_kategori'] == '1' ) {
										echo $value['nama_kategori'] . ' ( ' . 
											"<img src='assets/map_marker/1_JalanPJU_Hijau.png'>"
											. ' ) ; ';
									} else if( $value['id_kategori'] == '2' ) {
										echo $value['nama_kategori'] . ' ( ' . 
											"<img src='assets/map_marker/2_Kebersihan_Hijau.png'>"
											. ' ) ; ';
									} else if( $value['id_kategori'] == '3' ) {
										echo $value['nama_kategori'] . ' ( ' . 
											"<img src='assets/map_marker/3_Pendidikan_Hijau.png'>"
											. ' ) ; ';
									} else if( $value['id_kategori'] == '4' ) {
										echo $value['nama_kategori'] . ' ( ' . 
											"<img src='assets/map_marker/4_Kesehatan_Hijau.png'>"
											. ' ) ; ';
									} else if( $value['id_kategori'] == '5' ) {
										echo $value['nama_kategori'] . ' ( ' . 
											"<img src='assets/map_marker/5_Bansos_Hijau.png'>"
											. ' ) ; ';
									} else if( $value['id_kategori'] == '6' ) {
										echo $value['nama_kategori'] . ' ( ' . 
											"<img src='assets/map_marker/6_Lainlain_Hijau.png'>"
											. ' ) ; ';
									} else { 
										echo $value['nama_kategori'] . ' ( ' . 
											"<img src='assets/gmapicons/green.png'>"
											. ' ) ; ';
									}
								endforeach;
								?> 
							<br/><br/>
                            
							<div>
                                <div id="aduancontainer"></div>
                            </div>
                            <center><h2>Versi Tabel</h2></center>
                            <table id="aduan_stat" class="table highchart ukuran bordTabel" data-graph-container="#aduancontainer" data-graph-type="column">
                                <thead>
                                    <tr class="as">
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Departemen
                                        </th>
                                        <th>
                                            Jumlah Pengaduan
                                        </th>
                                        <th>
                                            Pengaduan Terjawab
                                        </th>
                                        <th>
                                            Pengaduan Belum Terjawab
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($stat_aduan as $key => $value): ?>
                                        <tr class="as">
                                            <td><?php echo $value['id_departemen']?></td>
                                            <td><?php echo $value['nama_departemen']?></td>
                                            <td><?php echo $value['masuk']?></td>
                                            <td><?php echo $value['terjawab']?></td>
                                            <td><?php echo $value['belum_terjawab']?></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>          
                        </div>
                        
                        <div class="tab-pane active" id="panel-petugas">
                            <br/><br/>
                            <div class="form-group">
<!--                                <select id="departement" name="departement" style="width: 200px">
                                    <option></option> 
                                </select>-->
<!--                                <select id="pbulan" name="pbulan" style="width: 200px">
                                    <option <?php if ('1' == date('m')) echo "selected";?> value="1">Januari</option> 
                                    <option <?php if ('2' == date('m')) echo "selected";?> value="2">Februari</option>
                                    <option <?php if ('3' == date('m')) echo "selected";?> value="3">Maret</option>
                                    <option <?php if ('4' == date('m')) echo "selected";?> value="4">April</option>
                                    <option <?php if ('5' == date('m')) echo "selected";?> value="5">Mei</option>
                                    <option <?php if ('6' == date('m')) echo "selected";?> value="6">Juni</option>
                                    <option <?php if ('7' == date('m')) echo "selected";?> value="7">Juli</option>
                                    <option <?php if ('8' == date('m')) echo "selected";?> value="8">Agustus</option>
                                    <option <?php if ('9' == date('m')) echo "selected";?> value="9">September</option>
                                    <option <?php if ('10' == date('m')) echo "selected";?> value="10">Oktober</option>
                                    <option <?php if ('11' == date('m')) echo "selected";?> value="11">November</option>
                                    <option <?php if ('12' == date('m')) echo "selected";?> value="12">Desember</option>
                                </select>
                                &nbsp;
                                <select id="ptahun" name="ptahun" style="width: 200px">
                                    <?php for ($i = date('Y'); $i >= 2014 ; $i--): ?>
                                        <option value="<?php echo $i;?>" <?php if ($i == date('Y')) echo "selected";?> ><?php echo $i;?></option>
                                    <?php endfor;?>
                                </select>-->
                            </div>
                            <div>
                                <div id="petugasContainer"></div>
                            </div>
                            <center><h2>Versi Tabel</h2></center>
                            <table id="petugas_stat" class="table highchart ukuran bordTabel" data-graph-container="#petugasContainer" data-graph-type="column">
                                <thead>
                                    <tr class="as">
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Nama Petugas
                                        </th>
                                        <th>
                                            Aduan ditujukan
                                        </th>
                                        <th>
                                            Aduan Terjawab
                                        </th>
                                        <th>
                                            Aduan Belum Terjawab
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 0;
                                    foreach ($stat_petugas as $key => $value): ?>
                                        <tr class="as">
                                            <td><?php echo ++$count;?></td>
                                            <td><?php echo $value['nama_petugas']?></td>
                                            <td><?php echo $value['tuju']?></td>
                                            <td><?php echo $value['jawab']?></td>
                                            <td><?php echo $value['belum']?></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>          
                        </div>
                        <div class="tab-pane " id="panel-waktu">
                            <div class="row">
                                <div class="col-md-12" id="waktucontainer">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <center><h2>Versi Tabel</h2></center>
                                    <table id="waktu_stat" class="table highchart ukuran bordTabel" data-graph-container="#waktucontainer" data-graph-type="column">
                                        <thead>
                                            <tr class="as">
                                                <th>
                                                    Departemen
                                                </th>
                                                <th>
                                                    Waktu rata-rata penyelesaian (dalam jam)
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($stat_waktu as $key => $value): ?>
                                                <tr class="as">
                                                    <td><?php echo $value['nama_departemen']?></td>
                                                    <td><?php echo $value['waktu']?></td>
                                                </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="panel-rating">
                            <div class="col-md-12">
                                <b><p style="color: #fff">Ket: Rating dari 1-5 (buruk-sangat baik)</p></b>
                            </div>
                            <div class="col-md-12" id="ratingcontainer" style="margin-bottom: 20px;"></div>
                            <br/><br/><br/> 
                            <center><h2>Versi Tabel</h2></center>
                            <table id="rating_stat" class="table highchart ukuran bordTabel" data-graph-container="#ratingcontainer" data-graph-type="column">
                                <thead>
                                    <tr class="as">
                                        <th>
                                            Departemen
                                        </th>
                                        <th>
                                            Rerata Rating
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="as">
                                    <?php foreach ($stat_rating as $key => $value): ?>
                                        <tr>
                                            <td><?php echo $value['nama_departemen']?></td>
                                            <td><?php echo $value['rerata']?></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="panel-download">
                            <form class="well form-inline" role="form" method="POST" action="<?php echo site_url('statistik/download_laporan'); ?>">
                                <h3 style="color: #4DB7E0;">Download Laporan Tahunan</h3>
                                <div class="form-group">
                                    <label class="sr-only">Pilih Periode</label>
                                     <select class="form-control" id="periode" name="periode" style="width: 200px">
                                        <option value="tahunan">Tahunan</option>
                                        <option value="bulanan">Bulanan</option>
                                    </select>
                                </div>
                                <div class="form-group" id="bulan_container" style="display:none">
                                    <label class="sr-only">Bulan Laporan</label>
                                     <select class="form-control" id="bulan" name="bulan" style="width: 200px">
                                        <option value="0" selected>Bulan Laporan</option>
                                        <option value="1">Januari</option> 
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="form-group" id="tahun_container">
                                    <label class="sr-only">Tahun Laporan</label>
                                     <select class="form-control" id="tahun" name="tahun" style="width: 200px">
                                        <option value="0">Tahun Laporan</option>
                                        <?php for ($i = date('Y'); $i >= 2014 ; $i--): ?>
                                        <option value="<?php echo $i;?>" <?php if ($i == date('Y')) echo "selected";?> ><?php echo $i;?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Download Laporan">
                                </div>
                                <!-- <input type="submit" class="btn btn-primary" name="excel" value="Download Excel"> -->
                                <!-- <input type="submit" class="btn btn-primary" name="word" value="Download Word"> -->
                            </form>
                        </div>
                    </div>
                </div>

                <script type="text/javascript" src="<?php echo base_url('assets/js/chart/Chart.js'); ?>"></script>
                <script type="text/javascript">
				
					var map;
					function initialize() {
						var location;
						var mapProp = {
							center: new google.maps.LatLng(-7.820951, 112.005936),
							zoom: 12,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						};
						map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
						
								var bulanx = $('#bulan').val();
								var tahunx = $('#tahun').val();
								var kategorix = $('#kategori').val();
								var statusx = $('#status').val();
								$.get( "<?php echo site_url('api/get_longlat_by_month_year');?>"+'/'+bulanx+'/'+tahunx+'/'+kategorix+'/'+statusx, function( data ) {
									var jumlah = 0;
									$.each(data, function( index, value ) {
										jumlah++;
										if ( value.latitude != '' && value.latitude != '') {
											var image;
											if( value.kategori == '1' ) {
												if( value.status == '4' ) { 
													image = 'assets/map_marker/1_JalanPJU_Hijau.png';
												} else {
													image = 'assets/map_marker/1_JalanPJU_Merah.png';
												}
											} else if( value.kategori == '2' ) {
												if( value.status == '4' ) { 
													image = 'assets/map_marker/2_Kebersihan_Hijau.png';
												} else {
													image = 'assets/map_marker/2_Kebersihan_Merah.png';
												}
											} else if( value.kategori == '3' ) {
												if( value.status == '4' ) { 
													image = 'assets/map_marker/3_Pendidikan_Hijau.png';
												} else {
													image = 'assets/map_marker/3_Pendidikan_Merah.png';
												}
											} else if( value.kategori == '4' ) {
												if( value.status == '4' ) { 
													image = 'assets/map_marker/4_Kesehatan_Hijau.png';
												} else {
													image = 'assets/map_marker/4_Kesehatan_Merah.png';
												}
											} else if( value.kategori == '5' ) {
												if( value.status == '4' ) { 
													image = 'assets/map_marker/5_Bansos_Hijau.png';
												} else {
													image = 'assets/map_marker/5_Bansos_Merah.png';
												}
											} else if( value.kategori == '6' ) {
												if( value.status == '4' ) { 
													image = 'assets/map_marker/6_Lainlain_Hijau.png';
												} else {
													image = 'assets/map_marker/6_Lainlain_Merah.png';
												}
											} else {
												if( value.status == '4' ) { 
													image = 'assets/gmapicons/green.png';
												} else {
													image = 'assets/gmapicons/red.png';
												}
											}
							
											var citMarker = new google.maps.Marker({
												position: new google.maps.LatLng(value.latitude, value.longitude),
												map: map,
												icon: image 
											});

											var infowindow = new google.maps.InfoWindow({
												content: value.nama + " (" + value.no_hp + ") - " + value.isi + ' (' + value.nama_kategori + ') - ' + value.nama_departemen + ' , ' + value.waktu
											});

											google.maps.event.addListener(citMarker, 'click', function() {
												map.setZoom(15);
												map.setCenter(citMarker.getPosition());
												infowindow.open(map, citMarker);
											});
										}
									});

									document.getElementById("totaladuan").value = "   " + jumlah;
								}, "json" );
					}
	
                    $("#periode").on('change', function() {
                        if ($(this).val() == 'tahunan'){
                            $("#bulan_container").hide(500);
                        }
                        if ($(this).val() == 'bulanan'){
                            $("#bulan_container").show(500);
                        }
                        
                    });
                    $(document).ready(function() {
                        $("#bulan").select2();
                        $("#tahun").select2();
                        $("#kategori").select2();
                        $("#status").select2();

                        $('#bulan').change(function() {
                            changeStatAduan();
                        });
                        $('#tahun').change(function() {
                            changeStatAduan();
                        });
                        $('#kategori').change(function() {
                            changeStatAduan();
                        });
                        $('#status').change(function() {
                            changeStatAduan();
                        });
                        
                        $("#pbulan").select2();

                        $("#ptahun").select2();

                        $('#pbulan').change(function() {
                            changeStatPetugas();
                        });

                        $('#ptahun').change(function() {
                            changeStatPetugas();
                        });
                        
                        $('#petugas_stat').dataTable({
                            'order': [[2,"desc"]]
                        });
                        $('#waktu_stat').dataTable();
                        $('#rating_stat').dataTable({
                            "order": [[ 1, "desc" ]]
                        });

                        loadAduanChart();
                        loadPetugasChart();
                        loadRatingChart();
                        loadWaktuChart();
						google.maps.event.addDomListener(window, 'load', initialize);

                        function changeStatAduan()
                        {
                            $('#aduan_stat').dataTable().fnDestroy();
                            var bulan = $('#bulan').val();
                            var tahun = $('#tahun').val();
                            $.get( "<?php echo site_url('api/get_longlat_by_month_year');?>"+'/'+bulan+'/'+tahun, function( data ) {
                                $("#aduan_stat").find("tbody tr").remove();
                                $.each(data, function( index, value ) {
                                    $('#aduan_stat tbody').append("<tr><td>"+value.id_departemen+"</td><td>"+value.nama_departemen+"</td><td>"+value.masuk+"</td><td>"+value.terjawab+"</td><td>"+value.belum_terjawab+"</td></tr>");
                                });
                                loadAduanChart();
                            }, "json" );
							initialize();

                        }

                        function loadAduanChart()
                        {
                            $('#aduan_stat').dataTable().fnDestroy();
                            var categories = [];
                            var id_categories = [];
                            var masuk = [];
                            var terjawab = [];
                            var belum_terjawab = [];
                            $("#aduan_stat tbody tr").each(function(){
                                id_categories.push($(this).find("td").eq(0).text());
                                categories.push($(this).find("td").eq(1).text());
                                masuk.push(parseInt($(this).find("td").eq(2).text()));
                                terjawab.push(parseInt($(this).find("td").eq(3).text()));
                                belum_terjawab.push(parseInt($(this).find("td").eq(4).text()));

                            });
                            $('#aduan_stat').dataTable();

                            $('#aduancontainer').highcharts({
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'Statistik Aduan'
                                },
                                xAxis: {
                                    categories: categories,
                                    //label: id_categories,
                                    min: 0,
                                    max: 10

                                },
                                /*},{
                                    categories: id_categories,
                                    min: 0,
                                    max: 10
                                }],
                                */
                                yAxis: {                    
                                    title: {
                                        text: 'Jumlah'
                                    }
                                },
                                 scrollbar: {
                                    enabled: true
                                },
                                tooltip: {
                                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                                },
                                plotOptions: {
                                    column: {
                                        pointPadding: 0.2,
                                        borderWidth: 0
                                    }
                                },
                                series: [{
                                    name: 'Masuk',
                                    data: masuk,
                                    color: '#0000FF',
                                    cursor: 'pointer',
                                    point: {
                                        events: {
                                            click: function () {
                                                var temp = this.x + 1;

                                                var bulan = $('#bulan').val();
                                                var tahun = $('#tahun').val();
                                                var url_detail = "statistik/get_aduan_masuk_departemen/0/" + temp + "/" + bulan + "/"+ "/" + tahun;

                                                //window.location.href = url_detail;

                                               
                                                window.location.href = url_detail;
                                              //alert('Category: ' + this.category + ', value: ' + this.x);
                                            }
                                        }
                                    }

                                }, {
                                    name: 'Terjawab',
                                    data: terjawab,
                                    color: '#00FF00',
                                    point: {
                                        events: {
                                            click: function () {
                                                var temp = this.x + 1;

                                                var bulan = $('#bulan').val();
                                                var tahun = $('#tahun').val();
                                                var url_detail = "statistik/get_aduan_masuk_departemen/4/" + temp + "/" + bulan + "/"+ "/" + tahun;

                                                window.location.href = url_detail;
                                              //alert('Category: ' + this.category + ', value: ' + this.y);
                                            }
                                        }
                                    }
                                    
                                }, {
                                    name: 'Belum Terjawab',
                                    data: belum_terjawab,
                                    color: '#FF0000',
                                    point: {
                                        events: {
                                            click: function () {
                                                var temp =  this.x + 1;

                                                var bulan = $('#bulan').val();
                                                var tahun = $('#tahun').val();
                                                var url_detail = "statistik/get_aduan_masuk_departemen/2/" + temp + "/" + bulan + "/"+ "/" + tahun;

                                                window.location.href = url_detail;
                                              //alert('Category: ' + this.category + ', value: ' + this.y);
                                            }
                                        }
                                    }
                                }]
                            });
                        }
                        
                        function loadPetugasChart()
                        {
                            <?php
                                $categories = array();
                                $tuju = array();
                                $jawab = array();
                                $belum = array();
                                foreach ($stat_petugas as $key => $value) {
                                    array_push($categories, $value['nama_petugas']);
                                    array_push($tuju, $value['tuju']);
                                    array_push($jawab, $value['jawab']);
                                    array_push($belum, $value['belum']);
                                }
                            ?>
                            var categories = <?php echo json_encode($categories); ?>;
                            var tuju = <?php echo json_encode($tuju); ?>;
                            var jawab = <?php echo json_encode($jawab); ?>;
                            var belum = <?php echo json_encode($belum); ?>;
                            $('#petugasContainer').highcharts({
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'Statistik Petugas'
                                },
                                xAxis: {
                                    categories: categories,
                                    min: 0,
                                    max: 10
                                },
                                yAxis: {                    
                                    title: {
                                        text: 'Jumlah Aduan'
                                    }
                                },
                                 scrollbar: {
                                    enabled: true
                                },
                                tooltip: {
                                    valueSuffix: ' Aduan',
                                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                                },
                                plotOptions: {
                                    size:'100%',
                                    column: {
                                        pointPadding: 0.2,
                                        borderWidth: 0
                                    }
                                },
                                series: [
                                    {
                                        name: 'Aduan Ditujukan',
                                        data: tuju
                                    },
                                    {
                                        name: 'Aduan Terjawab',
                                        data: jawab
                                    },
                                    {
                                        name: 'Aduan Belum Terjawab',
                                        data: belum
                                    },
                                ]
                            });
                        }
                        
                        function loadRatingChart()
                        {
                            <?php
                                $categories = array();
                                $rerata = array();
                                foreach ($stat_rating as $key => $value) {
                                    array_push($categories, $value['nama_departemen']);
                                    array_push($rerata, (double)$value['rerata']);
                                }
                            ?>
                            var categories = <?php echo json_encode($categories); ?>;
                            var rerata = <?php echo json_encode($rerata); ?>;
                            $('#ratingcontainer').highcharts({
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'Statistik Rating'
                                },
                                xAxis: {
                                    categories: categories,
                                    min: 0,
                                    max: 10
                                },
                                yAxis: {                    
                                    title: {
                                        text: 'Rerata'
                                    }
                                },
                                 scrollbar: {
                                    enabled: true
                                },
                                tooltip: {
                                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                                },
                                plotOptions: {
                                    column: {
                                        pointPadding: 0.2,
                                        borderWidth: 0
                                    }
                                },
                                series: [{
                                    name: 'Rerata',
                                    data: rerata
                                }]
                            });
                        }

                        function loadWaktuChart()
                        {
                            <?php
                                $categories = array();
                                $rerata = array();
                                foreach ($stat_waktu as $key => $value) {
                                    array_push($categories, $value['nama_departemen']);
                                    array_push($rerata, (double)$value['waktu']);
                                }
                            ?>
                            var categories = <?php echo json_encode($categories); ?>;
                            var rerata = <?php echo json_encode($rerata); ?>;
                            $('#waktucontainer').highcharts({
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'Statistik Waktu'
                                },
                                xAxis: {
                                    categories: categories,
                                    min: 0,
                                    max: 10
                                },
                                yAxis: {                    
                                    title: {
                                        text: 'Rerata (jam)'
                                    }
                                },
                                 scrollbar: {
                                    enabled: true
                                },
                                tooltip: {
                                    valueSuffix: ' jam',
                                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                                },
                                plotOptions: {
                                    size:'100%',
                                    column: {
                                        pointPadding: 0.2,
                                        borderWidth: 0
                                    }
                                },
                                series: [{
                                    name: 'Rerata',
                                    data: rerata
                                }]
                            });
                        }

                        

                        $('#alladuancontainer').highcharts({
                            title: {
                                text: 'Statistik Seluruh Aduan Sepanjang Waktu',
                                x: -20 //center
                            },
                            chart: {
                                type: 'column'
                            },
                            xAxis: {
                                categories: ['Sepanjang Waktu']              
                            },
                            yAxis: {                    
                                title: {
                                    text: 'Jumlah'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                    series: {
                                        column: {
                                        pointPadding: 0.2,
                                        borderWidth: 0
                                    }
                                    
                                }
                            },
                            series: [{
                                name: 'Masuk',
                                data: [<?php echo $jumlah_all['masuk']; ?>],
                                color: '#0000FF',
                                //ownURL:'http://www.google.com',
                                cursor: 'pointer',
                                    point: {
                                        events: {
                                            click: function () {
                                                //alert('Category: ' + this.category + ', value: ' + this.y);
                                                //return '<a href="http://www.java2s.com"></a>';
                                                window.location.href = "statistik/get_aduan_masuk/0"
                                                //window.location = 'http://www.google.com';
                                                //window.open('http://www.google.com'); -> bisa digunakan untuk new window
                                            }
                                        }
                                    }
                                                                
                            }, {
                                name: 'Terjawab',
                                data: [<?php echo $jumlah_all['terjawab']; ?>],
                                color: '#00FF00',
                                cursor: 'pointer',
                                    point: {
                                        events: {
                                            click: function () {                                       
                                                window.location.href = "statistik/get_aduan_masuk/4"
                                            }
                                        }
                                    }
            
                            }, {
                                name: 'Belum Terjawab',
                                data: [<?php echo $jumlah_all['belum_terjawab']; ?>],
                                color: '#FF0000',
                                cursor: 'pointer',
                                    point: {
                                        events: {
                                            click: function () {
                                                window.location.href = "statistik/get_aduan_masuk/2"
                                            }
                                        }
                                    }
                            },]
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>