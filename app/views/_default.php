<?php include_once 'header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-4 sidebar">
                <div class="well">
                    <ul class="nav nav-pills" role="tablist">
                    <? foreach ($blocks as $block): ?>
                        <li role="presentation" class="active">
                            <a href="/block/get?id=<?= $block->id ?>">
                                <?= $block->name ?> <span class="badge"><?= $countB[$block->id] ?></span>
                            </a>
                        </li>
                    <? endforeach; ?>
                        <li role="presentation" class="active">
                            <a href="/block/get?id=all">
                                All <span class="badge"><?= array_sum($countB) ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="nav nav-pills nav-stacked" role="tablist" id="cattab">
                        <? foreach ($categories as $category): ?>
                            <li role="presentation" class="<?= ($params['c_id'] == $category->id) ? 'active' : '' ?>">
                            <a href="#category<?= $category->id?>" catid="<?= $category->id?>" bid="<?= $category->b_id ? $category->b_id : 'all' ?>" aria-controls="category<?= $category->id?>" role="tab" data-toggle="tab"
                                <?= ($params['c_id'] == $category->id) ? 'aria-expanded="true"' : '' ?>>
                                    <?= $category->name ?><span class="badge"><?= $category->count?></span>
                                </a>
                            </li>
                        <? endforeach; ?>

                    </ul>
                </div>
                <div class="col-sm-6">
                    <div class="tab-content">
                        <? foreach ($categories as $category): ?>
                            <div role="tabpanel" class="tab-pane <?= ($params['c_id'] == $category->id) ? 'active' : '' ?>" id="category<?= $category->id?>">
                                <ul class="nav nav-pills nav-stacked" role="tablist" id="dirtab">
                                <? foreach ($dirs as $dir): ?>
                                    <? if($dir->c_id == $category->id):?>
                                        <li role="presentation" class="<?= ($params['d_id'] == $dir->id) ? 'active' : '' ?>">
                                            <a href="#dir<?= $dir->id?>" dirid="<?= $dir->id?>" catid="<?= $dir->c_id?>" bid="<?= $category->b_id ? $category->b_id : 'all' ?>" aria-controls="dir<?= $dir->id?>" role="tab" data-toggle="tab">
                                                <?= $dir->name?><span class="badge"><?= $dir->count?></span>
                                            </a>
                                        </li>
                                    <? endif; ?>
                                <? endforeach; ?>
                                </ul>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-sm-offset-6 col-md-8 col-md-offset-4 main" id="stuff">
                <div id="pussy">
                    <? if($pg['count'] > $pg['limit']): ?>
                        <div class="row mb5">
                            <div class="my-navigation col-md-6 col-md-offset-3">
                                <div class="pg-first"></div>
                                <div class="pg-previous"></div>
                                <div class="pg-page-numbers"></div>
                                <div class="pg-next"></div>
                                <div class="pg-last"></div>
                            </div>
                        </div>
                    <? endif; ?>
                    <table class="table table-responsive text-center table-bordered maintable">
                        <tbody>
                        <tr>
                        <? foreach ($caps as $i => $cap): ?>
                            <td><span class="number"><?= $cap->id ?></span><img class="cap" src="/web/img/<?= $cap->b_id ?>/<?= $cap->c_id ?>/<?= $cap->id ?>.png"></td>
                            <?= (($i + 1) % 6 == 0 & ($i + 1) < count($caps)) ? '</tr><tr>' : ''?>
                        <? endforeach; ?>
                        </tbody>
                    </table>
                    <? if($pg['count'] > $pg['limit']): ?>
                        <div class="row mb5">
                            <div class="my-navigation col-md-6 col-md-offset-3">
                                <div class="pg-first"></div>
                                <div class="pg-previous"></div>
                                <div class="pg-page-numbers"></div>
                                <div class="pg-next"></div>
                                <div class="pg-last"></div>
                            </div>
                        </div>
                    <? endif; ?>
                </div>
                <script>
                    (function($){
                        $('#pussy').simplePagination({
                            page: <?= $pg['page'] ?>,
                            count: <?= $pg['count'] ?>,
                            items_per_page: <?= $pg['limit'] ?>
                        });
                    })(jQuery);
                </script>
            </div>
        </div>
    </div>
<?php include_once 'footer.php'; ?>