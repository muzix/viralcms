QuizContestCreate = function() {
    function _init() {
        _bindUIActions();
    }

    function _bindUIActions() {
        $('#button-create-quiz').click(function() {
            window.location.href = 'quiz-contest/quiz/create';
        });
    }

    return {
        init: _init
    };
}();