<style type="text/css">
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    table {
    border: 1px solid black;
	}

    td {
    border: 1px solid darkgrey;
	}
	th {
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
        background-color: #FF0000;
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
    
    .hehe {

        border-color: #000;
        border-style: solid;
        outline-color: #000;
    }

    .ukuran {
        font-size:13px;
    }

    #content1 {
    float: left;
    width: 67%;

    }
    #content2 {
        float: left;
        width: 15%;
        
    }
    #content3 {
        float: right;
        width: 15%;
        
    }

    h3 {
        border-bottom: thin groove black;
        padding-bottom: 0px;

    }
</style>

<h3 align="center">Berita Seputar Kota Kediri</h3>

<div style="padding-left: 0;" class="col-md-7">

</div>

<div style="padding-right: 0;" class="col-md-5">
    <div style="padding-right: 0; " class="col-md-6">
        <p> <font color="black">Cari Berdasarkan Kolom:  </font> </p>
        <select id="cari" name="cari" style="width: 100%">
            <option value="-1" selected="selected">Semua Kolom</option> 
            <option value="0">ID</option>
            <option value="1">Deskripsi</option>
           
        </select>
    </div>

    <div style="padding-right: 0;" class="col-md-6">
        <p> <font color="black">Masukkan Keyword</font> </p>
        <p id="text_keyword"></p>
    </div>
    
</div>




<br><br><br><br>

<table id="list_konten" class="table ukuran">
    <thead>
        <tr class="as">
            <th>id</th>
            <th>Deskripsi</th>
            <th style="display:none;">Waktu</th>
            <th>Link</th>
 

        </tr>
    </thead>

    <tbody  >
        <?php foreach ($list_konten as $key => $value): ?>

        <tr class="as">
            
            <td align="center"><?php echo ($key + 1); ?></td>
            <td>
                <p style="font-size: 20px">  <?php echo $value['title']; ?> </p> 
                <p><?php echo $value['desc']; ?>  </p>
                <p> <span class="glyphicon glyphicon-time">  </span> <?php echo $value['waktu']; ?></p>
            </td>
            <td style="display:none;"><?php echo $value['temp_waktu']; ?></td>
            <td align="center"><a class="btn btn-info" href="<?php echo ($value['url']); ?>" target="_blank" >Detail</a></td>
   


            
        </tr>
        <?php endforeach;?>
    </tbody>
</table>




<!-- timeago js digunakan untuk waktu -->
<script type="text/javascript">

$(document).ready(function() {
    $("abbr.timeago").timeago();
        var table = $('#list_konten').DataTable( {
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "data tidak tersedia",
                "info": "Halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "sSearch": "cari"
            },
            "order": [[ 2, "desc" ]],
             "dom": '<"top"flp<"clear">>rt<"bottom"ip<"clear">>'
        } )

        table.$('tr:odd').css('backgroundColor', '#E0E0E0');



        var $el = $('#cari');
        $el.data('oldVal',  $el.val() );

        //var x = $el.val();
        var title = $el.val();
        $('#text_keyword').html('<input title="temp" style="height:23px; width: 100%" type="text" id="'+title+'" placeholder="masukkan keyword " />');

        
         $('input[title="temp"]').keyup(function(){
                table
                .search($(this).val()).draw() ;
          
        });

        $el.change(function(){
       
            var $this = $(this);
            var newValue = $this.data('newVal', $this.val());  
            var title = $this.val();
            
            if(title == -1){
                //document.getElementById("demo").innerHTML =  $this.val();
                
                $('#text_keyword').html('<input title="temp" style="height:23px; width:100%" type="text" id="'+title+'" placeholder="masukkan keyword " />');

                $('input[title="temp"]').keyup(function(){
                        table
                        .search($(this).val()).draw() ;
                  
                });
                    
            } else {

                $('#text_keyword').html('<input title="temp" style="height:23px; width:100%" type="text" id="'+title+'" placeholder="masukkan keyword " />');

                $('input[title="temp"]').keyup(function () {
                    table
                        .column( $this.val() )
                        .search( this.value )
                        .draw();
                  
                });
            }

        })
        .focus(function(){
            // Get the value when input gains focus
            var oldValue = $(this).data('oldVal');
        });
   

} );

</script>