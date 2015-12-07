var themes = {
    "default": "css/bootstrap.css",
    "test" : "css/themes/test.css"
}

$(function(){
   var themesheet = $('<link href="'+themes['default']+'" rel="stylesheet" />');
    themesheet.appendTo('head');
    $('.theme-link').click(function(){
       var themeurl = themes[$(this).attr('data-theme')];
        themesheet.attr('href',themeurl);
    });
});
