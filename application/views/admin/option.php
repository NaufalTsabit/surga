<style type="text/css">
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

    h3 {
        border-bottom: thin groove black;
        padding-bottom: 0px;

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
</style>

<h3>Jalur sms gateway </h3>

<form class="well" role="form" method="POST" action="<?php echo site_url('admin/option'); ?>">
	
	<?php if (isset($error)): ?>
    <div class="alert alert-danger" role="alert">Error!<?php echo $error; ?></div>
    <?php endif;?>
    <?php if (isset($success)): ?>
    <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
    <?php endif;?>

   

    <div class="form-group">
        <p>
        	<?php if ($nilai_option == 1) {?>
            	<input type="radio" name="nilai_option" value="1" checked> Via Pemkot
            	<br>
            	<input type="radio" name="nilai_option" value="0"> Via Modem
            <?php } else {?>
			  	
			  	<input type="radio" name="nilai_option" value="1" > Via Pemkot
			  	<br>
				<input type="radio" name="nilai_option" value="0" checked> Via Modem
			<?php } ?>
        </p>
    </div>

   

   <!--
    <input type="submit" class="btn btn-primary" name="excel" value="Download Excel">
    -->
     <input type="submit" class="btn btn-primary" name="update" value="Update">
    <!-- <input type="submit" class="btn btn-primary" name="word" value="Download Word"> -->
</form>


