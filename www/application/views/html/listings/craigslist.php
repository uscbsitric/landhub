
<div class="page-header page-header-with-buttons">
    <h1 class="pull-left"><span>Listings</span></h1>
</div>

<div class="box bordered-box" style="margin-bottom:0;">
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
                    <?php foreach($properties as $property): ?>
                        <tr>
                            <td><?php echo $property->title;?></td>
                            <td><?php echo ($property->is_archived == 0) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">archived</span>'; ?></td>
                            <td>
                                <div class="text-right">
                                    <?php echo ($property->is_archived == 0) ? '<a class="btn btn-primary" href="/listings/new/'.$property->id.'">New Listing</a>' : '<a class="btn btn-primary disabled" href="/listings/new/'.$property->id.'">New Listing</a>'; ?>
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
