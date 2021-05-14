<?= $this->extend('Modules\Backend\Views\base') ?>

<?= $this->section('title') ?>
Installation
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Anasayfa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"></ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-outline card-shl">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">En Son Baktığım Aktivitelerim</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 col-md-3 text-center">
                    <div class="card">
                        <img src="" class="card-img-top" alt="" height="200">
                        <div class="card-footer bg-olive">
                            <div class="text-center font-weight-bold">Yetkinlik 1</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <div class="card">
                        <img src="" class="card-img-top" alt="" height="200">
                        <div class="card-footer bg-olive">
                            <div class="text-center font-weight-bold">Yetkinlik 1</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <div class="card">
                        <img src="" class="card-img-top" alt="" height="200">
                        <div class="card-footer bg-olive">
                            <div class="text-center font-weight-bold">Yetkinlik 1</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <div class="card">
                        <img src="" class="card-img-top" alt="" height="200">
                        <div class="card-footer bg-olive">
                            <div class="text-center font-weight-bold">Yetkinlik 1</div>
                        </div>
                    </div>
                </div>
            </div>
            Yetkinlik görevlerinden baktığı son 4 tanesini göstereceğiz.
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<?= $this->endSection() ?>
