<div class="row">
    <div class="col-sm-12">
        <h4 class="alert alert-info"> This is a minimized version: each and every element (Views, Models, etc..) Are Minimized to simply just achieve the goal of the challenge no less no more, it could be much more bigger and better if needed!! </h4>
    </div>
</div>

<?php foreach ($products as $item): ?>

    <div class="row">
        <div class="col-sm-12 well well-lg bg-primary">
            <?php if($user->role > 0): ?>
                <div class="row">
                    <div class="pull-right">
                        <a href="<?php echo base_url(); ?>dashboard/edit_product/<?php echo $item->id; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> </a>
                        <a href="<?php echo base_url(); ?>dashboard/remove_product/<?php echo $item->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-sm-10 content-holder">
                    <h3><?php echo $item->name; ?></h3>
                    <h4>Total Price: <?php echo $item->price; ?>$</h4>
                    <hr>
                    <p><?php echo $item->about; ?></p>
                </div>
                <div class="col-sm-2 image-holder">
                    <img style="width: 200px!important; height: 200px!important;" class="img-circle img-responsive" src="<?php echo base_url(); ?>uploads/products/<?php echo $item->image; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <span class="col-xs-2">
                            <a class="btn btn-primary" href="<?php echo base_url();?>dashboard/add_to_cart/<?php echo $item->id; ?>">Add to cart</a>
                        </span>
                        <span class="col-xs-5 alert alert-info">Each addition is considered as a re-buy operation!!</span>
                        <span class="col-xs-5"></span>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php endforeach; ?>
