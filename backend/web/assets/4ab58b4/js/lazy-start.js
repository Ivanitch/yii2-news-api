$(document).ready(function(){
    /**==========================
     LazyLoad + PJAX
     ============================**/
    new LazyLoad({
        elements_selector: ".lazy"
    });

    $('#linkPagerCategory')
        .on('pjax:start', function() {
            return false;
        })
        .on('pjax:end', function() {
             new LazyLoad({
                elements_selector: ".lazy"
        });
    });
});
