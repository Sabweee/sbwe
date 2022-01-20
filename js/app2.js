//Modal3

function check_end_point(min) {
    let overviews_list_items = document.querySelectorAll('.services1_card')
    min = overviews_list_items[0].dataset.id;
    for (let i = 1, len = overviews_list_items.length; i < len; i++) {
        if (overviews_list_items[i].dataset.id < min)
            min = overviews_list_items[i].dataset.id;
    }
    return min;
}


$('.btn-services1').click(function (){
    let endpoint = 0;
    endpoint = check_end_point(endpoint);
    $.ajax({
        url: 'include/get-cards1.php',
        type: 'GET',
        dataType: 'html',
        data: {
            endpoint: endpoint
        },
        success: function (data) {
            $('#second_wrapper').append(data);
        }
    })
})

$('#exit_account_button').click(function (){
    $.ajax({
        url: 'include/exit.php'
    });
    window.location.href = 'index.php';
});

$('.detail_page_button').click(function (){

    let id_post = ($(this).attr('data-id'));

    $.ajax({
        url: 'detail_page.php',
        type: 'GET',
        data:{
            id_post: id_post
        },
        success(data){
            window.location.href = 'index2.php';
        }
    })
});

$('.main-btn1').click(function (){
    let url = ($(this).attr('data-url'));
    window.location.href = url;
})

