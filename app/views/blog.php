<?php include_once 'header.php'; ?>

<div class="container" id="stuff">
    <div id="pussy">
        <? foreach ($blog as $one){ ?>
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="float: left"><?=$one->title?></h3>
                <p style="text-align: right; margin: 0"><?=$one->data?></p>
            </div>
            <div class="panel-body">
                <?=$one->post?>
            </div>
            </div>
        <? } ?>
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

<?php include_once 'footer.php'; ?>