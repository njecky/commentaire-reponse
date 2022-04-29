$(function(){
      $('.reply').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var $comment = $($this).parents('.comment');
        var $form = $('#comment');
        var id = $this.data('id');
        $form.hide();
        $comment.after($form);
        $form.slideDown();
        $('#parent_id').val(id);
      })
    });