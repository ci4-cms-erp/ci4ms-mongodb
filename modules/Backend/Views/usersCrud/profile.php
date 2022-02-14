<?= $this->extend('Modules\Backend\Views\base') ?>

<?= $this->section('title') ?>
Profil
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row pb-3 border-bottom">
            <div class="col-sm-6">
                <h1>Profil</h1>
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
        </div>
        </form>
    </div>
    </div>
</section>

<!-- /.content -->
<?= $this->endSection() ?>
