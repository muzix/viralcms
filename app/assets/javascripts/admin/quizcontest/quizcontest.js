function showProgressModal() {
    bootbox.dialog({
        title: "Vui lòng chờ ...",
        message: '<div class="progress progress-striped active"><div class="progress-bar" style="width: 100%"></div></div>'
    });
}

QuizList = function() {
    function _init() {
        _bindUIActions();
    }

    function _bindUIActions() {
        $('#button-create-quiz').click(function() {
            window.location.href = 'quiz-contest/quiz/create';
        });

        // Bind click event to all delete button
        $("button.button-delete-quiz").each(function(i, elem){
            $(elem).click(function(){
                bootbox.dialog({
                    message: "Bạn có chắc chắn muốn xóa?",
                    title: "Thông báo",
                    buttons: {
                        success: {
                            label: "Hủy",
                            className: "btn-dedault",
                            callback: function() {
                                //Example.show("great success");
                            }
                        },
                        danger: {
                            label: "Xóa!",
                            className: "btn-danger",
                            callback: function() {
                                //alert("DELETE " + $(elem).attr('data-quiz'));
                                //Example.show("uh oh, look out!");
                                $('input#input-quiz-id').val($(elem).attr('data-quiz'));
                                $('#form-delete-quiz').submit(function( event ) {
                                    //alert( "Handler for .submit() called." );
                                    
                                });
                                $('#form-delete-quiz').submit();
                                showProgressModal();
                            }
                        }
                    }
                });
            });
        });
    
        // Bind click event to all edit button
        $("button.button-edit-quiz").each(function(i, elem){
            $(elem).click(function(){
                var redirectPath = 'quiz-contest/quiz/edit/' + $(elem).attr('data-quiz');
                window.location.href = redirectPath;
            });
        });
    }

    return {
        init: _init
    };
}();