$.ajax({
    url: 'include/check_token.php',
    dataType: 'json',
    success: function (data) {

        console.log(data['status']);

        if (data['status']) {
            window.location.href = '../index1.php';
        }
    }
})