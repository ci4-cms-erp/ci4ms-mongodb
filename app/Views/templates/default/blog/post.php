<?= $this->extend('Views/templates/default/base') ?>
<?= $this->section('metatags') ?>
<?= $seo ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-9">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?= $infos->title ?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2"><?= $dateI18n->createFromTimestamp(strtotime($infos->created_at),app_timezone(),'tr_TR')->toFormattedDateString(); ?></div>
                            <!-- Post categories-->
                            <?php foreach ($tags as $tag): ?>
                                <a class="badge bg-secondary text-decoration-none link-light"
                                   href="<?= route_to('tag', $tag->_id->seflink) ?>"><?= $tag->_id->value ?></a>
                            <?php endforeach; ?>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4">
                            <img class="img-fluid rounded" src="<?= $infos->seo->coverImage ?>"
                                 alt="<?= $infos->title ?>"/>
                        </figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <?= $infos->content ?>
                        </section>
                        <hr>
                        <div class="d-flex align-items-center mt-lg-5 mb-4">
                            <?php if (empty($authorInfo->profileIMG)): ?>
                                <img class="img-fluid rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                                     alt="<?= $authorInfo->firstname . ' ' . $authorInfo->sirname ?>"/>
                            <?php else: ?>
                                <img class="img-fluid rounded-circle" src="<?= $authorInfo->profileIMG ?>"
                                     alt="<?= $authorInfo->firstname . ' ' . $authorInfo->sirname ?>"/>
                            <?php endif; ?>
                            <div class="ms-3">
                                <div class="fw-bold"><?= $authorInfo->firstname . ' ' . $authorInfo->sirname ?></div>
                                <div class="text-muted"><?= $authorInfo->groupInfo[0]->name ?></div>
                            </div>
                        </div>
                    </article>
                    <hr>
                    <!-- Comments section
                    TODO: kodlanacak.
                    -->
                    <section>
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Comment form-->
                                <form class="mb-4"><textarea class="form-control" rows="3"
                                                             placeholder="Join the discussion and leave a comment!"></textarea>
                                </form>
                                <!-- Comment with nested comments-->
                                <div class="d-flex mb-4">
                                    <!-- Parent comment-->
                                    <div class="flex-shrink-0"><img class="rounded-circle"
                                                                    src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                                                                    alt="..."/></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        If you're going to lead a space frontier, it has to be government; it'll never
                                        be private enterprise. Because the space frontier is dangerous, and it's
                                        expensive, and it has unquantified risks.
                                        <!-- Child comment 1-->
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0"><img class="rounded-circle"
                                                                            src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                                                                            alt="..."/></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                And under those conditions, you cannot establish a capital-market
                                                evaluation of that enterprise. You can't get investors.
                                            </div>
                                        </div>
                                        <!-- Child comment 2-->
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0"><img class="rounded-circle"
                                                                            src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                                                                            alt="..."/></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                When you put money directly to a problem, it makes a good headline.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single comment-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="rounded-circle"
                                                                    src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                                                                    alt="..."/></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        When I look at the universe and all the ways the universe wants to kill us, I
                                        find it hard to reconcile that with statements of beneficence.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3">
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