<div class="page-header page-header-with-buttons">
    <h1 class="pull-left"><span>Properties</span></h1>
</div>

<div class="box bordered-box" style="margin-bottom:0;">
    <div class="text-right" style="margin-bottom:12px;">
        <a href="/properties/new" class="btn btn-primary">New Property</a>
    </div>
    <div class="box-content box-no-padding">
        <div class="responsive-table">
            <div class="scrollable-area">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $item): ?>
                        <tr>
                            <td><?php echo $item->title;?></td>
                            <td><?php echo ($item->is_archived == 0) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">archived</span>'; ?></td>
                            <td>
                                <div class="text-right">
                                    <a class="btn btn-mini btn-inverse" href="/properties/edit/<?php echo $item->id; ?>">Edit</a>
                                    <?php if($item->is_archived == 0): ?>
                                    <a onclick="return confirm('Are you sure? Your property will no longer be visible!');" class="btn btn-mini btn-danger" href="/properties/archive/<?php echo $item->id; ?>">Archive</a>
                                    <?php else: ?>
                                    <a class="btn btn-mini btn-info" href="/properties/archive/<?php echo $item->id; ?>">Activate</a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

