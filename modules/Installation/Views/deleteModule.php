<?= $this->extend('Modules\Installation\Views\base') ?>
<?= $this->section('title') ?>
Installation Module Delete
<?= $this->endSection() ?>
<?= $this->section('head') ?>
<style>
    .login-page {
        margin-left: unset !important;
    }

    .login-box {
        margin-right: unset !important;
        width: auto !important;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="login-box container-fluid">
    <!-- Main content -->
    <div class="card card-outline card-success">
        <div class="card-header text-center">
            <img src="<?= base_url('be-assets/img/logo.jpg') ?>" alt="" class="img-fluid img-h-7">
        </div>
        <div class="card-body">
            <h1>You must delete Installation Module. Please delete manually.</h1>
        </div>
        <div class="card-footer text-center">
            <strong>Copyright &copy; <?= date('Y') ?>.</strong> All rights reserved.
        </div>
    </div>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>
