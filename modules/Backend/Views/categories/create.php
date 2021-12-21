<?= $this->extend('Modules\Backend\Views\base') ?>

<?= $this->section('title') ?>
<?= lang('Backend.' . $title->pagename) ?>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/be-assets/node_modules/@yaireo/tagify/dist/tagify.css">
<link rel="stylesheet" href="/be-assets/plugins/jquery-ui/jquery-ui.css">
<link rel="stylesheet" type="text/css"
      href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="/be-assets/plugins/elFinder/css/elfinder.full.css">
<link rel="stylesheet" href="/be-assets/plugins/elFinder/css/theme.css">
<!-- Select2 -->
<link rel="stylesheet" href="/be-assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/be-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
                    <a href="<?= route_to('categories', 1) ?>" class="btn btn-outline-info"><i
                                class="fas fa-arrow-circle-left"></i> Listeye Dön</a>
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
            <form action="<?= route_to('categoryCreate') ?>" class="form-row" method="post">
                <?= csrf_field() ?>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="">Kategori Adı</label>
                        <input type="text" class="form-control ptitle" required name="title">
                    </div>
                    <div class="form-group">
                        <label for="">Kategori URL</label>
                        <input type="text" class="form-control seflink" name="seflink" required>
                    </div>
                    <div class="form-group">
                        <label for="">Seo Açıklaması</label>
                        <textarea name="description" class="form-control" rows="10"></textarea>
                    </div>
                </div>
                <div class="col-md-4 row">
                    <div class="col-md-12 form-group">
                        <label for="">Üst Kategori</label>
                        <select name="parent" id="" class="form-control select2bs4" data-placeholder="Select a Category">
                            <option value="">Select a Category</option>
                            <?php foreach ($categories as $category) :?>
                            <option value="<?=$category->_id?>"><?=$category->title?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Kapak Görseli</label>
                        <img src="" alt="" class="pageimg img-fluid">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Görsel URL</label>
                        <input type="text" name="pageimg" class="form-control pageimg-input"
                               placeholder="Görsel URL">
                    </div>
                    <div class="col-md-12 row form-group">
                        <div class="col-sm-6">
                            <label for="">Görsel Genişliği</label>
                            <input type="number" name="pageIMGWidth" class="form-control" id="pageIMGWidth"
                                   readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Görsel Yüksekliği</label>
                            <input type="number" name="pageIMGHeight" class="form-control" id="pageIMGHeight"
                                   readonly>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="button" class="pageIMG btn btn-info w-100">Görsel Seçiniz</button>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Seo Anahtar Kelimeleri</label>
                        <textarea name="keywords" class="keywords" placeholder="write some tags"></textarea>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-success float-right">Ekle</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/be-assets/plugins/jquery-ui/jquery-ui.js"></script>
<script src="/be-assets/node_modules/@yaireo/tagify/dist/jQuery.tagify.min.js"></script>
<script src="/be-assets/plugins/elFinder/js/elfinder.full.js"></script>
<script src="/be-assets/plugins/elFinder/js/i18n/elfinder.tr.js"></script>
<script src="/be-assets/plugins/elFinder/js/extras/editors.default.js"></script>
<script src="/be-assets/plugins/summernote/plugin/elfinder/summernote-ext-elfinder.js"></script>
<!-- Select2 -->
<script src="/be-assets/plugins/select2/js/select2.full.min.js"></script>
<script src="/be-assets/js/ci4ms.js"></script>
<script>
    tags([]);

    $('.ptitle').on('change', function () {
        $.post('<?=route_to('checkSeflink')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            'makeSeflink': $(this).val(),
            'where': 'categories'
        }, 'json').done(function (data) {
            $('.seflink').val(data.seflink);
        });
    });

    $('.seflink').on('change', function () {
        $.post('<?=route_to('checkSeflink')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            'makeSeflink': $(this).val(),
            'where': 'categories'
        }, 'json').done(function (data) {
            $('.seflink').val(data.seflink);
        });
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>
<?= $this->endSection() ?>