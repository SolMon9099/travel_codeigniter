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
                <div class="row align-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4"><?= lang('Update Customer') ?></h4>

                                <form action="<?= base_url('save_update_customer/'.$customer['customer_id']);?>" method="POST">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label"><?= lang('Customer Name') ?></label>
                                                <input class="form-control" type="text" name="name" placeholder="" value="<?= $customer['name'] ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label"><?= lang('Phone No.') ?></label>
                                                <input class="form-control" type="text" name="phone" placeholder="" value="<?= $customer['phone'] ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label"><?= lang('Email') ?></label>
                                                <input class="form-control" type="text" name="email" placeholder="" value="<?= $customer['email'] ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label"><?= lang('Password') ?></label>
                                                <input class="form-control" type="text" name="password"placeholder="" value="<?= $customer['password'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        <?= lang('Files.Update') ?>
                                    </button>
                                </form>

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

</body>

</html>