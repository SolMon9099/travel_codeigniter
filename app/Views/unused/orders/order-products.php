<?= $this->include('partials/main') ?>

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>

</head>

<style>
    .otp-table td.fit, .otp-table th.fit {
        white-space: nowrap;
        width: 1%;
    }

    .white_bg {
        background-color: white;
        color:black;
    }
</style>

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
                                <?php $data = $order_data[0]; ?>
                                
                                <div class="invoice-title mb-4">
                                    <div class="float-end">
                                        <a type="button" onclick="history.back();" *href="<?= base_url('order') ?>" class="btn btn-secondary">
                                            Back
                                        </a>
                                        <!--
                                        <a href="<?= base_url('update_order/'.$data['order_id']) ?>" class="btn btn-primary">
                                            Edit
                                        </a>
                                        -->
                                    </div>
                                    <h4 class="card-title mb-4"><?= $title ?></h4>
                                </div>
                                <br>
                                
                                <!-- Modal 1 -->
                                <div class="modal fade" id="view_qrcode_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">QR Code</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body text-center">
                                          <div class="row">
                                              <div class="col-12 col-md-6">
                                                  <canvas id="view_qrcode_modal_body"></canvas>
                                              </div>
                                              <div class="col-12 col-md-6 d-flex align-items-center justify-content-center" id="qr-tp-id">
                                              </div>
                                          </div>
                                              
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                <!-- Modal 2 -->
                                <div class="modal fade" id="view_claim_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content" id="view_claim_modal_body">
                                      
                                    </div>
                                  </div>
                                </div>

                                <div class="row mb-3">
                                  <div class="col-md-2"><b>Customer</b></div>
                                  <div class="col-md-4">:&ensp;<?= $data['customer_name'] ?></div>
                                  <div class="col-md-2"><b>Contact No.</b></div>
                                  <div class="col-md-4">:&ensp;<?=  $data['customer_phone'] ?></div>
                                </div>
                                
                                <div class="row mb-3">
                                  <div class="col-md-2"><b>Address</b></div>
                                  <div class="col-md-4">:&ensp;<?= $data['customer_address'] ?></div>
                                  <div class="col-md-2"><b>No. Plate</b></div>
                                  <div class="col-md-4">:&ensp;<?=  $data['license_plate'] ?></div>
                                </div>
                                
                                <div class="row mb-3">
                                  <div class="col-md-2"><b>Partner</b></div>
                                  <div class="col-md-4">:&ensp;<?= $data['name'] ?></div>
                                    
                                  <div class="col-md-2"><b>Commission</b></div>
                                  <div class="col-md-4">:&ensp;<?= "RM 0.00" ?></div>
                                </div>
                                
                                <div class="row mb-3">
                                  <div class="col-md-2"><b>Final Total</b></div>
                                  <div class="col-md-4">:&ensp;<?= "RM ".$data['final_total'] ?></div>
                                  
                                  <?php
                                    switch($data['payment_method']) {
                                        case 0:
                                            $pymt_mthd = "Not Applicable";
                                            break;
                                        case 1:
                                            $pymt_mthd = "Bank";
                                            break;
                                        case 2:
                                            $pymt_mthd = "Cash";
                                            break;
                                    }
                                  ?>
                                  <div class="col-md-2"><b>Payment Method</b></div>
                                  <div class="col-md-4">:&ensp;<?= $pymt_mthd ?></div>
                                </div>
                                
                                <div class="row mb-3">
                                    <?php 
                                        switch($data['status']) {
                                            case 0:
                                                $btn = "warning";
                                                break;
                                            case 1:
                                                $btn = "success";
                                                break;
                                            case 2:
                                                $btn = "danger";
                                                break;
                                        }
                                    ?>
                                    <div class="col-md-2"><b>Order Status</b></div>
                                    <div class="col-md-4">:&ensp;
                                        <select class="form-control w-auto btn btn-<?= $btn ?> btn-sm font-size-14" id="order-status-btn-<?= $data['order_id'] ?>" value="<?= $data['order_id'] ?>" onchange="updateOrderStatus('<?= $data['order_id'] ?>', this.value);">
                                            <option class="white_bg" value="0" <?= $data['status'] == 0 ? 'selected' : '' ?>>Pending</option>
                                            <option class="white_bg" value="1" <?= $data['status'] == 1 ? 'selected' : '' ?>>Done</option>
                                            <option class="white_bg" value="2" <?= $data['status'] == 2 ? 'selected' : '' ?>>Cancelled</option>
                                        </select>
                                    </div>
                                    
                                    <?php
                                        switch($data['payment_status']) {
                                            case 0:
                                                $btn = "success";
                                                $pymt_status = "No Need";
                                                break;
                                            case 1:
                                                $btn = "success";
                                                $pymt_status = "Paid";
                                                break;
                                            case 2:
                                                $btn = "danger";
                                                $pymt_status = "Not Paid Yet";
                                                break;
                                        }
                                    ?>
                                    <div class="col-md-2"><b>Payment Status</b></div>
                                    <div class="col-md-4">:&ensp;
                                        <select class="form-control w-auto btn btn-<?= $btn ?> btn-sm font-size-14" id="payment-status-btn-<?= $data['order_id'] ?>" value="<?= $data['payment_status'] ?>" onchange="updatePaymentStatus('<?= $data['order_id'] ?>', this.value);">
                                            <option class="white_bg" value="0" <?= $data['payment_status'] == 0 ? 'selected' : '' ?>>No Need</option>
                                            <option class="white_bg" value="1" <?= $data['payment_status'] == 1 ? 'selected' : '' ?>>Paid</option>
                                            <option class="white_bg" value="2" <?= $data['payment_status'] == 2 ? 'selected' : '' ?>>Not Paid Yet</option>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                <hr>
                                <br>
                                <?= $this->include('partials/alert') ?>
                                
                                <?php
                                    $db = db_connect();
                                    $order_products = $db->query("SELECT * FROM bs_orders_products WHERE order_id = '$data[order_id]'")->getResultArray();
                                ?>
                                <h4 class="card-title mb-4">Order Product Details: (<?= COUNT($order_products) ?> Items)</h4>
                                <div class="table-responsive">
                                  <table class="table table-nowrap table-centered mb-0">
                                    <thead>
                                      <tr>
                                        <th style="text-align: right;">#</th>
                                        <th class="text-center">Product Name</th>
                                        <!--
                                        <th class="text-center">QR Code</th>
                                        -->
                                        <th class="text-center">Price (RM)</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Subtotal (RM)</th>
                                        <!--
                                        <th class="text-center">Actions</th>
                                        -->
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $i = 0;
                                        foreach($order_product_data as $p) {
                                          $i++;
                                      ?>
                                      <tr>
                                        <td class="text-center"><i class="fa fa-plus" onclick="viewProductBarcode('<?= $i ?>', this)"></i>&emsp;<?= $i ?></td>
                                        <td class="text-left"><span id="product-name"><?= $p['name'] ?? "-" ?></span></td>
                                        <td style="text-align: right;"><?= $p['price'] ?? "-" ?></td>
                                        <td class="text-center"><?= $p['quantity'] ?? "-" ?></td>
                                        <td style="text-align: right;"><?= $p['subtotal'] ?? "-" ?></td>
                                        <!--
                                        <td class="text-center">
                                            <a href="<?= base_url('delete_order_product/'.$data['order_id'].'/'.$p['order_product_id']) ?>" class="btn btn-danger" onclick="return confirm('Remove this transaction product from the system ?');"><i class="fa fa-trash"></i></a>
                                        </td>
                                        -->
                                      </tr>
                                      <tr class="d-none" id="row<?= $i ?>">
                                        <td class="bg-light" colspan="5">
                                          <div class="card mb-0">
                                            <div class="card-body" style="padding: 0px 0px 30px 0px;">
                                              <table class="table table-sm table-bordered otp-table mb-0">
                                                <thead>
                                                  <tr>
                                                    <th style="text-align:right;">#</th>
                                                    <th class="text-center">QR Code</th>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">Warranty Month</th>
                                                    <th class="text-center">Warranty Start Date</th>
                                                    <th class="text-center">Warranty End Date</th>
                                                    <th class="text-center">Claim</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <?php
                                                    $order_transaction_products = $db->query("SELECT * FROM bs_orders_transactions_products WHERE order_id = '$data[order_id]' AND product_id = '$p[product_id]'")->getResultArray();
                                                        
                                                    $j = 0;
                                                    foreach ($order_transaction_products as $otp) {
                                                      $j++;
                                                  ?>
                                                      <tr>
                                                        <td style="text-align:right;"><?= $j ?></td>
                                                        <td class="text-center">
                                                          <?php
                                                            if ($otp['transaction_product_id'] != 0 ) {
                                                          ?>
                                                              <button class="btn btn-info btn-sm" onclick="generateQRcode('<?= $j ?>', '<?= $otp['transaction_product_id'] ?>', 'view');" data-bs-toggle="modal" data-bs-target="#view_qrcode_modal">
                                                                <i class="fa fa-eye"></i>
                                                              </button>
                                                              <button class="btn btn-primary btn-sm" onclick="generateQRcode('<?= $j ?>', '<?= $otp['transaction_product_id'] ?>', 'download');">
                                                                <i class="fa fa-download"></i>
                                                              </button>
                                                                <canvas id="qrcode<?= $j ?>" hidden></canvas>
                                                                <canvas id="qrcode_title<?= $j ?>" hidden></canvas>
                                                                <canvas id="qrcode_combine_title<?= $j ?>" width="4cm" height="2cm" hidden></canvas>
                                                                <a href="#" id="qrcode_download<?= $j ?>" hidden></a>
                                                                <img id="qrcode_pic<?= $j ?>">
                                                                <!--
                                                              <a href="#" id="qrcode_download<?= $otp['transaction_product_id'] ?>">
                                                                <canvas id="qrcode<?= $otp['transaction_product_id'] ?>" hidden></canvas>
                                                              </a>
                                                              -->
                                                          <?php
                                                            } else {
                                                              echo "-";
                                                            }
                                                          ?>
                                                        </td>
                                                        <td class="text-center"><?= $otp['transaction_product_id'] ?? "-" ?></td>
                                                        <td class="text-center"><?= $otp['warranty_month'] == 0 ? "-" : $otp['warranty_month'] ?></td>
                                                        <td class="text-center"><?= $otp['warranty_start_date'] ?? "-" ?></td>
                                                        <td class="text-center"><?= $otp['warranty_end_date'] ?? "-" ?></td>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger btn-sm" onclick="showClaimModal('<?= $otp['transaction_product_id'] ?>', '<?= $otp['product_id'] ?>', '<?= $data['partner_id'] ?>', '<?= $otp['order_transaction_product_id'] ?>');" data-bs-toggle="modal" data-bs-target="#view_claim_modal">
                                                                <i class="fa fa-exchange-alt"></i>
                                                            </button>
                                                            <?php
                                                                if ($otp['claim_at'] != null) {
                                                                    echo "<br><br>".$otp['claim_reason'];
                                                                }
                                                            ?>
                                                        </td>
                                                      </tr>
                                                  <?php
                                                    }
                                                  ?>
                                                </tbody>
                                              </table>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <th colspan="4" style="text-align:right;">Grand Total (RM)</th>
                                        <th style="text-align:right;"><?= $data['grand_total'] ?></th>
                                      </tr>
                                      
                                      <?php
                                        if ($data['voucher_code'] != "") {
                                      ?>
                                            <tr>
                                                <th colspan="4" style="text-align:right;">Voucher Discount (RM)<br><span style='font-size: 12px;'><?= $data['voucher_code'] ?></span></th>
                                                <th style="text-align:right;"><?= "- ".$data['voucher_discount'] ?></th>
                                            </tr>
                                      <?php
                                        }
                                      ?>
                                      
                                      <?php
                                        if ($data['trade_in_discount'] != 0.00) {
                                            $trade_ins = $db->query("SELECT * FROM bs_trade_ins WHERE order_id = '$data[order_id]'")->getResultArray();
                                            
                                            if (COUNT($trade_ins) > 0) {
                                                $trade_in_id = $trade_ins[0]['trade_in_id'];
                                                $items = $db->query("SELECT * FROM bs_trade_ins_items WHERE trade_in_id = '$trade_in_id'")->getResultArray();
                                            }
                                      ?>
                                            <tr>
                                                <th colspan="4" style="text-align:right;">
                                                    Trade-In Discount (RM)
                                                    <?php
                                                        if (COUNT($items) > 0) {
                                                            echo "<span style='font-size: 12px;'>";
                                                            
                                                            foreach($items as $item) {
                                                                $types = $db->query("SELECT * FROM bs_trade_ins_types WHERE trade_in_type_id = '$item[trade_in_type_id]'")->getResultArray();
                                                                $type = $types[0]['type'] ?? "n/a";
                                                                
                                                                echo "<br>$type x $item[quantity] = $item[sub_total]";
                                                            }
                                                            
                                                            echo "</span>";
                                                        }
                                                    ?>
                                                </th>
                                                <th style="text-align:right;"><?= "- ".$data['trade_in_discount'] ?></th>
                                            </tr>
                                      <?php
                                        }
                                      ?>
                                      
                                          
                                      <tr>
                                        <th colspan="4" style="text-align:right;">Final Total (RM)</th>
                                        <th style="text-align:right;"><?= $data['final_total'] ?></th>
                                      </tr>
                                    </tfoot>
                                  </table>
                                </div>
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
<!-- <script src="assets/libs/apexcharts/apexcharts.min.js"></script> -->
<!-- <script src="assets/js/pages/tasklist.init.js"></script> -->
<!-- App js -->
<!-- <script src="assets/js/app.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function viewProductBarcode(counter, ele) {
        var x = document.getElementById('row' + counter);
        
        if (x.className == "d-none") {
            x.className = "";
            ele.className = "fa fa-minus";
        } else {
            x.className = "d-none";
            ele.className = "fa fa-plus";
        }
    }
    
    /*
    function generateQRcode(transaction_product_id, action) {
        var qrcode = new QRious({
          element: action == "view" ? document.getElementById("view_qrcode_modal_body") : document.getElementById("qrcode" + transaction_product_id),
          background: 'white',
          backgroundAlpha: 1,
          foreground: 'black',
          foregroundAlpha: 1,
          level: 'H',
          padding: 0,
          size: action == "view" ? 256 : 512,
          value: transaction_product_id
        });
        
        if (action == "download") {
            var anchor = document.getElementById("qrcode_download" + transaction_product_id);
            anchor.href = qrcode.toDataURL("image/png");
            anchor.download = "tp_qrcode_" + transaction_product_id + ".png";
            anchor.click();
        }
    }
    */
    
    function generateQRcode(counter, transaction_product_id, action) {
        $("#qr-tp-id").html($('#product-name').text() + "<br>" + transaction_product_id);
        
        var qrcode = new QRious({
            element: action == "view" ? document.getElementById("view_qrcode_modal_body") : document.getElementById("qrcode" + counter),
            background: 'white',
            backgroundAlpha: 1,
            foreground: 'black',
            foregroundAlpha: 1,
            level: 'H',
            padding: 0,
            size: action == "view" ? 250 : 300,
            value: transaction_product_id
        });
        
        if (action == "download") {
            var qrcode = document.getElementById("qrcode" + counter);
            var title = document.getElementById("qrcode_title" + counter);
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
            context.stroke();

            var product_name = getLines(context, $('#product-name').text(), 350);
            var x = 370;
            var y = product_name.length > 4 ? -290 : -270;
            var line_count = product_name.length > 4 ? 5 : product_name.length;
            var lineheight = 45;
            
            switch (line_count) {
                case 0:
                case 1:
                    context.fillText(product_name[0], x, y + (0 * lineheight));
                    context.fillText(transaction_product_id, x, y + (1 * lineheight));
                    break;
                case 2:
                    context.fillText(product_name[0], x, y + (0 * lineheight));
                    context.fillText(product_name[1], x, y + (1 * lineheight));
                    context.fillText(transaction_product_id, x, y + (2 * lineheight));
                    break;
                case 3:
                    context.fillText(product_name[0], x, y + (0 * lineheight));
                    context.fillText(product_name[1], x, y + (1 * lineheight));
                    context.fillText(product_name[2], x, y + (2 * lineheight));
                    context.fillText(transaction_product_id, x, y + (3 * lineheight));
                    break;
                case 4:
                    context.fillText(product_name[0], x, y + (0 * lineheight));
                    context.fillText(product_name[1], x, y + (1 * lineheight));
                    context.fillText(product_name[2], x, y + (2 * lineheight));
                    context.fillText(product_name[3], x, y + (3 * lineheight));
                    context.fillText(transaction_product_id, x, y + (4 * lineheight));
                    break;
                case 5:
                    context.fillText(product_name[0], x, y + (0 * lineheight));
                    context.fillText(product_name[1], x, y + (1 * lineheight));
                    context.fillText(product_name[2], x, y + (2 * lineheight));
                    context.fillText(product_name[3], x, y + (3 * lineheight));
                    context.fillText(product_name[4], x, y + (4 * lineheight));
                    context.fillText(transaction_product_id, x, y + (5 * lineheight));
                    break;
            }
                    
            var qrcode_pic = document.getElementById("qrcode_download" + counter);
            qrcode_pic.href = title.toDataURL("image/png");
            qrcode_pic.download = "product_qrcode_" + transaction_product_id + ".png";

            var imgData = title.toDataURL("image/png");
            window.jsPDF = window.jspdf.jsPDF;
            var pdf = new window.jsPDF();
        
            pdf.addImage(imgData, 'PNG', 0, 0);
            pdf.save("ProdQR_" + $('#product-name').text() + "_" + transaction_product_id + ".pdf");
        }
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
    
    function printDocument(documentId) {
        var doc = document.getElementById(documentId);
    
        //Wait until PDF is ready to print    
        if (typeof doc.print === 'undefined') {    
            setTimeout(function(){printDocument(documentId);}, 1000);
        } else {
            doc.print();
        }
    }

    function swal(type, position, message, backdrop, timer, showConfirmButton) {
        if (timer > 0) {
            Swal.fire({
              position: position,
              icon: type,
              title: message,
              backdrop: backdrop,
              showConfirmButton: showConfirmButton,
              timer: timer,
            });
        } else {
            Swal.fire({
              position: position,
              icon: type,
              title: message,
              backdrop: backdrop,
              showConfirmButton: showConfirmButton,
            });
        }
    }
    
    function showClaimModal(old_transaction_product_id, product_id, partner_id, order_transaction_product_id) {
        $.post("<?= base_url('OrderController/find_claimable_product') ?>", {
            product_id : product_id,
            partner_id : partner_id,
        }, function(data, status){
            var tp_list = JSON.parse(data);
            
            var claim = ``;
            
            for (var i = 0; i < tp_list.length; i++) {
                claim = claim + "<option value='" + tp_list[i]['id'] + "'>" + tp_list[i]['id'] + "</option>";
            }
            
            var html = `
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Claim ID ` + old_transaction_product_id + ` :</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">Select another ID of the same product to exchange: <span class="text-danger">*</span></label>
                            <select class="form-control" name="" id="view_claim_modal_transaction_product_id" required>
                                <option value="0" hidden>--Select--</option>
                                ` + claim + `
                            </select>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">Claim Reason: <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="" id="view_claim_modal_claim_reason" rows="5" required></textarea>
                        </div>
                    </div>
                            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitClaim('` + order_transaction_product_id + `', '` + old_transaction_product_id + `');">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            `;
            
            $('#view_claim_modal_body').html(html);
        });
    }
    
    function submitClaim(order_transaction_product_id, old_transaction_product_id) {
        var new_transaction_product_id = $('#view_claim_modal_transaction_product_id').val();
        var claim_reason = $('#view_claim_modal_claim_reason').val() ?? "";
        
        if (new_transaction_product_id != 0) {
            $.post("<?= base_url('OrderController/submit_claim') ?>", {
                order_transaction_product_id : order_transaction_product_id,
                old_transaction_product_id : old_transaction_product_id,
                new_transaction_product_id : new_transaction_product_id,
                claim_reason : claim_reason,
            }, function(data, status){
                if (data == "success") {
                    Swal.fire({
                      title: "Successfully claimed the product from ID " + old_transaction_product_id + " to " + new_transaction_product_id,
                      icon: 'success',
                      position: 'top-start',
                      confirmButtonText: 'OK',
                      backdrop: false,
                    }).then((result) => {
                      if (result.isConfirmed) {
                        location.reload();
                      }
                    });
                } else {
                    swal("error", "top-start", "Failed to claim this product ID to another", false, 0, false);
                }
            });
        }
    }
    
    function updateOrderStatus(order_id, order_status) {
        var proceed = false;
        if (order_status == "2") {
            if (confirm("Confirm cancel this order?")) {
                proceed = true;
            }
        } else {
            proceed = true;
        }
        
        if (proceed) {
            $.post("<?= base_url('OrderController/update_order_status') ?>", {
                order_id: order_id,
                order_status: order_status,
            }, function(data, status){
                if (data == "success") {
                    switch (order_status) {
                        case "0":
                            $('#order-status-btn-' + order_id).attr('class', 'form-control w-auto btn btn-warning btn-sm font-size-14');
                            break;
                        case "1":
                            $('#order-status-btn-' + order_id).attr('class', 'form-control w-auto btn btn-success btn-sm font-size-14');
                            break;
                        case "2":
                            $('#order-status-btn-' + order_id).attr('class', 'form-control w-auto btn btn-danger btn-sm font-size-14');
                            break;
                    }
                    
                    swal("success", "top-start", "Successfully changed order status.", false, 1000, false);
                } else {
                    swal("error", "top-start", "Failed to change order status.", false, 1000, false);
                }
            });   
        }
    }
    
    function updatePaymentStatus(order_id, payment_status) {
        var proceed = false;
        if (payment_status == "2") {
            if (confirm("Confirm set to Not Yet Paid?")) {
                proceed = true;
            }
        } else {
            proceed = true;
        }
        
        if (proceed) {
            $.post("<?= base_url('OrderController/update_payment_status') ?>", {
                order_id: order_id,
                payment_status: payment_status,
            }, function(data, status){
                if (data == "success") {
                    switch (payment_status) {
                        case "0":
                            $('#payment-status-btn-' + order_id).attr('class', 'form-control w-auto btn btn-success btn-sm font-size-14');
                            break;
                        case "1":
                            $('#payment-status-btn-' + order_id).attr('class', 'form-control w-auto btn btn-success btn-sm font-size-14');
                            break;
                        case "2":
                            $('#payment-status-btn-' + order_id).attr('class', 'form-control w-auto btn btn-danger btn-sm font-size-14');
                            break;
                    }
                    
                    swal("success", "top-start", "Successfully changed payment status.", false, 1000, false);
                } else {
                    swal("error", "top-start", "Failed to change payment status.", false, 1000, false);
                }
            });   
        }
    }
</script>

</body>

</html>