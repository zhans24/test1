$('#logout').on('click', (e) => {
    e.preventDefault();
    console.log('Logout form submitted');
    $.ajax({
        url: '/dashboard.php/api/logout',
        method: 'POST',
        dataType: 'json',
        success: function (res) {
            console.log("come")
            alert(res.message);
            window.location.href = '/../index.php';
        },
        error: function () {
            alert('error logout')
        }
    });
});
