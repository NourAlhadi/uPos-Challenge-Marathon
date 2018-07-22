<div class="row">

    <div class="table-responsive">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Elements Needed</th>
                    <th>Overall Price</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?php echo $row['pid']; ?></td>
                        <td><?php echo $row['pname']; ?></td>
                        <td><?php echo $row['pprice']; ?>$</td>
                        <td><?php echo $row['pcount']; ?></td>
                        <td><?php echo $row['poprice']; ?>$</td>
                        <td>
                            <form method="post" action="<?php echo base_url(); ?>dashboard/remove_from_cart" enctype="multipart/form-data">
                                Remove
                                <input type="number" name="cnt" max="<?php echo $row['pcount'];?>" placeholder="How many?">
                                Elements
                                <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
                                <input class="btn btn-sm btn-primary" value="GO" type="submit" name="submit">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </div>

    <div class="col-xs-offset-2 col-xs-8 alert alert-info">The total price for your shopping list is: <?php echo $overall_price; ?>$</div>

</div>