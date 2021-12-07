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
                <div class="col-md-6" id="list">
                    <h4><strong>Sayfalar</strong></h4>
                    <form class="list-group">
                        <?php foreach ($pages as $page): ?>
                            <div class="list-group-item" id="page-<?= $page->_id ?>">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-xs-8">
                                        <label class="ml-3">
                                            <input class="form-check-input me-1" type="checkbox"
                                                   value="<?= $page->_id ?>">
                                            <?= $page->title ?>
                                        </label>
                                    </div>
                                    <div class="col-xs-4">
                                        <button class="btn btn-success addPages" type="button"
                                                data-id="<?= $page->_id ?>">Ekle
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="list-group-item">
                            <button class="btn btn-success float-right" type="button" id="addCheckedPages">Seçilenleri
                                ekle
                            </button>
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
                            <button class="btn btn-success float-right" type="button" id="addCheckedBlog">Seçilenleri
                                ekle
                            </button>
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
                        <?php if (!empty($nestable2)) menu($nestable2); ?>
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
        $.post('<?=route_to('queueMenuAjax')?>',{
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            "queue":$(this).nestable('serialize')
        })
    });

    $('.addPages').click(function () {
        var id = $(this).data('id');
        $.post('<?=route_to('createMenu')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            "id": id, 'where': 'pages'
        }).done(function (data) {
            $('.dd').html(data);
            $("#page-" + id + "").remove();
        });
    });

    $('.addBlog').click(function () {
        var id = $(this).data('id');
        $.post('<?=route_to('createMenu')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            "id": id, 'where': 'blog'
        }).done(function (data) {
            $('.dd').html(data);
            $("#blog-" + id + "").remove();
        });
    });

    $('#addCheckedBlog').click(function () {

    });

    $('#addCheckedPages').click(function () {

    });

    $('#addURL').click(function () {

    });

    $('.removeFromMenu').click(function () {
        var id = $(this).data('id');
        console.log(id);
        $.post('<?=route_to('deleteMenuAjax')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>", "id": id
        }).done(function (data) {
            $('.dd').html(data);
            $("#menu-" + id + "").remove();
            $.post('<?=route_to('menuList')?>', {
                "<?=csrf_token()?>": "<?=csrf_hash()?>"
            }).done(function (data) {
               $('#list').html(data);
            });
        });
    })
</script>
<?= $this->endSection() ?>
