<?= $this->extend('Modules\Backend\Views\base') ?>
<<<<<<< HEAD

<?= $this->section('title') ?>
Profil
=======
<?= $this->section('title') ?>
<?=lang('Backend.'.$title->pagename)?>
>>>>>>> dev
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row pb-3 border-bottom">
            <div class="col-sm-6">
<<<<<<< HEAD
                <h1>Profil</h1>
=======
                <h1><?=lang('Backend.'.$title->pagename)?></h1>
>>>>>>> dev
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
    <div class="card card-outline card-shl">
        <div class="card-body">
            <?= view('Modules\Auth\Views\_message_block') ?>
            <form action="<?= route_to('profile') ?>" method="post" class="form-row">
                <?= csrf_field() ?>
<<<<<<< HEAD
                <div class="col-6 col-md-6">
                    <div class="form-group">
                        <label for="">Ad Soyadı <small class="text-danger">* (zorunlu alan)</small></label>
                        <div class="input-group">
                            <input type="text" aria-label="Ad" name="firstname" value="<?=$user->firstname?>" class="form-control" placeholder="Adı"
                                   required>
                            <input type="text" aria-label="Soyad" name="sirname" value="<?=$user->sirname?>" class="form-control"
                                   placeholder="Soyadı" required>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group">
                        <label for="">E-posta adresi <small class="text-danger">* (zorunlu alan)</small></label>
                        <input type="email" name="email" class="form-control" value="<?=$user->email?>" required>
                        <small class="text-info">E-posta adresinizi güncellerseniz aktivasyon maili gönderilecektir. E-posta adresinizi onaylayana kadar üyeliğiniz aktiflikten çıkacaktır.</small>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group">
                        <label for="">Şifre <small class="text-danger">(** lütfen şifreyi önce bir yere not alın yada kendiniz başka bir şifre yazın.)</small></label>
                        <input type="text" class="form-control" name="password" minlength="8">
                    </div>
                </div>
                <div class="col-12 col-md-12">
                <button class="btn btn-outline-success float-right">Güncelle</button>
=======
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><?=lang('Backend.fullName')?> <?=lang('Backend.required')?></label>
                        <div class="input-group">
                            <input type="text" aria-label="<?=lang('Backend.name')?>" name="firstname" value="<?=$user->firstname?>" class="form-control" placeholder="<?=lang('Backend.name')?>"
                                   required>
                            <input type="text" aria-label="<?=lang('Backend.sirname')?>" name="sirname" value="<?=$user->sirname?>" class="form-control"
                                   placeholder="<?=lang('Backend.sirname')?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><?=lang('Backend.email')?> <?=lang('Backend.required')?></label>
                        <input type="email" name="email" class="form-control" value="<?=$user->email?>" required>
                        <small class="text-info"><?=lang('Backend.profileUpdateEmail')?></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><?=lang('Backend.password')?> <?=lang('Backend.takeNotePassword')?></label>
                        <input type="text" class="form-control" name="password" minlength="8">
                    </div>
                </div>
                <div class="col-md-12">
                <button class="btn btn-outline-success float-right"><?=lang('Backend.update')?></button>
>>>>>>> dev
        </div>
        </form>
    </div>
    </div>
</section>

<!-- /.content -->
<?= $this->endSection() ?>
