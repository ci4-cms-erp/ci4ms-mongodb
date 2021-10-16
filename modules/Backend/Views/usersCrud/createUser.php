<?= $this->extend('Modules\Backend\Views\base') ?>

<?= $this->section('title') ?>
Ofis Çalışanı Ekleme
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row pb-3 border-bottom">
            <div class="col-sm-6">
                <h1>Ofis Çalışanı Ekleme</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="<?= route_to('officeWorker',1) ?>" class="btn btn-outline-info"><i
                                class="fas fa-arrow-circle-left"></i> Listeye Dön</a>
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
            <form action="<?= route_to('createUserPost') ?>" method="post" class="form-row">
                <?= csrf_field() ?>
                <div class="col-6 col-md-6">
                    <div class="form-group">
                        <label for="">Ad Soyadı <small class="text-danger">* (zorunlu alan)</small></label>
                        <div class="input-group">
                            <input type="text" aria-label="Ad" name="firstname" class="form-control" placeholder="Adı"
                                   required>
                            <input type="text" aria-label="Soyad" name="sirname" class="form-control"
                                   placeholder="Soyadı" required>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group">
                        <label for="">E-posta adresi <small class="text-danger">* (zorunlu alan)</small></label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group">
                        <label for="">Yetkisi <small class="text-danger">* (zorunlu alan)</small></label>
                        <select name="group" class="form-control" required>
                            <option value="">Seçiniz...</option>
                            <?php foreach ($groups as $group):
                                if ($group->name != 'super user'): ?>
                                    <option value="<?= $group->_id ?>"><?= $group->name ?></option>
                                <?php endif;
                            endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group">
                        <label for="">Şifre <small class="text-danger">(** lütfen şifreyi önce bir yere not alın yada
                                kendiniz başka bir şifre yazın.)</small></label>
                        <input type="text" class="form-control" name="password" minlength="8"
                               value="<?= $authLib->randomPassword() ?>" required>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                <button class="btn btn-outline-success float-right"><i class="fas fa-user-plus"></i> Kullanıcıyı Ekle
                </button>
        </div>
        </form>
    </div>
    </div>
</section>

<!-- /.content -->
<?= $this->endSection() ?>
