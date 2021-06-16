<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noimageindex, nofollow, nosnippet">

    <title>Kun-CMS/ERP <?= $backConfig->vers ?> | <?=lang('Backend.'.$title)?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/be-assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/be-assets/css/adminlte.min.css">
    <link rel="stylesheet" href="/be-assets/custom.css">

    <?= $this->renderSection('head') ?>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-kun-cms border-0">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown mr-2">
                <a class="nav-link badge-shadow btn-outline-success" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-warning navbar-badge font-weight-bold">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="../../be-assets/img/user1-128x128.jpg" alt="User Avatar"
                                 class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="../../be-assets/img/user8-128x128.jpg" alt="User Avatar"
                                 class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="../../be-assets/img/user3-128x128.jpg" alt="User Avatar"
                                 class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown mr-2">
                <a class="nav-link badge-shadow btn-outline-success" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge font-weight-bold">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown mr-2">
                <a class="nav-link badge-shadow btn-outline-success" data-toggle="dropdown" href="#">
                    <i class="fas fa-ticket-alt"></i>
                    <span class="badge badge-warning navbar-badge font-weight-bold">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-olive elevation-1">
        <!-- Brand Logo -->
        <a href="<?= base_url('backend') ?>" class="brand-link navbar-kun-cms text-center">
            <img src="/be-assets/img/logo-w.png" alt="" class="img-responsive" height="25">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image d-flex align-items-center">
                    <img src="/be-assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info w-100">
                    <button class="btn btn-light w-100" type="button" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <?= $logged_in_user->firstname . ' ' . $logged_in_user->sirname ?> <br>
                        <small class="text-success font-weight-bold">{ <?= $logged_in_user->groupInfo[0]->name ?>
                            }</small>
                    </button>
                </div>
            </div>
            <div class="collapse mb-2 border-bottom" id="collapseExample">
                <div class="card card-body">
                    <span><i class="fas fa-user"></i> <a class="link-black" href="<?= base_url('/backend/profile') ?>">Profil</a></span>
                    <div class="dropdown-divider"></div>
                    <span><i class="fas fa-sign-out-alt"></i> <a class="link-black"
                                                                 href="<?= base_url('backend/logout') ?>">Çıkış Yap</a></span>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent"
                    data-widget="treeview" role="menu" data-accordion="false">
                    <?php function navigation($navigation, $uri, $child = null)
                    {
                        foreach ($navigation as $nav) :
                            $p = null;
                            foreach ($navigation as $item) {
                                if ($item->sefLink!='profile' && $item->sefLink === $uri)
                                    $p = $item;
                            }
                            if ($nav->parent_pk == $child) : ?>
                                <li class="nav-item <?= (!empty($p) && $p->parent_pk == $nav->_id) ? 'menu-is-opening menu-open' : '' ?>">
                                    <a href="<?php
                                    $u = explode('/', $nav->sefLink);
                                    if (empty($u[1]))
                                        echo route_to($u[0]);
                                    else
                                        echo route_to($u[0], $u[1]); ?>"
                                       class="nav-link <?php if(!empty($p)){ if($nav->sefLink == $uri || $p->parent_pk == $nav->_id) echo 'active'; else echo '';} ?>">
                                        <i class="nav-icon <?= $nav->symbol ?>"></i>
                                        <p><?= lang('Backend.'.$nav->pagename) ?><?= ($nav->hasChild == true) ? '<i class="right fas fa-angle-left"></i>' : '' ?></p>
                                    </a>
                                    <?php if ($nav->hasChild == true): ?>
                                        <ul class="nav nav-treeview">
                                            <?php navigation($navigation, $uri, $nav->_id); ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endif;
                        endforeach;
                    }

                    navigation($navigation, $uri);
                    ?>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?= $this->renderSection('content') ?>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> <?= $backConfig->vers ?>
        </div>
        <strong>Copyright &copy; <?= date('Y') ?>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/be-assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/be-assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/be-assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/be-assets/js/demo.js"></script>

<?= $this->renderSection('javascript') ?>
</body>
</html>
