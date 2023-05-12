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
        <div class="main-content">

            <div class="page-content">
                <?= $page_title ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <?= $this->include('partials/alert') ?>
                                
                                <?= $this->include('partials/pagination') ?>

                                <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered table-centered mb-1 table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                
                                                <th class="text-center"><?= lang('Customer') ?></th>
                                                <th class="text-center"><?= lang('Collection') ?></th>
                                                <!--
                                                <th class="text-center"><?= lang('Trade-In<br>Payment') ?></th>
                                                -->
                                                <th class="text-center"><?= lang('Trade-In Items') ?></th>
                                                <th class="text-center"><?= lang('Total (RM)') ?></th>
                                                <th class="text-center"><?= lang('Payable (RM)') ?></th>
                                                <th class="text-center"><?= lang('Created At') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $j = 0;
                                                $db = db_connect();
                                                foreach ($trade_ins as $data) {
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
                                                    
                                                    $j++;
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $j ?></td>
                                                        
                                                        <td class="text-justify">
                                                          <h5 class="text-wrap" style="width:250px;">
                                                            <a href="javascript: void(0);" class="text-dark">
                                                              <?= "
                                                                <span class='font-size-14' data-bs-toggle='tooltip' data-bs-placement='top' title='Name'><b>$customer_name</b></span><br>
                                                                <span class='font-size-12' data-bs-toggle='tooltip' data-bs-placement='top' title='License Plate'>$license_plate</span><br>
                                                                <span class='font-size-12' data-bs-toggle='tooltip' data-bs-placement='top' title='Phone No.'>$customer_phone</span><br>
                                                                <span class='font-size-12' data-bs-toggle='tooltip' data-bs-placement='top' title='Address'><i>$customer_address</i></span><br>
                                                                <span class='font-size-12' data-bs-toggle='tooltip' data-bs-placement='top' title='Partner Name'>$partner_name</span>";
                                                              ?>
                                                            </a>
                                                          </h5>
                                                        </td>
                                                        
                                                        <td class="text-center h-100">
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="javascript: void(0);" class="text-dark">
                                                                    <?php
                                                                        switch ($data['staff_id']) {
                                                                            case 0:
                                                                                $btn = "warning";
                                                                                break;
                                                                            default:
                                                                                $btn = "success";
                                                                                break;
                                                                        }
                                                                    ?>
                                                                    
                                                                    <select class="form-control btn btn-<?= $btn ?> btn-sm font-size-14 w-100" id="trade-in-driver-btn-<?= $data['trade_in_id'] ?>" value="<?= $data['staff_id'] ?>" onchange="updateTradeInDriver('<?= $data['trade_in_id'] ?>', this.value);" data-bs-toggle='tooltip' data-bs-placement='top' title='Driver Name'>
                                                                        <option class="white_bg" value="0" <?= $data['staff_id'] == 0 ? 'selected' : '' ?>>--Select--</option>
                                                                        <?php
                                                                            foreach ($drivers as $d) {
                                                                        ?>
                                                                                <option class="white_bg" value="<?= $d['id'] ?>" <?= $data['staff_id'] == $d['id'] ? 'selected' : '' ?>><?= $d['name'] ?></option>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                    <br>
                                                                    
                                                                    <?php
                                                                        switch ($data['trade_in_status']) {
                                                                            case 0:
                                                                                $btn = "warning";
                                                                                break;
                                                                            case 1:
                                                                                $btn = "success";
                                                                                break;
                                                                        }
                                                                    ?>
                                                                    <select class="form-control btn btn-<?= $btn ?> btn-sm font-size-14 w-100 mt-2" id="trade-in-status-btn-<?= $data['trade_in_id'] ?>" value="<?= $data['trade_in_status'] ?>" onchange="updateTradeInStatus('<?= $data['trade_in_id'] ?>', this.value);" data-bs-toggle='tooltip' data-bs-placement='top' title='Collection Status'>
                                                                        <option class="white_bg" value="0" <?= $data['trade_in_status'] == 0 ? 'selected' : '' ?>>Pending</option>
                                                                        <option class="white_bg" value="1" <?= $data['trade_in_status'] == 1 ? 'selected' : '' ?>>Collected</option>
                                                                    </select>
                                                                </a>
                                                            </h5>
                                                        </td>

                                                        <!--
                                                        <td class="text-center">
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="javascript: void(0);" class="text-dark">
                                                                    <?php
                                                                        switch ($data['payment_status']) {
                                                                            case 0:
                                                                                $btn = "warning";
                                                                                break;
                                                                            case 1:
                                                                            case 2:
                                                                                $btn = "success";
                                                                                break;
                                                                        }
                                                                    ?>

                                                                    <select class="form-control w-auto btn btn-<?= $btn ?> btn-sm font-size-14" id="trade-in-payment-btn-<?= $data['trade_in_id'] ?>" value="<?= $data['payment_status'] ?>" onchange="updateTradeInPayment('<?= $data['trade_in_id'] ?>', this.value);">
                                                                        <option class="white_bg" value="0" <?= $data['payment_status'] == 0 ? 'selected' : '' ?>>Pending</option>
                                                                        <option class="white_bg" value="1" <?= $data['payment_status'] == 1 ? 'selected' : '' ?>>Paid</option>
                                                                        <option class="white_bg" value="2" <?= $data['payment_status'] == 2 ? 'selected' : '' ?>>No Need</option>
                                                                    </select>
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        -->
                                                        
                                                        <td class="text-start align-items-start">
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="javascript: void(0);" class="text-dark">
                                                                    <?php
                                                                        $trade_in_items = $db->query("SELECT * FROM bs_trade_ins_items WHERE trade_in_id = '$data[trade_in_id]'")->getResultArray();
                                                                        
                                                                        if (COUNT($trade_in_items) == 0) {
                                                                            echo "n/a";
                                                                        } else {
                                                                            $item = "";
                                                                            
                                                                            foreach ($trade_in_items as $trade_in_item) {
                                                                                foreach ($trade_in_types as $trade_in_type) {
                                                                                    if ($trade_in_type['trade_in_type_id'] == $trade_in_item['trade_in_type_id']) {
                                                                                        $item .= "<b>".$trade_in_type['type']."</b> x <b>".$trade_in_item['quantity']."</b> pcs = RM <b>".$trade_in_item['sub_total']."</b><br>";
                                                                                        
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                            
                                                                            echo $item;
                                                                        }
                                                                    ?>
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="javascript: void(0);" class="text-dark">
                                                                    <?= $data['grand_total']; ?>
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="javascript: void(0);" class="text-dark">
                                                                    <?= $data['payable_amount'] == 0.00 ? '-' : $data['payable_amount']; ?>
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="javascript: void(0);" class="text-dark">
                                                                    <?= str_replace(" ", "<br>", $data['created_at']); ?>
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
<script src="<?= base_url('assets/libs/apexcharts/apexcharts.min.js') ?>"></script>

<script src="<?= base_url('assets/js/pages/tasklist.init.js') ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            searching: true,
            paging: false,
            info: false,
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
    
    function updateTradeInDriver(trade_in_id, staff_id) {
        $.post("<?= base_url('TradeInController/update_trade_in_driver') ?>", {
            trade_in_id: trade_in_id,
            staff_id: staff_id,
        }, function(data, status){
            if (data == "success") {
                switch (staff_id) {
                    case "0":
                        $('#trade-in-driver-btn-' + trade_in_id).attr('class', 'form-control w-auto btn btn-warning btn-sm font-size-14');
                        break;
                    default:
                        $('#trade-in-driver-btn-' + trade_in_id).attr('class', 'form-control w-auto btn btn-success btn-sm font-size-14');
                        break;
                }
                
                swal("success", "top-start", "Successfully changed trade-in driver.", false, 1000, false);
            } else {
                swal("error", "top-start", "Failed to change trade-in driver.", false, 1000, false);
            }
        });
    }

    function updateTradeInStatus(trade_in_id, trade_in_status) {
        $.post("<?= base_url('TradeInController/update_trade_in_status') ?>", {
            trade_in_id: trade_in_id,
            trade_in_status: trade_in_status,
        }, function(data, status){
            if (data == "success") {
                switch (trade_in_status) {
                    case "0":
                        $('#trade-in-status-btn-' + trade_in_id).attr('class', 'form-control w-auto btn btn-warning btn-sm font-size-14');
                        break;
                    case "1":
                        $('#trade-in-status-btn-' + trade_in_id).attr('class', 'form-control w-auto btn btn-success btn-sm font-size-14');
                        break;
                }
                
                swal("success", "top-start", "Successfully changed trade-in status.", false, 1000, false);
            } else {
                swal("error", "top-start", "Failed to change trade-in status.", false, 1000, false);
            }
        });
    }
    
    function updateTradeInPayment(trade_in_id, payment_status) {
        $.post("<?= base_url('TradeInController/update_trade_in_payment') ?>", {
            trade_in_id: trade_in_id,
            payment_status: payment_status,
        }, function(data, status){
            if (data == "success") {
                switch (payment_status) {
                    case "0":
                        $('#trade-in-payment-btn-' + trade_in_id).attr('class', 'form-control w-auto btn btn-warning btn-sm font-size-14');
                        break;
                    case "1":
                    case "2":
                        $('#trade-in-payment-btn-' + trade_in_id).attr('class', 'form-control w-auto btn btn-success btn-sm font-size-14');
                        break;
                }
                
                swal("success", "top-start", "Successfully changed trade-in payment status.", false, 1000, false);
            } else {
                swal("error", "top-start", "Failed to change trade-in payment status.", false, 1000, false);
            }
        });
    }
</script>

</body>

</html>