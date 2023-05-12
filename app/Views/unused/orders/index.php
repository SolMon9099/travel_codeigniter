<?= $this->include('partials/main') ?>

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>

</head>

<style>
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
                                <div class="invoice-title mb-4">
                                    <div class="float-end font-size-16">
                                        <a href="/order_add" class="btn font-16 btn-primary" id="">
                                            <i class="mdi mdi-plus-circle-outline"></i> 
                                            <?= "Add New Order" ?>
                                        </a>
                                    </div>
                                    <h4 class="card-title mb-4"><?= $title ?></h4>
                                </div>
                                <br>
                                
                                <?= $this->include('partials/pagination') ?>
                                
                                <!-- Search Form -->
                                <!--
                                <div class="row mb-3">
                                    <div class="col-9 text-end mt-2 text-dark p-0">
                                        <span>Search:</span>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-control">
                                    </div>
                                </div>
                                -->
                                <!-- Search Form -->
                                
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-nowrap table-centered mb-0 table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Actions</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Customer</th>
                                                <th class="text-center">Payment<br>Method</th>
                                                <th class="text-center">Amount (RM)</th>
                                                <th class="text-center">Created At</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = ($page-1) * $entries;
                                                $db = db_connect();
                                                foreach ($orders_data as $data) {
                                                    $customer_name = empty($data['customer_name']) ? "n/a" : $data['customer_name'];
                                                    $license_plate = empty($data['license_plate']) ? "n/a" : $data['license_plate'];
                                                    $customer_phone = empty($data['customer_phone']) ? "n/a" : $data['customer_phone'];
                                                    $customer_address = empty($data['customer_address']) ? "n/a" : $data['customer_address'];
                                                    
                                                    if ($data['partner_id'] == 0) {
                                                        $partner_name = "n/a";
                                                    } else {
                                                        $p = $db->query("SELECT * FROM bs_partners WHERE id = '$data[partner_id]'")->getResultArray();
                                                        
                                                        if (COUNT($p) == 0) {
                                                            $partner_name = "n/a";
                                                        } else {
                                                            $partner_name = $p[0]['name'];
                                                        }
                                                    }
                                                    
                                                    if ($data['agent_id'] == 0) {
                                                        $agent_name = "";
                                                    } else {
                                                        $a = $db->query("SELECT * FROM bs_agents WHERE agent_id = '$data[agent_id]'")->getResultArray();
                                                        
                                                        if (COUNT($a) == 0) {
                                                            $agent_name = "";
                                                        } else {
                                                            $agent_name = "<br><span class='font-size-12' data-bs-toggle='tooltip' data-bs-placement='top' title='Agent Name'>".$a[0]['name']."</span>";
                                                        }
                                                    }
                                                    
                                                    if ($data['workshop_id'] == 0) {
                                                        $workshop_name = "";
                                                    } else {
                                                        $w = $db->query("SELECT * FROM bs_workshops WHERE workshop_id = '$data[workshop_id]'")->getResultArray();
                                                        
                                                        if (COUNT($w) == 0) {
                                                            $workshop_name = "";
                                                        } else {
                                                            $workshop_name = "<br><span class='font-size-12' data-bs-toggle='tooltip' data-bs-placement='top' title='Workshop Name'><i>".$w[0]['name']."</i></span>";
                                                        }
                                                    }
                                                    
                                                    $i++;
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $i ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= base_url('order_product_list/'.$data['order_id']) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                            <!--
                                                            <a href="<?= base_url('update_order/'.$data['order_id']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                            -->
                                                            <a href="<?= base_url('delete_order/'.$data['order_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Remove this order from the system ?');"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                        <td class="text-center" style="width: 150px;">
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
                                                            <select class="form-control btn btn-<?= $btn ?> btn-sm font-size-14 w-100" id="order-status-btn-<?= $data['order_id'] ?>" value="<?= $data['order_id'] ?>" onchange="updateOrderStatus('<?= $data['order_id'] ?>', this.value);" data-bs-toggle='tooltip' data-bs-placement='top' title='Order Status'>
                                                                <option class="white_bg" value="0" <?= $data['status'] == 0 ? 'selected' : '' ?>>Pending</option>
                                                                <option class="white_bg" value="1" <?= $data['status'] == 1 ? 'selected' : '' ?>>Done</option>
                                                                <option class="white_bg" value="2" <?= $data['status'] == 2 ? 'selected' : '' ?>>Cancelled</option>
                                                            </select>
                                                            <br>
                                                            
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
                                                            <select class="form-control btn btn-<?= $btn ?> btn-sm font-size-14 w-100 mt-2" id="payment-status-btn-<?= $data['order_id'] ?>" value="<?= $data['payment_status'] ?>" onchange="updatePaymentStatus('<?= $data['order_id'] ?>', this.value);" data-bs-toggle='tooltip' data-bs-placement='top' title='Payment Status'>
                                                                <option class="white_bg" value="0" <?= $data['payment_status'] == 0 ? 'selected' : '' ?>>No Need</option>
                                                                <option class="white_bg" value="1" <?= $data['payment_status'] == 1 ? 'selected' : '' ?>>Paid</option>
                                                                <option class="white_bg" value="2" <?= $data['payment_status'] == 2 ? 'selected' : '' ?>>Not Paid Yet</option>
                                                            </select>
                                                        </td>
                                                        
                                                        <td class="text-justify">
                                                          <h5 class="text-wrap" *style="width:250px;">
                                                            <a href="javascript: void(0);" class="text-dark">
                                                              <?= "
                                                                <span class='font-size-14' data-bs-toggle='tooltip' data-bs-placement='top' title='Name'><b>$customer_name</b></span><br>
                                                                <span class='font-size-12' data-bs-toggle='tooltip' data-bs-placement='top' title='License Plate'>$license_plate</span><br>
                                                                <span class='font-size-12' data-bs-toggle='tooltip' data-bs-placement='top' title='Phone No.'>$customer_phone</span><br>
                                                                <span class='font-size-12' data-bs-toggle='tooltip' data-bs-placement='top' title='Address'><i>$customer_address</i></span><br>
                                                                <span class='font-size-12' data-bs-toggle='tooltip' data-bs-placement='top' title='Partner Name'>$partner_name</span>
                                                                $agent_name
                                                                $workshop_name";
                                                              ?>
                                                            </a>
                                                          </h5>
                                                        </td>
                                                        <td class="text-center">
                                                            <h5 class="text-truncate font-size-14">
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
                                                                
                                                                echo $pymt_mthd;
                                                              ?>
                                                            </h5> 
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14" style="text-align: right; padding-right: 5px;">
                                                              <?php
                                                                $voucher_discount = $data['voucher_discount'] == 0.00 ? "" : "<span data-bs-toggle='tooltip' data-bs-placement='top' title='Voucher Discount ($data[voucher_code])'><i>- $data[voucher_discount]</i></span><br>";
                                                                
                                                                $trade_in_discount = $data['trade_in_discount'] == 0.00 ? "" : "<span data-bs-toggle='tooltip' data-bs-placement='top' title='Trade In Discount'><i>- $data[trade_in_discount]</i></span><br>";
                                                                
                                                                if ($voucher_discount == "" && $trade_in_discount == "") {
                                                                  echo "<span data-bs-toggle='tooltip' data-bs-placement='top' title='Final Total'><b>$data[final_total]</b></span>";
                                                                } else {
                                                                  echo "
                                                                    <span data-bs-toggle='tooltip' data-bs-placement='top' title='Grand Total'>$data[grand_total]</span><br>
                                                                    $voucher_discount
                                                                    $trade_in_discount
                                                                    <span data-bs-toggle='tooltip' data-bs-placement='top' title='Final Total'><b>$data[final_total]</b></span>
                                                                  ";
                                                                }
                                                              ?>
                                                            </h5> 
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="javascript: void(0);" class="text-dark">
                                                                    <?= str_replace(" ", "<br>", $data['order_date']); ?>
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
<!-- <script src="assets/libs/apexcharts/apexcharts.min.js"></script> -->

<!-- <script src="assets/js/pages/tasklist.init.js"></script> -->

<!-- App js -->
<!-- <script src="assets/js/app.js"></script> -->
<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            searching: true,
            paging: false,
            info: false,
            //scrollY: 500,
        });
    });
    
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