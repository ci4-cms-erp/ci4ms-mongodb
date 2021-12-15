<?= $this->extend('Views/templates/default-template/base') ?>
<?= $this->section('metatags') ?>
<?= $seo ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-3">
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
                </div>
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
                    </article>
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
            </div>
        </div>
    </section>
<?= $this->endSection() ?>