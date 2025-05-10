<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    ::-webkit-scrollbar {
        width: 5px;
    }

    ::-webkit-scrollbar-track {
        background: #13254c;
    }

    ::-webkit-scrollbar-thumb {
        background: #061128;
    }

    #content-box {
        padding-bottom: 20px;
    }

    #input {
        color: white;
    }

    input::placeholder {
        color: #ccc;
    }
</style>

<body style="background: #061128;">
    <div>
        <div class="container-fluid m-0 d-flex p-2">
            <div class="pl-2" style="width: 40px; height:50px; font-size:180%;">
                <i class="fa fa-angle-double-left text-white mt-2"></i>
            </div>
            <div style="width: 50px; height: 50px;">
                <img src="https://cdn-icons-png.flaticon.com/512/6858/6858504.png" width="100%" height="100%" style="border-radius: 50px;">
            </div>
            <div class="text-white font-weight-bold ml-2 mt-2">
                Chat Aing Bot
            </div>
        </div>
        <div style="background: #061128; height:2px;"></div>
        <div id="content-box" class="container-fluid p-2" style="height: calc(100vh - 130px); overflow-y:scroll">

        </div>
        <div class="container-fluid w-100 px-3 py-2 d-flex" style="background: #131f45; height: 62px;">
            <div class="mr-2 pl-2" style="background: #ffffff1c; width:calc(100% - 45px); border-radius: 5px;">
                <input id="input" class="text-while" type="text" name="input" style="background: none; width:100%; height:100%; border:0; outline:none;">
            </div>
            <div id="button-submit" class="text-center" style="background: #4acfee; height:100%; width: 50px; border-radius:5px;">
                <i class="fa fa-paper-plane text-white" aria-hidden="true" style="line-height: 45px;"></i>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Menangani event Enter untuk input
        $('#input').on('keydown', function(e) {
            if (e.key === 'Enter') {
                $('#button-submit').click(); // Men-trigger klik tombol submit
                e.preventDefault(); // Agar tidak terjadi reload
            }
        });

        $('#button-submit').on('click', function() {
            var $value = $('#input').val(); // Ambil nilai dari input

            // Jika input kosong, jangan kirim
            if ($value.trim() === "") {
                return;
            }

            // Menambahkan pesan dari pengguna ke dalam kotak chat
            $('#content-box').append(`
            <div class="mb-2">
                <div class="float-right px-3 py-2" style="width: 270px; background: #4acfee; border-radius: 10px; font-size: 85%;">
                    ${$value}
                </div>
                <div style="clear: both;"></div>
            </div>
        `);

            // Kirim data ke server melalui AJAX
            $.ajax({
                type: 'POST',
                url: '/send',
                data: {
                    'input': $value
                },
                success: function(data) {
                    // Tambahkan respons dari bot ke kotak chat
                    $('#content-box').append(`
                    <div class="d-flex align-items-start mb-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/6858/6858504.png" width="40" height="40" class="rounded-circle mr-2" />
                        <div class="px-3 py-2" style="max-width: 80%; background: #13254c; border-radius: 12px; color: white; font-size: 90%;">
                            ${data}
                        </div>
                    </div>
                `);

                    // Scroll ke bagian bawah
                    $('#content-box').scrollTop($('#content-box')[0].scrollHeight);

                    // Kosongkan input setelah pesan dikirim
                    $('#input').val('');
                }
            });
        });
    });
</script>