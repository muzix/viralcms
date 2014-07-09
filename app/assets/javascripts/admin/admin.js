RuAoTrungThatAdmin = function() {

    function _init() {
        _bindUIActions();
    }

    function _bindUIActions() {
        $('#table-ranking').show();
        $('#table-code').hide();

        $('#panel-ranking').click(function() {
            $('#table-ranking').show();
            $('#table-code').hide();
        });

        $('#panel-code').click(function() {
            $('#table-ranking').hide();
            $('#table-code').show();
        });
    }

    return {
        init:_init
    };
}();