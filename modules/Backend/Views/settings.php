<?= $this->extend('Modules\Backend\Views\base') ?>

<?= $this->section('title') ?>
Anasayfa
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/be-assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ayarlar</h1>
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
            <h3 class="card-title font-weight-bold">Site Ayarlarını güncelle</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <?= view('Modules\Auth\Views\_message_block') ?>
            <div class="row">
                <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                         aria-orientation="vertical">
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home"
                           role="tab" aria-controls="vert-tabs-home" aria-selected="true">Şirket Bilgileri</a>
                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile"
                           role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Sosyal Medya</a>
                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages"
                           role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Mail Ayarları</a>
                    </div>
                </div>
                <div class="col-7 col-sm-9">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade active show" id="vert-tabs-home" role="tabpanel"
                             aria-labelledby="vert-tabs-home-tab">
                            <form action="<?=route_to('compInfosPost')?>" method="post" class="form-row" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="col-6 form-group">
                                    <label for="">Şirket Adı</label>
                                    <input type="text" name="cName" class="form-control" value="<?=(!empty($settings->siteName))?$settings->siteName:''?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">Site Linki</label>
                                    <input type="text" name="cUrl" class="form-control" value="<?=(!empty($settings->siteURL))?$settings->siteURL:''?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">Slogan</label>
                                    <input type="text" name="cSlogan" class="form-control" value="<?=(!empty($settings->slogan))?$settings->slogan:''?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">Şirket Adresi</label>
                                    <input type="text" name="cAddress" class="form-control" value="<?=(!empty($settings->companyAddress))?$settings->companyAddress:''?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">Şirket Telefonu</label>
                                    <input type="text" name="cPhone" class="form-control" value="<?=(!empty($settings->companyPhone))?$settings->companyPhone:''?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">Şirket GSM</label>
                                    <input type="text" name="cGSM" class="form-control" value="<?=(!empty($settings->companyGSM))?$settings->companyGSM:''?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">Şirket Maili</label>
                                    <input type="text" name="cMail" class="form-control" value="<?=(!empty($settings->companyEMail))?$settings->companyEMail:''?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">Google Map iframe linki</label>
                                    <input type="text" name="cMap" class="form-control" value="<?=(!empty($settings->map_iframe))?$settings->map_iframe:''?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">Şirket Logosu</label>
                                    <input type="file" name="cLogo" class="form-control">
                                </div>
                                <div class="col-6 form-group">
                                    <img src="<?=(!empty($settings->logo))?base_url('/imageRender/'.$settings->logo):''?>" class="img-fluid" alt="">
                                </div>
                                <div class="col-12 form-group">
                                    <button class="btn btn-success float-right mt-5">Güncelle</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                             aria-labelledby="vert-tabs-profile-tab">
                            <form action="<?=route_to('socialMediaPost')?>" class="repeater" method="post">
                                <?= csrf_field() ?>
                                <div data-repeater-list="socialNetwork" class="col-12">
                                    <?php if(!empty($settings->socialNetwork)):
                                    foreach ($settings->socialNetwork as $socialNetwork) : ?>
                                    <div class="row border-bottom" data-repeater-item>
                                        <div class="col-6 form-group">
                                            <label for="">Sosyal Medya Adı</label>
                                            <input type="text" class="form-control" name="smName" value="<?=$socialNetwork->smName?>" placeholder="facebook" required>
                                        </div>
                                        <div class="col-5 form-group">
                                            <label for="">Sosyal Medya Linki</label>
                                            <input type="text" class="form-control" name="link" value="<?=$socialNetwork->link?>" required>
                                        </div>
                                        <div class="col-1 form-group">
                                            <input data-repeater-delete type="button"
                                                   class="btn btn-danger w-100" value="Sil"/>
                                        </div>
                                    </div>
                                    <?php endforeach;
                                    endif; ?>
                                    <div class="row border-bottom" data-repeater-item>
                                        <div class="col-6 form-group">
                                            <label for="">Sosyal Medya Adı</label>
                                            <input type="text" class="form-control" name="smName" placeholder="facebook" required>
                                        </div>
                                        <div class="col-5 form-group">
                                            <label for="">Sosyal Medya Linki</label>
                                            <input type="text" class="form-control" name="link" required>
                                        </div>
                                        <div class="col-1 form-group">
                                            <input data-repeater-delete type="button"
                                                   class="btn btn-danger w-100 mt-md-4" value="Sil"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6 form-group">
                                        <input data-repeater-create type="button" class="btn btn-secondary"
                                               value="Sosyal Medya Listesine Ekle"/>
                                    </div>
                                    <div class="col-6 form-group">
                                        <button class="btn btn-success float-right">Güncelle</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                             aria-labelledby="vert-tabs-messages-tab">
                            <form action="<?=route_to('mailSettingsPost')?>" method="post" class="form-row">
                                <?= csrf_field() ?>
                                <div class="col-6 form-group">
                                    <label for="">Mail Server</label>
                                    <input type="text" name="mServer" class="form-control" value="<?=empty($settings->mailServer)?'':$settings->mailServer?>" required>
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">Mail Port</label>
                                    <input type="text" name="mPort" class="form-control" value="<?=empty($settings->mailPort)?'':$settings->mailPort?>" required>
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">Mail Adresi</label>
                                    <input type="text" name="mAddress" class="form-control" value="<?=empty($settings->mailAddress)?'':$settings->mailAddress?>" required>
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">Mail Şifresi</label>
                                    <input type="text" name="mPwd" class="form-control" value="<?=empty($settings->mailPassword)?'':$settings->mailPassword?>" required>
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">Mail Protokolü</label>
                                    <select name="mProtocol" id="" class="form-control" required>
                                        <option value="smtp" <?=(isset($settings->mailProtocol) && $settings->mailProtocol==='smtp')?'selected':''?>>SMTP</option>
                                        <option value="pop3" <?=(isset($settings->mailProtocol) && $settings->mailProtocol==='pop3')?'selected':''?>>POP3</option>
                                    </select>
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">TLS aktif mi ? </label>
                                    <input type="checkbox" name="mTls" id="" <?=(!empty($settings->mailTLS) && $settings->mailTLS===true) ?'checked':''?>>
                                </div>
                                <div class="col-12 form-group">
                                    <button class="btn btn-success float-right">Güncelle</button>
                                </div>
                            </form>
                        </div>
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
<script src="/be-assets/node_modules/jquery.repeater/jquery.repeater.js"></script>
<script>
    $(document).ready(function () {
        'use strict';

        $('.repeater').repeater({
            defaultValues: {},
            isFirstItemUndeletable: true,
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                Swal.fire({
                    title: 'Bu sosyal ağı listeden silmek istediğinizden emin misiniz?',
                    showCancelButton: true,
                    confirmButtonText: `Sil`,
                    cancelButtonText: `Vazgeç`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $(this).slideUp(deleteElement);
                        Swal.fire('Silindi!', '', 'success');
                    }
                })
            }
        });
    });
</script>
<?= $this->endSection() ?>
