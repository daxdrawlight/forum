$(document).ready(function() {
    var url = window.location.href;
    var splitHash = url.split('#');
    var getURL = splitHash[0];
	$('.pagination').find('a').each(function() {

    if (this.href == getURL) {
        $(this).children().addClass("active_page");
        }
    else if (document.URL.indexOf("page") <= -1 && $(this).children().text() == '1'){
        $(this).children().addClass("active_page");
        }
});
});