<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="<?= base_url("assets/images/users/admin.png") ?>" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="javascript: void(0);" class="text-dark fw-medium font-size-16"><?= session()->name ?></a>
                <p class="text-body mt-1 mb-0 font-size-13">
                    <?php
                        switch (session()->role) {
                            case "0":
                                echo "Admin";
                                break;
                            case "1":
                                echo "Staff";
                                break;
                        }
                    ?>
                </p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title"><?= lang('Files.Menu') ?></li>
                
                <?php
                    if (session()->role == "0" || session()->role == "1") {
                ?>
                        <!--
                        <li>
                            <a href="/dashboard" class="waves-effect">
                                <i class="mdi mdi-airplay"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        -->
                        
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-clipboard"></i>
                                <span>Orders</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/order">Order List</a></li>
                                <li><a href="/order_add">Add New Order</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-account-multiple"></i>
                                <span>Customers</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/customer">Customer List</a></li>
                                <li><a href="/customer_add">Add New Customer</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-account-circle"></i>
                                <span>Staffs</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/staff">Staff List</a></li>
                                <li><a href="/staff_add">Add New Staff</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-home-modern"></i>
                                <span>Hotels</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/hotel">Hotel List</a></li>
                                <li><a href="/hotel_add">Add New Hotel</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-car"></i>
                                <span>Cars</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/car">Car List</a></li>
                                <li><a href="/car_add">Add New Car</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-package"></i>
                                <span>Packages</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/package">Package List</a></li>
                                <li><a href="/package_add">Add New Package</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-gift"></i>
                                <span>Souvenirs</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/souvenir">Souvenir List</a></li>
                                <li><a href="/souvenir_add">Add New Souvenir</a></li>
                            </ul>
                        </li>
                <?php
                    }
                ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>