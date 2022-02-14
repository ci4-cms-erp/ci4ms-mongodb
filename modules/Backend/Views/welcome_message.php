<?= $this->extend('Modules\Backend\Views\base') ?>
<?= $this->section('title') ?>
<?= lang('Backend.'.$title->pagename) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= lang('Backend.'.$title->pagename) ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"></ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

</section>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<?= $this->endSection() ?>
