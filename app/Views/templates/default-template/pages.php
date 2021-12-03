<?= $this->extend('Views/templates/default-template/base') ?>
<?=$this->section('metatags')?>
<?=$seo?>
<?=$this->endSection()?>
<?= $this->section('content') ?>
<?=$pageInfo->content?>
<?= $this->endSection() ?>
