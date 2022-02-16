<?= $this->extend('Modules\Backend\Views\base') ?>
<?= $this->section('title') ?>
<?= lang('Backend.' . $title->pagename) ?>
<?= $this->endSection() ?>
<?= $this->section('head') ?>
<<<<<<< HEAD
<link rel="stylesheet" href="/be-assets/node_modules/@yaireo/tagify/dist/tagify.css">
<link rel="stylesheet" href="/be-assets/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="/be-assets/plugins/jquery-ui/jquery-ui.css">
<link rel="stylesheet" type="text/css"
      href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="/be-assets/plugins/elFinder/css/elfinder.full.css">
<link rel="stylesheet" href="/be-assets/plugins/elFinder/css/theme.css">
=======
<?=link_tag("be-assets/node_modules/@yaireo/tagify/dist/tagify.css")?>
<?=link_tag("be-assets/plugins/summernote/summernote-bs4.css")?>
<?=link_tag("be-assets/plugins/jquery-ui/jquery-ui.css")?>
<link rel="stylesheet" type="text/css"
      href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<?=link_tag("be-assets/plugins/elFinder/css/elfinder.full.css")?>
<?=link_tag("be-assets/plugins/elFinder/css/theme.css")?>
>>>>>>> dev
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
<<<<<<< HEAD
                    <a href="<?= route_to('pages', 1) ?>" class="btn btn-outline-info"><i
                                class="fas fa-arrow-circle-left"></i> Listeye Dön</a>
=======
                    <a href="<?= route_to('pages', 1) ?>" class="btn btn-outline-info"><?=lang('Backend.backToList')?></a>
>>>>>>> dev
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
<<<<<<< HEAD
            <h3 class="card-title font-weight-bold">Sayfa Oluşur</h3>
=======
            <h3 class="card-title font-weight-bold"><?= lang('Backend.' . $title->pagename) ?></h3>
>>>>>>> dev

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <?= view('Modules\Auth\Views\_message_block') ?>
            <form action="<?= route_to('pageCreate') ?>" class="form-row" method="post">
                <?= csrf_field() ?>
                <div class="col-md-8 form-group row">
                    <div class="form-group col-md-12">
<<<<<<< HEAD
                        <label for="">Sayfa Başlığı</label>
                        <input type="text" name="title" class="form-control ptitle" placeholder="Sayfa Başlığı"
                               required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Sayfa URL</label>
                        <input type="text" class="form-control seflink" name="seflink" required">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">İçerik</label>
=======
                        <label for=""><?=lang('Backend.title')?></label>
                        <input type="text" name="title" class="form-control ptitle" placeholder="<?=lang('Backend.title')?>"
                               required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for=""><?=lang('Backend.url')?></label>
                        <input type="text" class="form-control seflink" name="seflink" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for=""><?=lang('Backend.content')?></label>
>>>>>>> dev
                        <textarea name="content" rows="60" class="form-control editor" required></textarea>
                    </div>
                </div>
                <div class="col-md-4 form-group row">
<<<<<<< HEAD
                    <div class="form-group col-12">
                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                        <label class="btn btn-outline-secondary">
                            <input type="radio" name="isActive" id="option1" autocomplete="off" value="0"> Taslak
                        </label>
                            <label class="btn btn-outline-secondary active">
                                <input type="radio" name="isActive" id="option2" autocomplete="off" checked value="1"> Yayında
=======
                    <div class="form-group col-md-12">
                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                        <label class="btn btn-outline-secondary">
                            <input type="radio" name="isActive" id="option1" autocomplete="off" value="0"> <?=lang('Backend.draft')?>
                        </label>
                            <label class="btn btn-outline-secondary active">
                                <input type="radio" name="isActive" id="option2" autocomplete="off" checked value="1"> <?=lang('Backend.publish')?>
>>>>>>> dev
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-12 row">
<<<<<<< HEAD
                        <div class="col-12 form-group">
                            <label for="">Sayfa Görseli</label>
                            <img src="" alt="" class="pageimg img-fluid">
                        </div>
                        <div class="col-12 form-group">
                            <label for="">Görsel URL</label>
                            <input type="text" name="pageimg" class="form-control pageimg-input"
                                   placeholder="Görsel URL">
                        </div>
                        <div class="col-12 row form-group">
                            <div class="col-sm-6">
                                <label for="">Görsel Genişliği</label>
=======
                        <div class="col-md-12 form-group">
                            <label for=""><?=lang('Backend.coverImage')?></label>
                            <img src="" class="pageimg img-fluid">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for=""><?=lang('Backend.coverImgURL')?></label>
                            <input type="text" name="pageimg" class="form-control pageimg-input"
                                   placeholder="<?=lang('Backend.coverImgURL')?>">
                        </div>
                        <div class="col-md-12 row form-group">
                            <div class="col-sm-6">
                                <label for=""><?=lang('Backend.coverImgWith')?></label>
>>>>>>> dev
                                <input type="number" name="pageIMGWidth" class="form-control" id="pageIMGWidth"
                                       readonly>
                            </div>
                            <div class="col-sm-6">
<<<<<<< HEAD
                                <label for="">Görsel Yüksekliği</label>
=======
                                <label for=""><?=lang('Backend.coverImgHeight')?></label>
>>>>>>> dev
                                <input type="number" name="pageIMGHeight" class="form-control" id="pageIMGHeight"
                                       readonly>
                            </div>
                        </div>
<<<<<<< HEAD
                        <div class="col-12 form-group">
                            <button type="button" class="pageIMG btn btn-info w-100">Görsel Seçiniz</button>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Seo Açıklaması</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Seo Anahtar Kelimeleri</label>
                        <textarea name="keywords" class="keywords" placeholder="write some tags"></textarea>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-success float-right">Ekle</button>
=======
                        <div class="col-md-12 form-group">
                            <button type="button" class="pageIMG btn btn-info w-100"><?=lang('Backend.selectCoverImg')?></button>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for=""><?=lang('Backend.seoDescription')?></label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for=""><?=lang('Backend.seoKeywords')?></label>
                        <textarea name="keywords" class="keywords" placeholder="write some keywords"></textarea>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-success float-right"><?=lang('Backend.add')?></button>
>>>>>>> dev
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
<<<<<<< HEAD
<script src="/be-assets/plugins/jquery-ui/jquery-ui.js"></script>
<script src="/be-assets/node_modules/@yaireo/tagify/dist/jQuery.tagify.min.js"></script>
<script src="/be-assets/plugins/summernote/summernote-bs4.js"></script>
<script src="/be-assets/plugins/elFinder/js/elfinder.full.js"></script>
<script src="/be-assets/plugins/elFinder/js/i18n/elfinder.tr.js"></script>
<script src="/be-assets/plugins/elFinder/js/extras/editors.default.js"></script>
<script src="/be-assets/plugins/summernote/plugin/elfinder/summernote-ext-elfinder.js"></script>
<script src="/be-assets/js/ci4ms.js"></script>
<script>
    $.post('<?=route_to('tagify')?>', {
        "<?=csrf_token()?>": "<?=csrf_hash()?>",
        "type": "page"
    }, 'json').done(function (data) {
        tags(data);
    });
=======
<?=script_tag("be-assets/plugins/jquery-ui/jquery-ui.js")?>
<?=script_tag("be-assets/node_modules/@yaireo/tagify/dist/jQuery.tagify.min.js")?>
<?=script_tag("be-assets/plugins/summernote/summernote-bs4.js")?>
<?=script_tag("be-assets/plugins/elFinder/js/elfinder.full.js")?>
<?=script_tag("be-assets/plugins/elFinder/js/i18n/elfinder.tr.js")?>
<?=script_tag("be-assets/plugins/elFinder/js/extras/editors.default.js")?>
<?=script_tag("be-assets/plugins/summernote/plugin/elfinder/summernote-ext-elfinder.js")?>
<?=script_tag("be-assets/js/ci4ms.js")?>
<script>
    tags([]);
>>>>>>> dev

    $('.ptitle').on('change', function () {
        $.post('<?=route_to('checkSeflink')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            'makeSeflink': $(this).val(),
<<<<<<< HEAD
            'where': 'page'
=======
            'where': 'pages'
>>>>>>> dev
        }, 'json').done(function (data) {
            $('.seflink').val(data.seflink);
        });
    });

    $('.seflink').on('change', function () {
        $.post('<?=route_to('checkSeflink')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            'makeSeflink': $(this).val(),
<<<<<<< HEAD
            'where': 'page'
=======
            'where': 'pages'
>>>>>>> dev
        }, 'json').done(function (data) {
            $('.seflink').val(data.seflink);
        });
    });
</script>
<?= $this->endSection() ?>
