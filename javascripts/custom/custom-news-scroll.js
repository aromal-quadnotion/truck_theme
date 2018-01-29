jQuery(document).ready(function($){
    // None of the options are set
    $(".makeMeScrollable").smoothDivScroll({
        autoScrollingMode: "always",
        autoScrollDirection: "endlessLoopRight",
        autoScrollInterval: 10,
        autoScrollStep: 10,
        autoScrollingInterval: 20,
    });
});
