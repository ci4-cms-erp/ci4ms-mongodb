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
                    <?= view('\Modules\Backend\Views\menu\list') ?>
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
        $.post('<?=route_to('queueMenuAjax')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            "queue": $(this).nestable('serialize')
        })
    });

    function addPages(id) {
        $.post('<?=route_to('createMenu')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            "id": id, 'where': 'pages'
        }).done(function (data) {
            $('.dd').nestable('destroy');
            $('.dd').html(data);
            $('.dd').nestable();
            $("#page-" + id + "").remove();
        });
    }

    function addCheckedPages() {
        var formData=$('#addCheckedPages').serializeArray();
        formData.push({name: "<?=csrf_token()?>", value: "<?=csrf_hash()?>"});
        console.log(formData);
    }

    function addBlog(id) {
        $.post('<?=route_to('createMenu')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            "id": id, 'where': 'blog'
        }).done(function (data) {
            $('.dd').nestable('destroy');
            $('.dd').html(data);
            $('.dd').nestable();
            $("#blog-" + id + "").remove();
        });
    }

    function addCheckedBlog() {
        $('#addCheckedBlog').click(function () {

        });
    }

    function addURL() {
        console.log($('#URL').val());
    }

    function removeFromMenu(id, type) {
        $.post('<?=route_to('deleteMenuAjax')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>", "id": id, "type": type
        }).done(function (data) {
            $('.dd').nestable('destroy');
            $('.dd').html(data);
            $('.dd').nestable();
            $("#menu-" + id + "").remove();
            $.post('<?=route_to('menuList')?>', {
                "<?=csrf_token()?>": "<?=csrf_hash()?>"
            }).done(function (data) {
                $('#list').html(data);
            });
        });
    }
</script>
<?= $this->endSection() ?>
