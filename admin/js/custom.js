
   (function($) {
    $(".ripple-effect").click(function(e){
        var rippler = $(this);

        // create .ink element if it doesn't exist
        if(rippler.find(".ink").length == 0) {
            rippler.append("<span class='ink'></span>");
        }

        var ink = rippler.find(".ink");

        // prevent quick double clicks
        ink.removeClass("animate");

        // set .ink diametr
        if(!ink.height() && !ink.width())
        {
            var d = Math.max(rippler.outerWidth(), rippler.outerHeight());
            ink.css({height: d, width: d});
        }

        // get click coordinates
        var x = e.pageX - rippler.offset().left - ink.width()/2;
        var y = e.pageY - rippler.offset().top - ink.height()/2;

        // set .ink position and add class .animate
        ink.css({
          top: y+'px',
          left:x+'px'
        }).addClass("animate");
    })
})(jQuery);


 $("#submit").submit(function () {
            var timefrom = new Date();
            temp = $('#timefrom').val().split(":");
            timefrom.setHours((parseInt(temp[0]) - 1 + 24) % 24);
            timefrom.setMinutes(parseInt(temp[1]));

            var timeto = new Date();
            temp = $('#timeto').val().split(":");
            timeto.setHours((parseInt(temp[0]) - 1 + 24) % 24);
            timeto.setMinutes(parseInt(temp[1]));

            if (timeto <= timefrom) 
                alert('start time should be smaller');
            });
           

$(".btnaddpatient").click( function(){
    $(".showpatient").css("display","none");
    $(".addpatient").css("display","block");
    $(".btnaddpatient").css("display","none");
    $(".btnshowpatient").css("display","block");
});

$(".btnshowpatient").click( function(){
    $(".showpatient").css("display","block");
    $(".addpatient").css("display","none");
    $(".btnaddpatient").css("display","block");
    $(".btnshowpatient").css("display","none");
});

$(".btnaddexpense").click( function(){
    $(".showexpense").css("display","none");
    $(".addexpense").css("display","block");
    $(".btnaddexpense").css("display","none");
    $(".btnshowexpense").css("display","block");
});

$(".btnshowexpense").click( function(){
    $(".showexpense").css("display","block");
    $(".addexpense").css("display","none");
    $(".btnaddexpense").css("display","block");
    $(".btnshowexpense").css("display","none");
});

$(".btnadddoctor").click( function(){
    $(".showdoctor").css("display","none");
    $(".adddoctor").css("display","block");
    $(".btnadddoctor").css("display","none");
    $(".btnshowdoctor").css("display","block");
});

$(".btnshowdoctor").click( function(){
    $(".showdoctor").css("display","block");
    $(".adddoctor").css("display","none");
    $(".btnadddoctor").css("display","block");
    $(".btnshowdoctor").css("display","none");
});

$(".btnaddtreatment").click( function(){
    $(".showtreatment").css("display","none");
    $(".addtreatment").css("display","block");
    $(".btnaddtreatment").css("display","none");
    $(".btnshowtreatment").css("display","block");
});

$(".btnshowtreatment").click( function(){
    $(".showtreatment").css("display","block");
    $(".addtreatment").css("display","none");
    $(".btnaddtreatment").css("display","block");
    $(".btnshowtreatment").css("display","none");
});

$(".btnaddappoint").click( function(){
    $(".showappoint").css("display","none");
    $(".addappoint").css("display","block");
    $(".btnaddappoint").css("display","none");
    $(".btnshowappoint").css("display","block");
});

$(".btnshowappoint").click( function(){
    $(".showappoint").css("display","block");
    $(".addappoint").css("display","none");
    $(".btnaddappoint").css("display","block");
    $(".btnshowappoint").css("display","none");
});

document.getElementById("FileAttachment").onchange = function () {
    document.getElementById("fileuploadurl").value = this.value.replace(/C:\\fakepath\\/i, '');
};

