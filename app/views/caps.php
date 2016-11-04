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
    <table class="table table-responsive text-center table-bordered main-table maintable">
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