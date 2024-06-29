<style>    
        .table {
            width: 45%;
            border-spacing: 0;
        }
       
        .table tr td,
        .table tr th {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;  
            border-top: 1px solid #000;
            border-left: 1px solid #000;           
            padding: 4px;
            
        }
        .table tr:first-child td,
        .table tr:first-child th {
            border-top: 1px solid #000;
            border-left: 1px solid #000;    

        }
        
        .text-center {
            text-align: center;
        }
        .table2{
        border-collapse : collapse;
        table-layout:fixed;
        width :483px;

        }
        .table2 td{
            width:15%;
        }     
</style>
<html>
<body>
<!-- kop surat -->
<table border="1" cellpading="1" class="table2">
    <tr style="width:500px; border: 1px solid black;">
        <td style="width:40%; align=center;">
            <img src="<?php echo base_url().'assets/img/logo.png' ?>" width = "480" height="100" alt="">
        </td colspan="">
        <td style="width:80%;">
          <h3 style="text-align: center;">
          REPORT DATA MENU
        </h3>
        </td>
        <td style="align=center;width:24%;">
            jl. Asia-Afrika, Bandung-jawa barat (indonesia)
        </td>
      </tr>
    </table>
    <br><br>

<!-- isi report -->
<table  class="table">
<thead>
    <tr>
            <th>No</th>
            <th>Kategori</th>                        
            <th>Nama</th>                        
            <th>Harga</th>                         
            <th>Deskripsi</th>                         
            <th>Jumlah</th>                         
            <th>Gambar</th>                                                         
                   
    </tr>
</thead>
<tbody>
    <?php $i = 1; ?>
    <?php foreach ($menu as $mn) { ?>
    
    <tr class="text-center">
        <td><?php echo $i++ ; ?></td>
        <td style="width:30%;"><?php echo $mn->kategori; ?></td>
        <td style="width:30%;"><?php echo $mn->nama_menu; ?></td>
        <td style="width:30%"><?php echo $mn->harga_menu; ?></td>        
        <td style="width:50%"><?php echo $mn->deskripsi_menu; ?></td>        
        <td style="width:30%"><?php echo $mn->menu_qty; ?></td>        
        <td>
            <img src="<?php echo base_url().'assets/gambar/menu/'.$mn->gambar_menu ?> " width = "100" height="100">
        </td>                                                                                                                                                          
    </tr>          
    <?php } ?>
</tbody>

</table>
</body>
</html>

<?php
    $html = ob_get_contents();
    ob_end_clean();
    
    require_once('assets/html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','en');
    $pdf->WriteHTML($html);
    $pdf->Output('laporan_menu.pdf','D');
?>