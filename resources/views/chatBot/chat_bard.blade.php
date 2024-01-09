<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chat with Bard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

    <header>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ url('/css/app.css') }}">
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <link rel="stylesheet" href="{{ url('/css/chat_bard.css') }}">
    </header>
    <h2>Chat Messages</h2>
    <div class="container-fluid" id="chat_conversation">
        <div class="container">
            <img src="https://avatars.githubusercontent.com/u/79963761?v=4" alt="Avatar">
            <p>Hello. How are you today?</p>
            <span class="time-right">{{ date('Y-m-d H:i:s A') }}</span>
        </div>
        <div class="container darker">
            <img src="https://www.w3schools.com/w3images/avatar_g2.jpg" alt="Avatar" class="right">
            <p>Hey! I'm fine. Thanks for asking!</p>
            <span class="time-left">{{ date('Y-m-d H:i:s A') }}</span>
        </div>
    </div>
    <!-- Add a text input and a button to trigger the NLP processing -->
    <form action="/process-nlp" method="POST">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px"></textarea>
            <label for="floatingTextarea">Comments</label>
        </div>
        <div class="text-center mt-2">
            <button class="btn btn-success" type="submit">Process</button>
        </div>
    </form>
    <div id="loader"></div>
    <script>
        $(document)
            .ajaxStart(function() {
                $('#loader').show();
            })
            .ajaxStop(function() {
                $('#loader').hide();
            });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('form').on('submit', function(e) {
            e.preventDefault();
            var inputText = $('#floatingTextarea').val();
            $('#floatingTextarea').val('');
            appendToUser(inputText);
            $.ajax({
                url: $('form').prop('action'),
                _method: $('form').prop('method'),
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify({
                    inputText: inputText
                }),
                contentType: 'application/json',
                success: function(data) {},
                error: function(error) {
                    console.log(error);
                }
            }).done(function(response) {
                console.log(response);
                if (response.hasOwnProperty('status')) {
                    appendToBard(response.result);
                    $('#floatingTextarea').focus();
                }
            });
        });

        function appendToUser(text) {
            var html = '<div class="container" id="flyoutMenu">';
            html += '<img src="https://avatars.githubusercontent.com/u/79963761?v=4" alt="Avatar">';
            html += '<p>' + text + '</p>';
            html += '<span class="time-left">{{ date('Y-m-d H:i:s A') }}</span>';
            html += '</div>';
            $('#chat_conversation').append(html);
            $('#flyoutMenu').attr('id', '');
        }

        function appendToBard(text) {
            var html = '<div class="container darker" id="flyoutMenu">';
            html += '<img src="https://www.w3schools.com/w3images/avatar_g2.jpg" alt="Avatar" class="right">';
            html += '<p>' + text + '</p>';
            html += '<span class="time-right">{{ date('Y-m-d H:i:s A') }}</span>';
            html += '</div>';
            $('#chat_conversation').append(html);
            $('#flyoutMenu').attr('id', '');
        }
    </script>
</body>


</html>
