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
                        <div class="souvenird">
                            <div class="souvenird-body">
                                <h4 class="souvenird-title mb-4"><?= $title ?></h4>
                                
                                <form action="<?= base_url('save_souvenir');?>" method="post" enctype='multipart/form-data'>
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <div class="col-lg-12 mb-2">
                                                <label class="form-label">Souvenir Name</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 mb-2">
                                            <div class="col-lg-12 mb-2">
                                                <label class="form-label">Price (RM)</label>
                                                <input type="text" class="form-control" name="price">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 mb-2">
                                            <div class="col-lg-12 mb-2">
                                                <label class="form-label">Photo</label>
                                                <input class="form-control" type="file" id="images" name="photo" accept="image/png, image/jpeg, image/jpg, image/webp" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-2">
                                            <div class="col-lg-12 mb-2">
                                                <label class="form-label">Souvenir Description</label>
                                                <textarea class="form-control" name="description" onkeyup="textAreaAdjust(this)"></textarea>
                                            </div>
                                        </div>
                                        
                                    </div><!--end row-->
                                    
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        <?= lang('Files.Submit') ?>
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
<script>
    function textAreaAdjust(element) {
        element.style.height = "1px";
        element.style.height = (25+element.scrollHeight)+"px";
    }
</script>
</body>

</html>