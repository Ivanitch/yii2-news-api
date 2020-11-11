$(function() {
    /**
    * DELETE ARCHIVE file
    */
    $('a#delete-archive-ajax').on('click', function(e){
    e.preventDefault();

    var $this = $(this),
      file = $this.data('file'),
      id = $this.data('id');

    function deleteArchiveSuccess() {
      $.gritter.add({
        title: 'Архив удалён!',
        text: 'Удаление архива прошло успешно!',
        class_name: 'gritter-success'
      });
    }

    function deleteArchiveError() {
      $.gritter.add({
        title: 'Ошибка удаления!',
        text: 'Произошла ошибка удаления! Обратитесь к разработчику сайта.',
        class_name: 'gritter-remove'
      });
    }

    $.ajax({
      url: '/url',
      data: {file: file, id: id},
      method: 'GET',

      success: function(){
        $('#archive_progress').html('');
        deleteArchiveSuccess();
      },
      error: function(){
        deleteArchiveError();
      }
    });
    return false;
    });
});