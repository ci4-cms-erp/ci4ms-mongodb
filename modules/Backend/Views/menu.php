<?= $this->extend('Modules\Backend\Views\base') ?>

<?= $this->section('title') ?>
<?= lang('Backend.' . $title->pagename) ?>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/be-assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="/be-assets/node_modules/nestable2/dist/jquery.nestable.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= lang('Backend.' . $title->pagename) ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-outline card-shl">
        <div class="card-header">
            <h3 class="card-title font-weight-bold"><?= lang('Backend.' . $title->pagename) ?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <?= view('Modules\Auth\Views\_message_block') ?>
            <div class="row">
                <div class="col-md-6">
                    <h4><strong>Sayfalar</strong></h4>
                    <form class="list-group">
                        <div class="list-group-item">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-xs-8">
                                    <label class="ml-3">
                                        <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                        An item
                                    </label>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-success addPages" type="button" data-id="">Ekle</button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-xs-8">
                                    <label class="ml-3">
                                        <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                        A second item
                                    </label>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-success addPages" type="button" data-id="">Ekle</button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-xs-8 ">
                                    <label class="ml-3">
                                        <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                        A third item
                                    </label>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-success addPages" type="button" data-id="">Ekle</button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-xs-8">
                                    <label class="ml-3">
                                        <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                        A fourth item
                                    </label>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-success addPages" type="button" data-id="">Ekle</button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-xs-8">
                                    <label class="ml-3">
                                        <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                        And a fifth one
                                    </label>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-success addPages" type="button" data-id="">Ekle</button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <button class="btn btn-success float-right" type="button" id="addCheckedPages">Seçilenleri ekle</button>
                        </div>
                    </form>
                    <hr>
                    <h4><strong>Yazılar</strong></h4>
                    <form class="list-group">
                        <div class="list-group-item">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-xs-8">
                                    <label class="ml-3">
                                        <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                        An item
                                    </label>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-success addBlog" type="button" data-id="">Ekle</button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-xs-8">
                                    <label class="ml-3">
                                        <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                        A second item
                                    </label>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-success addBlog" type="button" data-id="">Ekle</button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-xs-8 ">
                                    <label class="ml-3">
                                        <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                        A third item
                                    </label>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-success addBlog" type="button" data-id="">Ekle</button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-xs-8">
                                    <label class="ml-3">
                                        <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                        A fourth item
                                    </label>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-success addBlog" type="button" data-id="">Ekle</button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-xs-8">
                                    <label class="ml-3">
                                        <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                        And a fifth one
                                    </label>
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-success addBlog" type="button" data-id="">Ekle</button>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <button class="btn btn-success float-right" type="button" id="addCheckedBlog">Seçilenleri ekle</button>
                        </div>
                    </form>

                    <form action="" method="post" class="form-row mt-2">
                        <div class="col-md-10 form-group">
                            <input type="text" class="form-control" placeholder="URL giriniz" id="URL">
                        </div>
                        <div class="col-md-2 form-group">
                            <button class="btn btn-success w-100" type="button" id="addURL">URL ekle</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="dd">
                        <ol class="dd-list">
                            <li class="dd-item" data-id="1">
                                <div class="dd-handle">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>teser</span>
                                        <button class="btn btn-sm btn-danger float-right" data-id="1" type="button"><i
                                                    class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </li>
                            <li class="dd-item" data-id="2">
                                <div class="dd-handle">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Item 2</span>
                                        <button class="btn btn-sm btn-danger float-right" data-id="2" type="button"><i
                                                    class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </li>
                            <li class="dd-item" data-id="3">
                                <div class="dd-handle">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Item 3</span>
                                        <button class="btn btn-sm btn-danger float-right" data-id="3" type="button"><i
                                                    class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="4">
                                        <div class="dd-handle">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span>Item 4</span>
                                                <button class="btn btn-sm btn-danger float-right" data-id="4"
                                                        type="button"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/be-assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="/be-assets/node_modules/nestable2/dist/jquery.nestable.min.js"></script>
<script>
    $('.dd').nestable().on('change', function () {
        console.log($(this).nestable('serialize'));
        alert('burada');
    });

    $('.addPages').click(function () {

    });
    $('.addBlog').click(function () {

    });
    $('#addCheckedBlog').click(function () {

    });
    $('#addCheckedPages').click(function () {

    });
    $('#addURL').click(function () {

    });
</script>
<?= $this->endSection() ?>
