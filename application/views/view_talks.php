<?php foreach ($users as $talk): ?>

    <div class="row">
        <div class="col-sm-12 well well-lg bg-primary">
            <div class="row">
                <div class="col-sm-10 content-holder">
                    <h3>A talk with: <?= $talk->fullname ?></h3>
                    <hr>
                    <a class="btn btn-primary " href="<?= base_url() ?>dashboard/talk/<?= $talk->id ?>">Go Now</a>
                </div>
                <div class="col-sm-2 image-holder">
                    <img class="img-circle img-responsive" src="<?php echo base_url(); ?>assets/res/user.png">
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>