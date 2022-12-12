<?= $this->extend('Views/templates/default/base') ?>
<?= $this->section('metatags') ?>
<?= $seo ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="<?=(!empty($settings->templateInfos->widgets->sidebar))?'col-md-9':'col-md-12'?>">
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
                                <form class="mb-4 row">
                                    <div class="col-md-6 form-group mb-3">
                                        <input type="text" class="form-control" name="comFullName" placeholder="Full name">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <input type="email" class="form-control" name="comEmail" placeholder="E-mail">
                                    </div>
                                    <div class="col-12 form-group mb-3">
                                        <textarea class="form-control" rows="3"
                                                             placeholder="Join the discussion and leave a comment!"></textarea>
                                    </div>
                                    <div class="col-12 form-group text-end">
                                        <button class="btn btn-primary btn-sm">Send</button>
                                    </div>
                                </form>
                                <hr>
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
                                        <div class="text-start">
                                            <!-- TODO : id name will change for comments-->
                                            <button class="btn btn-sm btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Reply</button>
                                            <div class="collapse" id="collapseExample">
                                                <div class="card card-body">
                                                    <form class="mb-1 row">
                                                        <div class="col-md-6 form-group mb-3">
                                                            <input type="text" class="form-control" name="comFullName" placeholder="Full name">
                                                        </div>
                                                        <div class="col-md-6 form-group mb-3">
                                                            <input type="email" class="form-control" name="comEmail" placeholder="E-mail">
                                                        </div>
                                                        <div class="col-12 form-group mb-3">
                                        <textarea class="form-control" rows="3"
                                                  placeholder="Join the discussion and leave a comment!"></textarea>
                                                        </div>
                                                        <div class="col-12 form-group text-end">
                                                            <button class="btn btn-primary btn-sm">Send</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Child comment 1-->
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0"><img class="rounded-circle"
                                                                            src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                                                                            alt="..."/></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                And under those conditions, you cannot establish a capital-market
                                                evaluation of that enterprise. You can't get investors.
                                                <div class="text-start"><button class="btn btn-sm btn-secondary">Reply</button></div>
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
                                                <div class="text-start"><button class="btn btn-sm btn-secondary">Reply</button></div>
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
                                        <div class="text-start"><button class="btn btn-sm btn-secondary">Reply</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php if(!empty($settings->templateInfos->widgets->sidebar)):
                    echo view('templates/default/widgets/sidebar');
                endif; ?>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
</script>
<?=$this->endSection() ?>
