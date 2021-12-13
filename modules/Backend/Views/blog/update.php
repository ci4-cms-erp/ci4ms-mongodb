<?= $this->extend('Modules\Backend\Views\base') ?>

<?= $this->section('title') ?>
<?= lang('Backend.' . $title->pagename) ?>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/be-assets/node_modules/@yaireo/tagify/dist/tagify.css">
<link rel="stylesheet" href="/be-assets/plugins/summernote/summernote-bs4.css">
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
                    <a href="<?= route_to('blogs', 1) ?>" class="btn btn-outline-info"><i
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
            <form action="<?= route_to('blogUpdate',$infos->_id) ?>" class="form-row" method="post">
                <?= csrf_field() ?>
                <div class="col-md-8 form-group row">
                    <div class="form-group col-md-12">
                        <label for="">Blog Başlığı</label>
                        <input type="text" name="title" class="form-control ptitle" placeholder="Sayfa Başlığı"
                               required value="<?= $infos->title ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Blog URL</label>
                        <input type="text" class="form-control seflink" name="seflink" required"
                        value="<?= $infos->seflink ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">İçerik</label>
                        <textarea name="content" rows="60" class="form-control editor"
                                  required><?= $infos->content ?></textarea>
                    </div>
                </div>
                <div class="col-md-4 form-group row">
                    <div class="form-group col-12">
                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn btn-outline-secondary">
                                <input type="radio" name="isActive" id="option1"
                                       autocomplete="off" <?= ($infos->isActive === false) ? 'checked' : '' ?>
                                       value="0"> Taslak
                            </label>
                            <label class="btn btn-outline-secondary active">
                                <input type="radio" name="isActive" id="option2"
                                       autocomplete="off" <?= ($infos->isActive === true) ? 'checked' : '' ?> value="1">
                                Yayında
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Kategoriler</label>
                        <select name="categories[]" id="" class="form-control select2bs4" multiple="multiple"
                                data-placeholder="Select categories">
                            <?php $selected = [];
                            if(!empty($infos->categories)):
                            foreach ($infos->categories as $icategory):
                                foreach ($categories as $key => $category):
                                    if ($icategory == $category->_id):
                                        $selected[] = $category;
                                        unset($categories[$key]);
                                    endif;
                                endforeach;
                            endforeach;
                            foreach($selected as $select):?>
                                <option value="<?=$select->_id?>" selected><?=$select->title?></option>
                            <?php endforeach;
                            endif;
                            foreach ($categories as $category): ?>
                                <option value="<?= $category->_id ?>"><?= $category->title ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12 row">
                        <div class="col-12 form-group">
                            <label for="">Blog Kapak Görseli</label>
                            <img src="<?=$infos->seo->coverImage?>" alt="" class="pageimg img-fluid">
                        </div>
                        <div class="col-12 form-group">
                            <label for="">Görsel URL</label>
                            <input type="text" name="pageimg" class="form-control pageimg-input"
                                   placeholder="Görsel URL" value="<?=$infos->seo->coverImage?>">
                        </div>
                        <div class="col-12 row form-group">
                            <div class="col-sm-6">
                                <label for="">Görsel Genişliği</label>
                                <input type="number" name="pageIMGWidth" class="form-control" id="pageIMGWidth"
                                       readonly value="<?=$infos->seo->IMGWidth?>">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Görsel Yüksekliği</label>
                                <input type="number" name="pageIMGHeight" class="form-control" id="pageIMGHeight"
                                       readonly value="<?=$infos->seo->IMGHeight?>">
                            </div>
                        </div>
                        <div class="col-12 form-group">
                            <button type="button" class="pageIMG btn btn-info w-100">Görsel Seçiniz</button>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Seo Açıklaması</label>
                        <textarea class="form-control" name="description"><?=$infos->seo->description?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Seo Anahtar Kelimeleri</label>
                        <textarea name="keywords" class="keywords" placeholder="write some tags"><?=$tags?></textarea>
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
<script src="/be-assets/plugins/summernote/summernote-bs4.js"></script>
<script src="/be-assets/plugins/elFinder/js/elfinder.full.js"></script>
<script src="/be-assets/plugins/elFinder/js/i18n/elfinder.tr.js"></script>
<script src="/be-assets/plugins/elFinder/js/extras/editors.default.js"></script>
<script src="/be-assets/plugins/summernote/plugin/elfinder/summernote-ext-elfinder.js"></script>
<script src="/be-assets/plugins/select2/js/select2.full.min.js"></script>
<script src="/be-assets/js/ci4ms.js"></script>
<script>
    $.post('<?=route_to('tagify')?>', {
        "<?=csrf_token()?>": "<?=csrf_hash()?>",
        "type": "blogs"
    }, 'json').done(function (data) {
        tags(data);
    });

    $('.ptitle').on('change', function () {
        $.post('<?=route_to('checkSeflink')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            'makeSeflink': $(this).val(),
            'where': 'blog'
        }, 'json').done(function (data) {
            $('.seflink').val(data.seflink);
        });
    });

    $('.seflink').on('change', function () {
        $.post('<?=route_to('checkSeflink')?>', {
            "<?=csrf_token()?>": "<?=csrf_hash()?>",
            'makeSeflink': $(this).val(),
            'where': 'blog'
        }, 'json').done(function (data) {
            $('.seflink').val(data.seflink);
        });
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({theme: 'bootstrap4'});
</script>
<?= $this->endSection() ?>
