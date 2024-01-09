@extends('layouts.app')

@section('chatBot')
<div class="body">
    <title>Chat with Bard</title>
    <link rel="stylesheet" href="{{ url('/css/chat_bard.css') }}">
    
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
</div>
@endsection