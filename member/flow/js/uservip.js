
$('.mainLeft ul li').click(function(){
    $(this).addClass('mainLeft_li').siblings('.mainLeft_li').removeClass('mainLeft_li');
    var n = $(this).index();
    $('.main section').eq(n).show().siblings().hide();
});