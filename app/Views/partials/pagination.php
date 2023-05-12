<!-- Pagination Start -->
<?php
    if ($entries != 0) {
?>
        <div class="nav-scroller py-1">
            <nav class="nav" aria-label="Page navigation example">
              <ul class="pagination mb-0">
                <li class="page-item <?= $page <= 1 ? "disabled" : "" ?>" style="margin-right: 20px;">
                    <div class="input-group">
                        <span class="mt-2 text-dark">Show&ensp;</span>
                        <div class="dropdown">
                          <button class="btn btn-outline-secondary dropdown-toggle text-dark" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $entries ?>
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="<?= base_url("$module/1/10") ?>">10</a></li>
                            <li><a class="dropdown-item" href="<?= base_url("$module/1/25") ?>">25</a></li>
                            <li><a class="dropdown-item" href="<?= base_url("$module/1/50") ?>">50</a></li>
                            <li><a class="dropdown-item" href="<?= base_url("$module/1/100") ?>">100</a></li>
                            <li><a class="dropdown-item" href="<?= base_url("$module/1/250") ?>">250</a></li>
                            <li><a class="dropdown-item" href="<?= base_url("$module/1/500") ?>">500</a></li>
                            <li><a class="dropdown-item" href="<?= base_url("$module/1/1000") ?>">1000</a></li>
                            <li><a class="dropdown-item" href="<?= base_url("$module/1/2500") ?>">2500</a></li>
                            <li><a class="dropdown-item" href="<?= base_url("$module/1/5000") ?>">5000</a></li>
                          </ul>
                        </div>
                        <span class="mt-2 text-dark">&ensp;entries</span>
                    </div>
                </li>
                
                &emsp;
                
                <li class="page-item <?= ($page <= 1 || $total_page == 0) ? "disabled" : "" ?>">
                    <a class="page-link" href="<?= $page <= 1 ? "#" : base_url("$module/".($page-1)."/$entries") ?>">Previous</a>
                </li>
                <li class="page-item <?= $page == 1 ? "active" : "" ?>"><a class="page-link" href="<?= base_url("$module/1/$entries") ?>">1</a></li>
                
                <?php
                    if ($total_page < 6) {
                        for ($i = 2; $i < $total_page; $i++) {
                ?>
                            <li class="page-item <?= $page == $i ? "active" : "" ?>"><a class="page-link" href="<?= base_url("$module/$i/$entries") ?>"><?= $i ?></a></li>
                <?php
                        }
                    } else {
                        if ($page == 1 || $page == 2 || $page == 3) {
                ?>
                            <li class="page-item <?= $page == 2 ? "active" : "" ?>"><a class="page-link" href="<?= base_url("$module/2/$entries") ?>"><?= 2 ?></a></li>
                            <li class="page-item <?= $page == 3 ? "active" : "" ?>"><a class="page-link" href="<?= base_url("$module/3/$entries") ?>"><?= 3 ?></a></li>
                            <li class="page-item <?= $page == 4 ? "active" : "" ?>"><a class="page-link" href="<?= base_url("$module/4/$entries") ?>"><?= 4 ?></a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                <?php
                        } else if ($page == $total_page || $page == $total_page-1 || $page == $total_page-2) {
                ?>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item <?= $page == $total_page-3 ? "active" : "" ?>"><a class="page-link" href="<?= base_url("$module/".($total_page-3)."/$entries") ?>"><?= $total_page-3 ?></a></li>
                            <li class="page-item <?= $page == $total_page-2 ? "active" : "" ?>"><a class="page-link" href="<?= base_url("$module/".($total_page-2)."/$entries") ?>"><?= $total_page-2 ?></a></li>
                            <li class="page-item <?= $page == $total_page-1 ? "active" : "" ?>"><a class="page-link" href="<?= base_url("$module/".($total_page-1)."/$entries") ?>"><?= $total_page-1 ?></a></li>
                <?php
                        } else {
                ?>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="<?= base_url("$module/".($page-1)."/$entries") ?>"><?= $page-1 ?></a></li>
                            <li class="page-item active"><a class="page-link" href="<?= base_url("$module/$page/$entries") ?>"><?= $page ?></a></li>
                            <li class="page-item"><a class="page-link" href="<?= base_url("$module/".($page+1)."/$entries") ?>"><?= $page+1 ?></a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                <?php
                        }
                    }
                ?>
                
                <li class="page-item <?= $page == $total_page ? "active " : "" ?> <?= $total_page <= 1 ? " d-none" : "" ?>"><a class="page-link" href="<?= base_url("$module/$total_page/$entries") ?>"><?= $total_page ?></a></li>
                <li class="page-item <?= ($page >= $total_page || $total_page == 0) ? "disabled" : "" ?>">
                    <a class="page-link" href="<?= $page >= $total_page ? "#" : base_url("$module/".($page+1)."/$entries") ?>">Next</a>
                </li>
                
              </ul>
              
              &emsp;
              
              <?php
                $first_entries = ($page-1) * $entries + 1;
                $last_entries = $page == $total_page ? $total_entries : (($page-1) * $entries + $entries);
              ?>
              <span class="mt-2 text-dark">Showing <?= $first_entries ?> to <?= $last_entries ?> of <?= $total_entries ?> entries</span>
              
            </nav>
        </div>
<?php
    }
?>
<!-- Pagination End -->