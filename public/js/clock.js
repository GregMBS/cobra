function clock() {
    var d = new Date();
    var tn = d.getTime();
    var tll = new Date(tlp);
    var tl = tll.getTime();
    var timer = $("#timer");
    var timers = $("#timers");
    var timerm = $("#timerm");
    var clock = $("#clock");
    timer.val(tn - tl);
    var timenow = timer.val();
    timers.val(parseInt(parseInt(timenow) / 1000) % 60);
    timerm.val(parseInt(parseInt(timenow) / 1000 / 60));
    var timemin = timerm.val();
    if (timemin > 2) {
        clock.css('backgroundColor', 'yellow');
    }
    if (timemin > 4) {
        clock.css('backgroundColor', 'red');
    }
    var evenodd = parseInt(timenow) % 2;
    if (0 === evenodd) {
        clock.css('backgroundColor', 'green');
    }
}
