<?= $this->include('partials/main') ?>

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>

</head>

<?= $this->include('partials/body') ?>

<div class="container-fluid">
    <!-- Begin page -->
    <div id="layout-wrapper">

        <?= $this->include('partials/menu') ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">

                <?= $page_title ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title mb-4">
                                    <div class="float-end font-size-16">
                                        <a href="/transaction_add" class="btn font-16 btn-primary" id="">
                                            <i class="mdi mdi-plus-circle-outline"></i> 
                                            <?= lang('Files.Add_New_Transaction') ?>
                                        </a>
                                    </div>
                                    <h4 class="card-title mb-4"><?= $title ?></h4>
                                </div>
                                <br>
                                
                                <?= $this->include('partials/pagination') ?>
                                
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-nowrap table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Actions</th>
                                                <th class="text-center"><?= lang('Stock Name') ?></th>
                                                <th class="text-center">Partner</th>
                                                <th class="text-center">Driver</th>
                                                <th class="text-center"><?= lang('Quantity') ?></th>
                                                <th class="text-center"><?= lang('Status') ?></th>
                                                <th class="text-center"><?= lang('Files.Date') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 0;
                                                foreach ($transactions_data as $data) {
                                                    $i++;
                                                ?>
                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td>
                                                            <a href="<?= base_url('transaction_product_list/'.$data['transaction_id']) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                            
                                                            <button class="btn btn-success btn-sm <?= $data['quantity'] >= 0 ? '' : 'disabled'; ?>" onclick="bulkDownloadQRCode('<?= $data['transaction_id'] ?>', '<?= $data['product_id'] ?>', '<?= $i ?>', '<?= $data['name'] ?>');" title="Bulk Download QR"><i class="fa fa-download"></i></button>
                                                            
                                                            <a href="<?= base_url('update_transaction/'.$data['transaction_id']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                            <a href="<?= base_url('delete_transaction/'.$data['transaction_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Remove this transaction from the system ?');"><i class="fa fa-trash"></i></a>
                                                            <canvas id="qrcode<?= $i ?>" hidden></canvas>
                                                            <canvas id="qrcode_title<?= $i ?>" hidden></canvas>
                                                            <canvas id="qrcode_combine_title<?= $i ?>" width="4cm" height="2cm" hidden></canvas>
                                                            <a href="#" id="qrcode_download<?= $i ?>" hidden></a>
                                                            <img id="qrcode_pic<?= $i ?>">
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 m-0" id="product-name<?= $i ?>">
                                                                <?=  (!empty($data['product']))?$data['product']['name']:''; ?>
                                                            </h5> 
                                                        </td>
                                                        <td class="text-center">
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <?= $data['name'] ?>
                                                            </h5> 
                                                        </td>
                                                        <td class="text-center">
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <?php  
                                                                    $db = db_connect();
                                                                    
                                                                    if ($data['driver_id'] == 0) {
                                                                        echo "-";
                                                                    } else {
                                                                        $result = $db->query("SELECT * FROM bs_staffs WHERE id = '$data[driver_id]'")->getResultArray();
                                                                        $driver_name = $result[0]['name'];
                                                                        
                                                                        echo $driver_name;
                                                                    }
                                                                ?>
                                                            </h5> 
                                                        </td>
                                                        <td class="text-center">
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="javascript: void(0);" class="text-dark">
                                                                    <?=  ($data['quantity'] >= 0)?$data['quantity']:''; ?>
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php 
                                                                switch($data['status']) {
                                                                    case 0:
                                                                        $status = "Haven't accept";
                                                                        $color = "warning";
                                                                        break;
                                                                    case 1:
                                                                        $status = "Accepted";
                                                                        $color = "success";
                                                                        break;
                                                                    case 2:
                                                                        $status = "Rejected";
                                                                        $color = "danger";
                                                                        break;
                                                                }
                                                        
                                                                echo "<span class='badge bg-".$color." p-2 font-size-14'>".$status."</span>";
                                                                
                                                                if ($data['status'] == 2) {
                                                            ?>
                                                                    <span class="badge bg-info p-2 font-size-14" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $data['reject_reason'] ?>">
                                                                        Reason
                                                                    </span>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="javascript: void(0);" class="text-dark">
                                                                    <?= date('Y-m-d', strtotime($data['transaction_date'])); ?>
                                                                </a>
                                                            </h5>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <?= $this->include('partials/pagination') ?>
                                
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- End Page-content -->
            <?= $this->include('partials/footer') ?>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
</div>
<!-- end container-fluid -->

<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<script src="assets/js/pages/tasklist.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            searching: true,
            paging: false,
            info: false,
            //scrollY: 500,
        });
    });
    
    function bulkDownloadQRCode(transaction_id, product_id, index, partner_name) {
        var transaction_products = [];
        
        $.post("<?= base_url('TransactionController/find_transaction_product') ?>", {
            transaction_id : transaction_id,
            product_id : product_id,
        }, function(data, status){
            transaction_products = JSON.parse(data);
            
            if (transaction_products.length > 0) {
                window.jsPDF = window.jspdf.jsPDF;
                var pdf = new window.jsPDF();
                
                for (var i = 0; i < transaction_products.length; i++) {
                    var qrcode = new QRious({
                        element: document.getElementById("qrcode" + index),
                        background: 'white',
                        backgroundAlpha: 1,
                        foreground: 'black',
                        foregroundAlpha: 1,
                        level: 'H',
                        padding: 0,
                        size: 300,
                        value: transaction_products[i]['id']
                    });
                    
                    var qrcode = document.getElementById("qrcode" + index);
                    var title = document.getElementById("qrcode_title" + index);
                    title.width = 1500;
                    title.height = 750;
                    
                    var context = title.getContext("2d");
                    context.font = "40px Poppins";
                    context.globalAlpha = 1.0;
                    context.drawImage(qrcode, 50, 50);
                    context.globalAlpha = 1;
                    context.lineWidth = 1;
                    context.strokeStyle = 'black';
                    context.rotate(90 * (Math.PI / 180));
                    
                    //context.translate(title.width/2,title.height/2);
    
                    context.stroke();
                    var product_name = getLines(context, $('#product-name' + index).text(), 350);
                    var x = 370;
                    var y = product_name.length > 4 ? -290 : -270;
                    var line_count = product_name.length > 4 ? 5 : product_name.length;
                    var lineheight = 45;
                    
                    switch (line_count) {
                        case 0:
                        case 1:
                            context.fillText(product_name[0], x, y + (0 * lineheight));
                            context.fillText(transaction_products[i]['id'], x, y + (1 * lineheight));
                            break;
                        case 2:
                            context.fillText(product_name[0], x, y + (0 * lineheight));
                            context.fillText(product_name[1], x, y + (1 * lineheight));
                            context.fillText(transaction_products[i]['id'], x, y + (2 * lineheight));
                            break;
                        case 3:
                            context.fillText(product_name[0], x, y + (0 * lineheight));
                            context.fillText(product_name[1], x, y + (1 * lineheight));
                            context.fillText(product_name[2], x, y + (2 * lineheight));
                            context.fillText(transaction_products[i]['id'], x, y + (3 * lineheight));
                            break;
                        case 4:
                            context.fillText(product_name[0], x, y + (0 * lineheight));
                            context.fillText(product_name[1], x, y + (1 * lineheight));
                            context.fillText(product_name[2], x, y + (2 * lineheight));
                            context.fillText(product_name[3], x, y + (3 * lineheight));
                            context.fillText(transaction_products[i]['id'], x, y + (4 * lineheight));
                            break;
                        case 5:
                            context.fillText(product_name[0], x, y + (0 * lineheight));
                            context.fillText(product_name[1], x, y + (1 * lineheight));
                            context.fillText(product_name[2], x, y + (2 * lineheight));
                            context.fillText(product_name[3], x, y + (3 * lineheight));
                            context.fillText(product_name[4], x, y + (4 * lineheight));
                            context.fillText(transaction_products[i]['id'], x, y + (5 * lineheight));
                            break;
                    }
                    
                    var qrcode_pic = document.getElementById("qrcode_download" + index);
                    qrcode_pic.href = title.toDataURL("image/png");
                    qrcode_pic.download = "product_qrcode_" + transaction_products[i]['id'] + ".png";
        
                    var imgData = title.toDataURL("image/png");
    
                    if (i > 0) {
                        pdf.addPage();
                    }
                    pdf.addImage(imgData, 'PNG', 0, 0);
                }
                
                var min = transaction_products[0]['id'];
                var max = transaction_products[transaction_products.length-1]['id'];
                
                pdf.save("BulkTransQR_" + partner_name + "_" + $('#product-name' + index).text() + "_" + min + "_" + max + ".pdf");
            }
        });

            

    }
    
    function getLines(ctx, text, maxWidth) {
        var words = text.split(" ");
        var lines = [];
        var currentLine = words[0];
    
        for (var i = 1; i < words.length; i++) {
            var word = words[i];
            var width = ctx.measureText(currentLine + " " + word).width;
            if (width < maxWidth) {
                currentLine += " " + word;
            } else {
                lines.push(currentLine);
                currentLine = word;
            }
        }
        lines.push(currentLine);
        return lines;
    }
</script>

</body>

</html>