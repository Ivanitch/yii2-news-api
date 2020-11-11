$(document).ready(function(){
   var breadcrumb = $('.breadcrumb'),
       active = breadcrumb.find('li.active');

   if (active.text() === 'О проекте'){
        $('#page-about').addClass('active');
   }
});// END READY