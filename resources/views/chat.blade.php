<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chat GPT Laravel | Chơi cùng Hưng</title>
    <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="{{ url('/js/jquery-3.7.1.min.js') }}"></script>
    {{-- Bootstrap 5 --}}
    <link href="{{ url('/css/chat.css') }}" rel="stylesheet" />
    <script src="{{ url('/js/bootstrap.bundle.min.js') }}"></script>
    {{-- Font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="chat">

        <!-- Header -->
        <div class="top">
            <img src="https://avatars.githubusercontent.com/u/79963761?v=4" alt="Avatar" class="img-thumbnail"
                style="width: 10%;height:10%">
            <div>
                <p>Lê Việt Hưng</p>
                <small>Online</small>
            </div>
        </div>
        <!-- End Header -->

        <!-- Chat -->
        <div class="messages">
            <div class="left message">
                <img src="https://avatars.githubusercontent.com/u/79963761?v=4" alt="Avatar">
                <p>Start chatting with Chat GPT AI below!!</p>
            </div>
        </div>
        <!-- End Chat -->

        <!-- Footer -->
        <div class="bottom">
            <form>
                <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                <button type="submit" class="btn btn-primary text-center">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>
        <!-- End Footer -->

    </div>
</body>

<script>
    //Broadcast messages
    $("form").submit(function(event) {
        event.preventDefault();

        //Stop empty messages
        if ($("form #message").val().trim() === '') {
            return;
        }

        //Disable form
        $("form #message").prop('disabled', true);
        $("form button").prop('disabled', true);

        $.ajax({
            url: "/chat",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                "model": "gpt-3.5-turbo",
                "content": $("form #message").val()
            }
        }).done(function(res) {

            //Populate sending message
            $(".messages > .message").last().after('<div class="right message">' +
                '<p>' + $("form #message").val() + '</p>' +
                '<img src="https://avatars.githubusercontent.com/u/79963761?v=4" alt="Avatar">' +
                '</div>');

            //Populate receiving message
            $(".messages > .message").last().after('<div class="left message">' +
                '<img src="https://avatars.githubusercontent.com/u/79963761?v=4" alt="Avatar">' +
                '<p>' + res + '</p>' +
                '</div>');

            //Cleanup
            $("form #message").val('');
            $(document).scrollTop($(document).height());

            //Enable form
            $("form #message").prop('disabled', false);
            $("form button").prop('disabled', false);
        });
    });
</script>

</html>
