function clock() {
    const d = new Date();
    const tn = d.getTime();
    const tll = new Date(resumen.tlp);
    const tl = tll.getTime();
    const timer = $("#timer");
    const timers = $("#timers");
    const timerm = $("#timerm");
    const clock = $("#clock");
    timer.val(tn - tl);
    const timenow = timer.val();
    timers.val(parseInt(parseInt(timenow) / 1000) % 60);
    timerm.val(parseInt(parseInt(timenow) / 1000 / 60));
    const timemin = timerm.val();
    if (timemin > 2) {
        clock.css('backgroundColor', 'yellow');
    }
    if (timemin > 4) {
        clock.css('backgroundColor', 'red');
    }
    const evenodd = parseInt(timenow) % 2;
    if (0 === evenodd) {
        clock.css('backgroundColor', 'green');
    }
}
