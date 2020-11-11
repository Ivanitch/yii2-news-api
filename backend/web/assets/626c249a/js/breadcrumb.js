$(document).ready(function(){

    var elem = $('.breadcrumb').find('li:eq(1)').text();
    switch (elem) {
        case 'О проекте':
            $('li#page_about').addClass('active');
            break;
        case 'Справочник jQuery':
            $('li#page_api').addClass('active');
            break;
        default:
            return false;
    }

});// END READY