$(document).ready(function(){
    $('#cattab a').click(function (e) {
        e.preventDefault();
        var url = "/cap/get?b_id=" + $(this).attr("bid") + "&c_id=" + $(this).attr("catid");
        $.ajax({
            url: url
        }).done(function(data) {
            $("#stuff").html($.trim(data));
            window.history.pushState({}, '', url);
        });
    });
    $('#dirtab a').click(function (e) {
        e.preventDefault();
        var url = "/cap/get?b_id=" + $(this).attr("bid") + "&d_id=" + $(this).attr("dirid") + "&c_id=" + $(this).attr("catid");
        $.ajax({
            url: url
        }).done(function(data) {
            $("#stuff").html($.trim(data));
            window.history.pushState({}, '', url);
        });
    })
});