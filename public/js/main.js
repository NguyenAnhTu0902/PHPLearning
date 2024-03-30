$(document).ready(function () {

    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
    $('#content').css('min-height', height);

//  CHECK ALL
    $('input[name="checkAll"]').click(function () {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });

// EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });
});
//Selected checked box
// $(document).ready(function(){
//     var cat_id = $('#cat_id').attr('data-value');
//     var checked_id = '#cat-id-'+cat_id;
//     $(checked_id).attr('selected', 'selected');
// })
function active_option(parent_id){
    var selector = '#'+parent_id;
    var checked_value = $(selector).attr('data-value');
    var checked_id = '#' + parent_id + '-' + checked_value;
    $(checked_id).attr('selected', 'selected');
}
function active_list_status(){
    var active_status = $('#list-status').attr('data-value');
    if(active_status==''){
        $('#status-0').addClass('active');
    }
    else{
        var selector = '#status-'+ active_status;
        $(selector).addClass('active');
    }
    
}
$(document).ready(function(){
    //active các tab khi được chọn
    active_option('cat-id');
    active_option('order-status');
    active_option('product-status');
    active_option('gender');
    active_option('parents-cat-id');
    active_option('slide-status');
    active_list_status();
    //Hiển thị popup khi xóa cat
    $('.delete-cat').click(function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var delete_link = '?mod=products&action=delete_cat&cat_id=' + id;
        console.log(delete_link);
        $('#confirm-popup').addClass('active');
        $('#btn-y').attr('href', delete_link);
        $(document).scroll(function(e){
            e.preventDefault();
        })
    });
    $('#btn-n').click(function(e){
        e.preventDefault();
            $('#confirm-popup').removeClass('active');
        });
})
