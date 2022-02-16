<@?= $this->extend('Modules\Backend\Views\base') ?>

<@?= $this->section('title') ?>
<@?=lang('Backend.'.$title->pagename)?>
<@?= $this->endSection() ?>

<@?= $this->section('head') ?>
<<<<<<< HEAD
<link rel="stylesheet" href="/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
=======
<link rel="stylesheet" href="/be-assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
>>>>>>> dev
<@?= $this->endSection() ?>

<@?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><@?=lang('Backend.'.$title->pagename)?></h1>
            </div>
<<<<<<< HEAD
            div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <a href="<@?= route_to('') ?>" class="btn btn-outline-info"><i
                            class="fas fa-arrow-circle-left"></i> Listeye Dön</a>
            </ol>
        </div>
=======
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="<@?= route_to('') ?>" class="btn btn-outline-info"><i
                                class="fas fa-arrow-circle-left"></i> Listeye Dön</a>
                </ol>
            </div>
>>>>>>> dev
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-outline card-shl">
        <div class="card-header">
<<<<<<< HEAD
            <h3 class="card-title font-weight-bold">Site Ayarlarını güncelle</h3>
=======
            <h3 class="card-title font-weight-bold"><@?= lang('Backend.' . $title->pagename) ?></h3>
>>>>>>> dev

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <@?= view('Modules\Auth\Views\_message_block') ?>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<@?= $this->endSection() ?>

<@?= $this->section('javascript') ?>
<<<<<<< HEAD
<script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
=======
<script src="/be-assets/plugins/sweetalert2/sweetalert2.min.js"></script>
>>>>>>> dev
<@?= $this->endSection() ?>
