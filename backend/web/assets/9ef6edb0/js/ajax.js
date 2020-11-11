$(document).ready(function(){
    var block = $("#ajax-sample");
    var blockRefreshIcon = block.find('.quote_refresh_block');
    block.hover(function(){
        blockRefreshIcon.css({"opacity":"1", "transition":".3s"});
    }, function(){
        blockRefreshIcon.css({"opacity":"0", "transition":".3s"});
    });
    block.on('click', function () {
        $.ajax({
            url: '/url',
            type: 'GET',
            processData: false,
            contentType: false,
            cache:false,
            dataType: 'json',
            success: function(data){
                data = JSON.parse(data);
                var blockContent = $('#block_content');
                var blockAuthor = $('#block_author');
                blockContent.html(data.content);
                blockAuthor.html(data.author);
            },
            error: function(){
                console.log('Error!');
            }
        });
    });


});// END READY