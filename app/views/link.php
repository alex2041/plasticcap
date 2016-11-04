<?php include_once 'header.php'; ?>

    <div class="container">
        <table class="table table-hover table-bordered table-responsive">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Country</th>
                <th>Website</th>
                <th>Contact</th>
            </tr>
            </thead>
            <tbody>
                <? foreach ($link as $one){ ?>
                    <tr>
                        <th scope="row"><?=$one->id?></th>
                        <td><?=$one->name?></td>
                        <td><?=$one->country?></td>
                        <td><a href="<?=$one->link?>"><?=$one->link?></a></td>
                        <td><?=$one->contact?></td>
                    </tr>
                <? } ?>
            </tbody>
        </table>

    </div>

<?php include_once 'footer.php'; ?>
