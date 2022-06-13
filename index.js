$('document').ready(function () {
    console.log('document ready');
    $.ajax({
        url: 'http://pub.royalhoteltg.com/api/index.php',
        type: 'get',
        success: function (res) {
            console.log(res)
            res.forEach( pub => {
                let src = './banner-placeholder.png';
                if(pub.image) src = 'http://pub.royalhoteltg.com/api/'+pub.image;
                $("#banner"+ pub.id).attr('src', src);
            })
        }
    });

    const uploadBtn1 = $('#upload1'),
        uploadBtn2 = $('#upload2'),
        uploadBtn3 = $('#upload3'),
        deleteBtn1 = $('#delete1'),
        deleteBtn2 = $('#delete2'),
        deleteBtn3 = $('#delete3'),
        input1 = $('#input1'),
        input2 = $('#input2'),
        input3 = $('#input3');



    // for inpu1
    uploadBtn1.click(function () {
        console.log('upload1');
        input1.click();
    });

    input1.change(function (ev) {
        console.log('input1', ev);
        const file = ev.target.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            console.log(e.target.result)
            if (e.target.result) {
                $('#banner1').attr('src', e.target.result);
                var fd = new FormData();
                fd.append('id', "1")
                fd.append('file', file);
                $.ajax({
                    url: './api/index.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response)
                        alert(response.message)
                    },
                    error: function(err) {
                        console.log(err)
                        alert(err.message)
                    }
                });
            } else {
                alert("Please select a file.");
            }

        }
        reader.readAsDataURL(file);
    })

    deleteBtn1.click(function() {
        var fd = new FormData();
        fd.append('id', "1")
        fd.append('delete', true);
        $.ajax({
            url: './api/index.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#banner1").attr('src', './banner-placeholder.png');
                alert(response.message)
            },
            error: function(err) {
                console.log(err)
                alert(err.message)
            }
        });
    })

    // for input2
    uploadBtn2.click(function () {
        console.log('upload2');
        input2.click();
    });

    input2.change(function (ev) {
        console.log('input2', ev);
        const file = ev.target.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            console.log(e.target.result)
            if (e.target.result) {
                $('#banner2').attr('src', e.target.result);
                var fd = new FormData();
                fd.append('file', file);
                fd.append('id', "2")
                $.ajax({
                    url: './api/index.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response)
                        alert(response.message)
                    },
                    error: function(err) {
                        console.log(err)
                        alert(err.message)
                    }
                });
            } else {
                alert("Please select a file.");
            }

        }
        reader.readAsDataURL(file);
    })


    deleteBtn2.click(function() {
        var fd = new FormData();
        fd.append('id', "2")
        fd.append('delete', true);
        $.ajax({
            url: './api/index.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#banner2").attr('src', './banner-placeholder.png');
                alert(response.message)
            },
            error: function(err) {
                console.log(err)
                alert(err.message)
            }
        });
    })

     // for input3
     uploadBtn3.click(function () {
        console.log('upload3');
        input3.click();
    });

     input3.change(function (ev) {
        console.log('input3', ev);
        const file = ev.target.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            console.log(e.target.result)
            if (e.target.result) {
                $('#banner3').attr('src', e.target.result);
                var fd = new FormData();
                fd.append('file', file);
                fd.append('id', "3")
                $.ajax({
                    url: './api/index.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response)
                        alert(response.message)
                    },
                    error: function(err) {
                        console.log(err)
                        alert(err.message)
                    }
                });
            } else {
                alert("Please select a file.");
            }

        }
        reader.readAsDataURL(file);
    })

    deleteBtn3.click(function() {
        var fd = new FormData();
        fd.append('id', "3")
        fd.append('delete', true);
        $.ajax({
            url: './api/index.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#banner3").attr('src', './banner-placeholder.png');
                alert(response.message)
            },
            error: function(err) {
                console.log(err)
                alert(err.message)
            }
        });
    })


});