<?= $this->extend('Views/templates/default-template/base') ?>
<?= $this->section('metatags') ?>
<? /*= $seo */ ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Blog</h1>
        </div>
    </div>
</header>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="px-5">
                    <div class="row gx-5">
                        <?php foreach ($blogs as $blog): ?>
                            <div class="col-lg-6 mb-5">
                                <div class="card h-100 shadow border-0">
                                    <img class="card-img-top"
                                         src="<?= (!empty($blog->seo->coverImage)) ? $blog->seo->coverImage : 'https://dummyimage.com/600x350/ced4da/6c757d' ?>"
                                         alt="..."/>
                                    <div class="card-body p-4">
                                        <?php foreach ($blog->tags as $tag): ?>
                                            <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?= $tag->_id->value ?></div>
                                        <?php endforeach; ?>
                                        <a class="text-decoration-none link-dark stretched-link"
                                           href="<?= site_url('blog/' . $blog->seflink) ?>">
                                            <div class="h5 card-title mb-3"><?= $blog->title ?></div>
                                        </a>
                                        <p class="card-text mb-0"><?= $blog->seo->description ?></p>
                                    </div>
                                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                        <div class="d-flex align-items-end justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img class="rounded-circle me-3"
                                                     src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..."/>
                                                <div class="small">
                                                    <div class="fw-bold"><?= $blog->author->firstname . ' ' . $blog->author->sirname ?></div>
                                                    <div class="text-muted"><?= $dateI18n->createFromTimestamp(strtotime($blog->created_at), app_timezone(), 'tr_TR')->toFormattedDateString(); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-end mb-5 mb-xl-0">
                        <?php if ($paginator->getNumPages() > 1): ?>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <?php if ($paginator->getPrevUrl()): ?>
                                        <li class="page-item"><a class="page-link"
                                                                 href="<?php echo $paginator->getPrevUrl(); ?>">&laquo;</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php foreach ($paginator->getPages() as $page): ?>
                                        <?php if ($page['url']): ?>
                                            <li class="page-item <?php echo $page['isCurrent'] ? 'active' : ''; ?>">
                                                <a class="page-link"
                                                   href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
                                            </li>
                                        <?php else: ?>
                                            <li class="disabled page-item"><span><?php echo $page['num']; ?></span></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php if ($paginator->getNextUrl()): ?>
                                        <li class="page-item"><a class="page-link"
                                                                 href="<?php echo $paginator->getNextUrl(); ?>">&raquo;</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Enter search term..."
                                   aria-label="Enter search term..." aria-describedby="button-search"/>
                            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                        </div>
                    </div>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <?php $c = 0;
                            foreach ($categories as $category):
                                if ($c == 0):?>
                                    <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                <?php endif; ?>
                                <li>
                                    <a href="<?= site_url('category/' . $category->seflink) ?>"><?= $category->title ?></a>
                                </li>
                                <?php if ($c == 0): ?>
                                </ul>
                                </div>
                            <?php endif; $c++;
                            if($c==3) $c=0;
                            endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- Side widget-->
                <div class="card mb-4">
                    <div class="card-header">Side Widget</div>
                    <div class="card-body">You can put anything you want inside of these side widgets. They are easy to
                        use, and feature the Bootstrap 5 card component!
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
