<style>
    .header1{
        text-align: center!important;
        font-weight: bold!important;
        color:#333;
    }
    .item{
        background-color: #e1e1e1;
        margin-top: 20px;
        margin-bottom: 20px;
        box-shadow: 5px 5px 4px 5px #888888;
        min-height: 400px!important;
    }


    p, .item a button{
        font-size: 20px;
        font-weight: bold;
        padding-top: 20px;
    }
    .item a button{
        padding-top: 0;
        margin-top: 20px;
        float: right;
        color:#333;
        font-weight: normal;
    }


    form{
        direction: ltr;
        padding: 25px;
    }

    /* Basic styles */
    .wrapper input[type="checkbox"], .wrapper input[type='radio']{
        position: absolute;
        opacity: 0;
        z-index: -1;
    }
    .wrapper label {
        position: relative;
        display: inline-block;
        padding: 0 0 0 2em;
        height: 1.5em;
        line-height: 1.5;
        cursor: pointer;
    }
    .wrapper label::before,
    .wrapper label::after {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 1.5em;
        height: 1.5em;
    }
    .wrapper label::before {
        content: " ";
        border: 2px solid #bdc3c7;
        border-radius: 20%;
    }
    [type="radio"]{
        display: none;
    }
    /* Checkbox */
    .wrapper input[type="radio"] + label::after {
        content: "\2714";
        color: #2c3e50;
        line-height: 1.5;
        text-align: center;
    }
    /* :checked */
    .wrapper input[type="radio"]:checked + label::before,
    input[type="radio"]:checked + label::before {
        background: #fff;
        border-color: #fff;
    }
    .wrapper input[type="radio"] + label::after{
        -webkit-transform: scale(0);
        -ms-transform: scale(0);
        -o-transform: scale(0);
        transform: scale(0);
    }
    .wrapper input[type="radio"]:checked + label::after{
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        -o-transform: scale(1);
        transform: scale(1);
    }
    /* Checkbox */
    .wrapper input[type="checkbox"] + label::after {
        content: "\2714";
        color: #2c3e50;
        line-height: 1.5;
        text-align: center;
    }
    /* :checked */
    .wrapper input[type="checkbox"]:checked + label::before,
    input[type="checkbox"]:checked + label::before {
        background: #fff;
        border-color: #fff;
    }
    .wrapper input[type="checkbox"] + label::after{
        -webkit-transform: scale(0);
        -ms-transform: scale(0);
        -o-transform: scale(0);
        transform: scale(0);
    }
    .wrapper input[type="checkbox"]:checked + label::after{
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        -o-transform: scale(1);
        transform: scale(1);
    }
    /* Transition */
    .wrapper label::before,
    .wrapper label::after {
        -webkit-transition: .25s all ease;
        -o-transition: .25s all ease;
        transition: .25s all ease;
    }


    .item{
        font: 95% Arial, Helvetica, sans-serif;
        padding: 16px;
    }
    .item h1{
        background: #8e44ad;
        padding: 20px 0;
        font-size: 140%;
        font-weight: 300;
        text-align: center;
        color: #fff;
        margin: -16px -16px 16px -16px;
        direction: rtl;
    }
    input[type="text"],
    input[type="number"],
    input[type="file"],
    textarea,
    select
    {
        -webkit-transition: all 0.30s ease-in-out;
        -moz-transition: all 0.30s ease-in-out;
        -ms-transition: all 0.30s ease-in-out;
        -o-transition: all 0.30s ease-in-out;
        outline: none;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        width: 100%;
        background: #fff;
        margin-bottom: 4%;
        border: 1px solid #ccc;
        padding: 3%;
        color: #555;
        font: 95% Arial, Helvetica, sans-serif;
    }
    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="file"]:focus,
    textarea:focus,
    select:focus
    {
        box-shadow: 0 0 5px #232b55;
        padding: 3%;
        border: 1px solid #232b55;
    }

    input[type="submit"],
    input[type="button"]{
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        width: 100%;
        text-align: center!important;
        font-size: 16px;
        font-weight: bold;
        padding: 3%;
        background: #8e44ad;
        border-bottom: 2px solid #8e44ad;
        border-top-style: none;
        border-right-style: none;
        border-left-style: none;
        color: #fff;
    }
    input[type="submit"]:hover,
    input[type="button"]:hover {
        background: #8e44ad;
    }
</style>

<div class="row">
    <?php if(isset($_SESSION['error'])): ?>
        <div class="col-sm-offset-3 col-xs-offset-2 col-sm-6 col-xs-8 alert alert-danger">
            <?php echo$_SESSION['error']; ?>
        </div>
    <?php endif; ?>
    <div class="col-sm-12">

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3 col-xs-2"></div>

                    <div class="col-sm-6 col-xs-8 item">
                        <h1 class="header1"> Add new products so that you can satisfy your users!! </h1>
                        <form method="post" action="<?php echo base_url(); ?>dashboard/confirm_add" enctype="multipart/form-data">
                            <input type="text" name="name" placeholder="Product name" required>
                            <textarea name="about" placeholder="About this product" required></textarea>
                            <input name="price" type="number" placeholder="Product price" required>

                            <input type="file" name="image" required>

                            <input type="submit" name="submit" value="Add now!!">
                        </form>
                    </div>

                    <div class="col-sm-3 col-xs-2"></div>
                </div>
            </div>
        </div>



    </div>
</div>
