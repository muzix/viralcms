// This is a manifest file that'll be compiled into application.js, which will include all the files
// listed below.
//
// Any JavaScript/Coffee file within this directory, lib/assets/javascripts, vendor/assets/javascripts,
// can be referenced here using a relative path.
//
// It's not advisable to add code directly here, but if you do, it'll appear in whatever order it
// gets included (e.g. say you have require_tree . then the code will appear after all the directories
// but before any files alphabetically greater than 'application.js'
//
// The available directives right now are require, require_directory, and require_tree
//
//= require jquery
//= require_tree .

var DEBUG_MODE = true;

function log(message) {
    if (DEBUG_MODE) {
        alert(message);
    }
}

function debug(message) {
    if (DEBUG_MODE) {
        console.log(message);
    }
}

$( document ).ready(function() {

    var script = document.currentScript || (function() {
        var scripts = document.getElementsByTagName("script");
        return scripts[scripts.length - 2];
    })();

    if (script.hasAttribute('data-page')) {
        var page = script.getAttribute('data-page');
        if (page == 'dashboard') {
            debug('dashboard');
            RuAoTrungThatAdmin.init();
        } else if (page == 'quizcontest.create') {
            debug('quizcontest.create');
            QuizContestCreate.init();
        } else {

        }
    }

});