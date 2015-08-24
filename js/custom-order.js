jQuery(window).on('resize', function(){
      var win = jQuery(this); //this = window
      if (win.width() <= 768) { jQuery(".left").insertAfter(".right") };
      if (win.width() >= 768) { jQuery(".right").insertAfter(".left") };
});