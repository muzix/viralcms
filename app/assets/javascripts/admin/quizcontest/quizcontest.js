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
        $("button.button-delete-quiz").each(function(i, elem) {
            $(elem).click(function() {
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
                                $('#form-delete-quiz input[name="quizId"]').val($(elem).attr('data-quiz'));
                                $('#form-delete-quiz').submit(function(event) {
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

        $("button.button-toggle-quiz").each(function(i, elem) {
            $(elem).click(function() {
                var message = "";
                var buttonTitle = "";
                var className = "";
                var form = "";
                var action = $(elem).attr('data-action');
                action = action.trim();
                if (action == "lock") {
                    message = "Bạn có muốn khóa chủ đề này?";
                    buttonTitle = "Khóa!";
                    className = "btn-danger";
                    form = "#form-lock-quiz";
                } else {
                    message = "Bạn có muốn mở khóa chủ đề này?";
                    buttonTitle = "Mở khóa!";
                    className = "btn-success";
                    form = "#form-unlock-quiz";
                }
                bootbox.dialog({
                    message: message,
                    title: "Thông báo",
                    buttons: {
                        success: {
                            label: "Hủy",
                            className: "btn-dedault",
                            callback: function() {
                                //Example.show("great success");
                            }
                        },
                        main: {
                            label: buttonTitle,
                            className: className,
                            callback: function() {
                                //alert("DELETE " + $(elem).attr('data-quiz'));
                                //Example.show("uh oh, look out!");
                                $('#form-lock-quiz input[name="quizId"]').val($(elem).attr('data-quiz'));
                                $('#form-unlock-quiz input[name="quizId"]').val($(elem).attr('data-quiz'));
                                $(form).submit(function(event) {
                                    //alert( "Handler for .submit() called." );

                                });
                                $(form).submit();
                                showProgressModal();
                            }
                        }
                    }
                });
            });
        });

        // Bind click event to all edit button
        $("button.button-edit-quiz").each(function(i, elem) {
            $(elem).click(function() {
                var redirectPath = 'quiz-contest/quiz/edit/' + $(elem).attr('data-quiz');
                window.location.href = redirectPath;
            });
        });
    }

    return {
        init: _init
    };
}();

QuizCreate = function() {
    function _init() {
        _bindUIActions();
    }

    function _bindUIActions() {
        var config = {
            height: 300, // set editor height

            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor

            focus: false,
        };
        $('#summernote-description').summernote(config);
        $('#summernote-privacy').summernote(config);
        $('#summernote-term').summernote(config);
    }

    return {
        init: _init
    };
}();

QuizEdit = QuizCreate;

QuestionList = function() {
    function _init() {
        _bindUIActions();
    }

    function _bindUIActions() {
        $('#button-create-question').click(function() {
            window.location.href = '/admin/quiz-contest/question/create?quizId=' + $('#button-create-question').attr('data-quiz');
        });

        // Bind click event to all edit button
        $("button.button-edit-question").each(function(i, elem) {
            $(elem).click(function() {
                var redirectPath = '/admin/quiz-contest/question/edit/' + $(elem).attr('data-question');
                window.location.href = redirectPath;
            });
        });

        // Bind click event to all delete button
        $("button.button-delete-question").each(function(i, elem) {
            $(elem).click(function() {
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
                                $('input#input-question-id').val($(elem).attr('data-question'));
                                $('#form-delete-question').submit(function(event) {
                                    //alert( "Handler for .submit() called." );

                                });
                                $('#form-delete-question').submit();
                                showProgressModal();
                            }
                        }
                    }
                });
            });
        });
    }

    return {
        init: _init
    };
}();

QuestionCreate = function() {
    var _currentVideoId = '';

    function _init() {
        _setupUI();
        _bindUIActions();
    }

    function _setupUI() {
        if ($('input#youtube').val() !== '') {
            $('button#button-show-youtube').show();
            $('#form-group-youtube').addClass('has-success');
        } else {
            $('button#button-show-youtube').hide();
        }
    }

    function _bindUIActions() {
        $('input#youtube').focusout(function() {
            if ($('input#youtube').val() !== '') {
                $('button#button-show-youtube').show();
                if ($('input#youtube').val() != _currentVideoId) {
                    $('button#button-show-youtube').removeClass('has-success');
                    $('button#button-show-youtube').removeClass('has-error');
                }
            } else {
                $('button#button-show-youtube').hide();
            }
        });

        $('input#youtube').click(function() {
            _currentVideoId = $('input#youtube').val();
        });

        $('button#button-show-youtube').click(function() {
            checkVideoExists($('input#youtube').val());
        });

        $('button#button-create-question').click(function(e) {
            if ($('#form-group-youtube').hasClass('has-success')) {
                //NOTHING
            } else {
                bootbox.alert("Vui lòng nhập đúng video id và ấn kiểm tra.");
                e.preventDefault();
            }
        });
    }

    function checkVideoExists(videoId) {
        if (videoId === '') {
            bootbox.alert('Video không tồn tại.');
            $('#form-group-youtube').addClass('has-error');
            return;
        }
        //log("http://gdata.youtube.com/feeds/api/videos/" + videoId);
        $.ajax({
            url: "//gdata.youtube.com/feeds/api/videos/" + videoId,
            contentType: "application/atom+xml",
            success: function(data) {
                bootbox.alert('<iframe width="560" height="315" src="//www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe>');
                $('#form-group-youtube').addClass('has-success');
            },
            error: function(error) {
                //log(JSON.stringify(error));
                bootbox.alert('Video không tồn tại.');
                $('#form-group-youtube').addClass('has-error');
            }
        });
    }

    return {
        init: _init
    };
}();

QuestionEdit = function() {

    var _currentVideoId = '';

    function _init() {
        _setupUI();
        _bindUIActions();
    }

    function _setupUI() {
        if ($('input#youtube').val() !== '') {
            $('button#button-show-youtube').show();
            $('#form-group-youtube').addClass('has-success');
        } else {
            $('button#button-show-youtube').hide();
        }
    }

    function _bindUIActions() {
        $('input#youtube').focusout(function() {
            if ($('input#youtube').val() !== '') {
                $('button#button-show-youtube').show();
                if ($('input#youtube').val() != _currentVideoId) {
                    $('#form-group-youtube').removeClass('has-success');
                    $('#form-group-youtube').removeClass('has-error');
                }
            } else {
                $('button#button-show-youtube').hide();
            }
        });

        $('input#youtube').click(function() {
            _currentVideoId = $('input#youtube').val();
        });

        $('button#button-show-youtube').click(function() {
            checkVideoExists($('input#youtube').val());
        });

        $('button#button-edit-question').click(function(e) {
            if ($('#form-group-youtube').hasClass('has-success')) {
                //NOTHING
            } else {
                bootbox.alert("Vui lòng nhập đúng video id và ấn kiểm tra.");
                e.preventDefault();
            }
        });
    }

    function checkVideoExists(videoId) {
        if (videoId === '') {
            bootbox.alert('Video không tồn tại.');
            $('#form-group-youtube').addClass('has-error');
            return;
        }
        $.ajax({
            url: "http://gdata.youtube.com/feeds/api/videos/" + videoId,
            contentType: "application/json; text/plain; charset=utf-8",
            success: function(data) {
                bootbox.alert('<iframe width="560" height="315" src="//www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe>');
                $('#form-group-youtube').addClass('has-success');
            },
            error: function(error) {
                bootbox.alert('Video không tồn tại.');
                $('#form-group-youtube').addClass('has-error');
            }
        });
    }

    return {
        init: _init
    };
}();