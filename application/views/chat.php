<style>

    .threads{
        max-height: 300px;
        overflow: scroll;
    }

    /* Chat containers */
    .chat-container {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
    }

    /* Darker chat chat-container */
    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    /* Clear floats */
    .chat-container::after {
        content: "";
        clear: both;
        display: table;
    }

    /* Style images */
    .chat-container img{
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
    }

    /* Style the right image */
    .chat-container img.right {
        float: right;
        margin-left: 20px;
        margin-right:0;
    }

    /* Style time text */
    .time-right {
        float: right;
        color: #aaa;
    }

    /* Style time text */
    .time-left {
        float: left;
        color: #999;
    }

    /******** Sender Form *********/
    textarea {
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
        margin-bottom: 10px;
        border: 1px solid #ccc;
        padding: 3%;
        color: #555;
        font: 18px Arial, Helvetica, sans-serif;
    }
    textarea:focus {
        box-shadow: 0 0 5px #232b55;
        padding: 3%;
        border: 1px solid #232b55;
    }

    input[type="button"]{
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        text-align: center!important;
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
        background: #8e44ad;
        border-bottom: 2px solid #8e44ad;
        border-top-style: none;
        border-right-style: none;
        border-left-style: none;
        color: #fff;
    }
    input[type="button"]:hover {
        background: #8e44ad;
    }
</style>

<div class="row">
    <div class="col-xs-12 threads" id="threads">


    </div>
    <div class="col-xs-12 sender">
        <div class="row">
            <textarea class="col-xs-offset-1 col-xs-9" id="message" placeholder="Your Message Here!!"></textarea>
        </div>
        <div class="row">
            <input class="col-xs-offset-1 col-xs-2" onclick="sendMessage();" type="button" value="Send">
        </div>
    </div>
</div>


<script>

    function scroller(element){
        $(element).scrollTop($(element)[0].scrollHeight);
    }

    function sendMessage(){
        let msg = $("#message").val();
        let sender_id = <?= $user->id ?>;
        let thread_id = <?= $thread_id ?>;
        $("#message").val("");
        $.ajax({
                type:"post",
                url: "<?= base_url() ?>dashboard/send_message",
                data:{ thread:thread_id , sender:sender_id, message:msg },
                success:function(response) {
                },
                error: function() {
                }
        });
    }

    let last = 0;

    function getMessages(element){
        let thread = <?= $thread_id ?>;
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>dashboard/get_messages",
            data: {thread:thread, last:last},
            success:function(response){
                let arr = jQuery.parseJSON(response);
                for (let i =0; i < arr.length; i++){
                    let message = arr[i];
                    last = Math.max(last,message.msg_id);
                    let data = '';
                    console.log(message.by_user);
                    if (message.by_user == 1){
                        data = getContentUser(message);
                    }else{
                        data = getContentAdmin(message);
                    }


                    $(data).hide().appendTo(element).fadeIn(1000);
                }

                scroller(element);
            }
        });

        setTimeout(getMessages.bind(null,element),2500);
    }

    function getContentUser(message){
        let line1 = '<div class="chat-container darker" id="'+ message.msg_id +'">';
        let line2 = ' <img src="<?= base_url() ?>assets/res/user.png" alt="Avatar" class="img-circle img-responsive right">';
        let line3 = '<p>' + message.message + '</p>';
        let line4 = '<span class="time-left">' + message.date + '</span></div>';
        return line1 + line2 + line3 + line4;
    }

    function getContentAdmin(message){
        let line1 = '<div class="chat-container" id="'+ message.msg_id +'">';
        let line2 = ' <img src="<?= base_url() ?>assets/res/admin.png" alt="Avatar" class="img-circle img-responsive">';
        let line3 = '<p>' + message.message + '</p>';
        let line4 = '<span class="time-right">' + message.date + '</span></div>';
        return line1 + line2 + line3 + line4;
    }

    $(document).ready(function(){
        scroller('#threads');
        getMessages('#threads');

    });

</script>