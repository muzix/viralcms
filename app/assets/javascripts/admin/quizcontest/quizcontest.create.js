QuizContestCreate = function() {
    function _init () {
        $('#create-quiz').hide();
        _bindUIActions();
    }

    function _bindUIActions() {
        $('#button-create-quiz').click(function(){
            $('#button-create-quiz').hide();
            $('#legend-quiz-empty').hide();
            $('#create-quiz').show();
        });
    }

    return {
        init:_init
    };
}();