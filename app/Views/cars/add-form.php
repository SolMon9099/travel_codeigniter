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
                                <h4 class="card-title mb-4"><?= $title ?></h4>
                                
                                <form action="<?= base_url('save_car');?>" method="post" enctype='multipart/form-data'>
                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <div class="col-lg-12 mb-2">
                                                <label class="form-label">Car Name</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                        </div>
                                        
                                        <!--
                                        <div class="col-lg-6 mb-2">
                                            <div class="col-lg-12 mb-2">
                                                <label class="form-label">Price (RM)</label>
                                                <input type="text" class="form-control" name="price">
                                            </div>
                                        </div>
                                        -->
                                        
                                        <div class="col-lg-6 mb-2">
                                            <div class="col-lg-12 mb-2">
                                                <label class="form-label">Plate No.</label>
                                                <input type="text" class="form-control" name="license_plate">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 mb-2">
                                            <div class="col-lg-12 mb-2">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="0" selected>Available</option>
                                                    <option value="1">Rented</option>
                                                </select>
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
                                                <label class="form-label">Car Description</label>
                                                <textarea class="form-control" name="description" onkeyup="textAreaAdjust(this)"></textarea>
                                            </div>
                                        </div>
                                        
                                        <br>
                                        
                                        <div class="col-lg-12 mb-2">
                                            <div class="col-lg-12 mb-2">
                                                <label>Pricing</label><br>
                                                <button type="button" class="btn btn-warning w-auto" onclick="addRow();"><i class="fa fa-plus"></i></button>
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-centered mb-0" id="car-pricing-list">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="2" class="text-center">Start & End Date for the Price</th>
                                                                <th rowspan="2" class="text-center">Price (RM)</th>
                                                                <th rowspan="2" class="text-center">Actions</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-center">Start Date</th>
                                                                <th class="text-center">End Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="col-sm-4">
                                                                    <input type="date" id="start_date1" class="form-control" name="start_date[]" value=""/>
                                                                </td>
                                                                <td class="col-sm-4">
                                                                    <input type="date" id="end_date1" class="form-control" name="end_date[]" value=""/>
                                                                </td>
                                                                <td class="col-sm-3">
                                                                    <input type="text" id="price1" step="0.01" class="form-control" name="price[]" onkeypress="return isNumber(event, 1);"/>
                                                                </td>
                                                                <td class="col-sm-1 text-center">
                                                                    <a type="button" class="ibtnDel btn btn-xs btn-danger" onclick="this.parentNode.parentNode.remove();">
                                                                        <i class="fa fa-trash i_link" title="Delete" style="color:white"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="button" class="btn btn-warning w-auto" onclick="addRow();"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>

                                        <br>
                                        <br>
                                        
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
<script>
    var counter = parseInt(1);
    
    function isNumber(evt, type) { // type 0 = no decimal, type 1 = with decimal
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46 && type == 1) {
          return true;  
        } else if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }    

    function addRow() {
        counter += 1;
        
          var newRow = $("<tr>");
          var cols = "";
          cols += `
            <td class="col-sm-4">
                <input type="date" id="start_date`+ counter +`" class="form-control" name="start_date[]" value=""/>
            </td>
            <td class="col-sm-4">
                <input type="date" id="end_date`+ counter +`" class="form-control" name="end_date[]" value=""/>
            </td>
            <td class="col-sm-3">
                <input type="text" id="price`+ counter +`" step="0.01" class="form-control" name="price[]" onkeypress="return isNumber(event, 1);"/>
            </td>
            <td class="col-sm-1 text-center">
                <a type="button" class="ibtnDel btn btn-xs btn-danger" onclick="this.parentNode.parentNode.remove();">
                    <i class="fa fa-trash i_link" title="Delete" style="color:white"></i>
                </a>
            </td>
          `;
          newRow.append(cols);
          $("#car-pricing-list").append(newRow);
    }
</script>
</body>

</html>