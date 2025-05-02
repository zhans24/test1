const loginBox = document.querySelector('.login');
const signupBox = document.querySelector('.signup');
const toggleLinks = document.querySelectorAll('.toggle');

signupBox.style.display='none'

toggleLinks.forEach(link => {
    link.addEventListener('click', () => {
        signupBox.style.display = signupBox.style.display === 'none' ? 'block' : 'none';
        loginBox.style.display = loginBox.style.display === 'none' ? 'block' : 'none';

    });
});

$("#sign-up-form").on('submit',function (e){
    e.preventDefault();

    const formData=$(this).serialize()

    $.ajax({
        url:"/register",
        type:"POST",
        data:formData,
        success: function (res){
            alert(res)
            signupBox.style.display='none'
            loginBox.style.display='block'
        }
    })
})


$("#sign-in-form").on('submit',function (e){
    e.preventDefault();

    const formData=$(this).serialize()

    $.ajax({
        url:"/login",
        type:"POST",
        data:formData,
        success: function (res){
            console.log(res)
            if (res.success){
                window.location.href='/../dashboard.php'
            }else {
                alert(res)
            }
        }
    })
})


    $('#logout').on('submit', (e) => {
        e.preventDefault();
        $.ajax({
            url: '/logout',
            method: 'POST',
            dataType: 'json',
            success: function (res) {
                alert(res.message);
                window.location.href = '/index.php';
            },
            error: function () {
                alert('error logout')
            }
        });
    });
