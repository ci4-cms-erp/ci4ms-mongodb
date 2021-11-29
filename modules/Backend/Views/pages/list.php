<?= $this->extend('Modules\Backend\Views\base') ?>
<?= $this->section('title') ?>
<?=lang('Backend.'.$title->pagename)?>
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
                <h1><?=lang('Backend.'.$title->pagename)?></h1>
            </div>
            <div class="col-sm-6">
                <a href="<?= route_to('pageCreate') ?>" class="btn btn-success float-right"><?=lang('Backend.pageAdd')?></a>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card card-outline card-shl">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Sayfalar Listesi</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <?= view('Modules\Auth\Views\_message_block') ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Sayfa Adı</th>
                        <th>Durumu</th>
                        <th>#İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pages as $page): ?>
                    <tr>
                        <td><?=$page->title?></td>
                        <td><?=$page->isActive?></td>
                        <td>
                            <a href="<?= route_to('pageUpdate', $page->_id) ?>"
                               class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i> Düzenle</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if ($paginator->getNumPages() > 1): ?>
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    <?php if ($paginator->getPrevUrl()): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo $paginator->getPrevUrl(); ?>">&laquo;</a></li>
                    <?php endif; ?>

                    <?php foreach ($paginator->getPages() as $page): ?>
                        <?php if ($page['url']): ?>
                            <li class="page-item <?php echo $page['isCurrent'] ? 'active' : ''; ?>">
                                <a class="page-link" href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
                            </li>
                        <?php else: ?>
                            <li class="disabled page-item"><span><?php echo $page['num']; ?></span></li>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php if ($paginator->getNextUrl()): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo $paginator->getNextUrl(); ?>">&raquo;</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script src="/be-assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<?= $this->endSection() ?>
