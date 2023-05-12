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
        <div class="main-content">

            <div class="page-content">
                <?= $page_title ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title mb-4">
                                    <div class="float-end font-size-16">
                                        <a href="/hotel_add" class="btn font-16 btn-primary" id="">
                                            <i class="mdi mdi-plus-circle-outline"></i> 
                                            <?= lang('Add New Hotel') ?>
                                        </a>
                                    </div>
                                    <h4 class="card-title mb-4"><?= $title ?></h4>
                                </div>
                                <br>
                                <?= $this->include('partials/alert') ?>

                                <div class="table-responsive">
                                    <table id="datatable" class="table table-nowrap table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center"><?= lang('Actions') ?></th>
                                                <th class="text-center"><?= lang('Hotel Name') ?></th>
                                                <th class="text-center"><?= lang('Photo') ?></th>
                                                <th class="text-center"><?= lang('Price (RM)') ?></th>
                                                <th class="text-center"><?= lang('Created At') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $db = db_connect();
                                                $i = 0;
                                                
                                                function reformatDate($date) {
                                                    return date("d M", strtotime($date));
                                                }
                                                
                                                foreach ($hotels as $data) {
                                                    $price = $db->query("SELECT * FROM hotel_pricing WHERE hotel_id = '$data[hotel_id]'")->getResultArray();
                                                    $i++;
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $i ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= base_url('update_hotel/'.$data['hotel_id']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                            <a href="<?= base_url('delete_hotel/'.$data['hotel_id']) ?>" class="btn btn-danger" onclick="return confirm('Delete this hotel from the system ?');"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                        <td class="text-center">
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="javascript: void(0);" class="text-dark">
                                                                    <?= "<b>$data[name]</b><br><small>$data[address]<br><i>$data[description]</i></small>"; ?>
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        <td class="text-center col-2">
                                                            <?php
                                                                if ($data['photo'] != "") {
                                                            ?>
                                                                    <img src="<?= base_url('uploads/hotels/'.$data['photo']) ?>" class="w-100">
                                                            <?php
                                                                } else {
                                                                    echo "n/a";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="javascript: void(0);" class="text-dark" style="white-space: pre-line">
                                                                    <?php
                                                                        if (COUNT($price) == 0) {
                                                                            echo "n/a";
                                                                        } else {
                                                                            foreach($price as $p) {
                                                                                echo "<br>$p[price] (".reformatDate($p['start_date'])." ~ ".reformatDate($p['end_date']).")";
                                                                            }
                                                                        }
                                                                    ?>
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
            paging: true,
        });
    });
</script>

</body>

</html>