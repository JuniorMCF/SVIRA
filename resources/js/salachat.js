
Echo.channel('channel-chat')
.listen('ChatCreated',(e)=>{ 
    console.log(id_user)
    getChatStateDoctor(id_chat,username);
});


Echo.channel('channel-chat')
    .listen('ChatUpdated',(e)=>{ 
    console.log(id_user)
    getChatStateDoctor(id_chat,username);
});

$(

console.log(id_user),
getChatStateDoctor(id_chat,username),

$("#send-message").on('click',function(e){
    const token = document.head.querySelector('meta[name="csrf-token"]');
    const from_user = $('#from_user').val()
    const to_user = $("#to_user").val()
    const message = $("#message").val()


    //console.log(from_user+to_user+message);

    const data = new FormData()
    data.append('from_user',from_user)
    data.append('to_user',to_user)
    data.append('id_chat',id_chat)
    data.append('message',message)

    axios.post('/send-message-chat',data,{
        headers: {
            _token:token
        }
    }).then(response =>{
        //console.log(response.data)
        $('#message').value = ''
    }).catch(error =>{
        console.log(error.response.data)
    })
        
})
)

function getChatStateDoctor(id_chat,from_user){

    var ul = $('#chat-content')
    ul.scrollTop(ul.prop('scrollHeight'));

    const token = document.head.querySelector('meta[name="csrf-token"]');


    axios.get('/chat-state-doctor/'+id_chat,{
        headers: {
            _token:token
        }
    }).then(response =>{
        if(response.status == 200){ //to-user
            //console.log(response.data)
            drawChatToUser(response.data.messages,id_user,from_user)
        }else if(response.status == 201){// all
            drawChatToAll(response.data.messages,id_user,from_user)
        }
    }).catch(error =>{
        console.log(error)
    })
}


function drawChatToUser(messages,id_user,from_user){
    console.log(messages)
    var chat = ''

    for(i in messages){
        if(messages[i].to_user == id_user){//derecha
            chat += chatLeft(messages[i].content,messages[i].from_user)
        }else{//izquierda
            chat += chatRight(messages[i].content,from_user)
        }
    }


    $('#chat-content').html(chat)
    var ul = $('#chat-content')
    ul.scrollTop(ul.prop('scrollHeight'));
}
function drawChatToAll(messages,id_user,from_user){
    console.log(messages)

    var chat = ''

    for(i in messages){
        if(messages[i].from_user == id_user){//derecha
            chat += chatLeft(messages[i].content,from_user)
        }else{//izquierda
            chat += chatRight(messages[i].content,from_user)
        }
    }


    $('#chat-content').html(chat)
    var ul = $('#chat-content')
    ul.scrollTop(ul.prop('scrollHeight'));
}


function chatLeft(message,from_user){
    var htmlChatLeft = ""
    htmlChatLeft += '<li class="card rounded"><div class="d-flex">'
    htmlChatLeft += '<div class="image-chat"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle img-fluid" viewBox="0 0 16 16">'
    htmlChatLeft += '<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>'
    htmlChatLeft += '<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>'
    htmlChatLeft += '</svg></div>'
    htmlChatLeft += '<div class="comment-chat">'
    htmlChatLeft += '<strong>'+from_user+'</strong><br>'
    htmlChatLeft += '<span>'+message+'</span>'
    htmlChatLeft += '</div></li>'

    return htmlChatLeft
}
function chatRight(message,from_user){
    var htmlChatRight = ""

    htmlChatRight += '<li class="card rounded"><div class="d-flex">'
    htmlChatRight += '<div class="comment-chat-right">'
    htmlChatRight += '<strong>'+from_user+'</strong><br>'
    htmlChatRight += '<span>'+message+'</span></div>'
    htmlChatRight += '<div class="image-chat-right"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle img-fluid" viewBox="0 0 16 16">'
    htmlChatRight += '<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>'
    htmlChatRight += '<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>'
    htmlChatRight += '</svg></div>'
    htmlChatRight += '</div></li>'

    return htmlChatRight
}

function parametersChat(){
/*<input type="text" name="from_user" id="from_user" value="{{Auth::user()->id}}" disabled class="d-none">
<input type="text" name="to_user" id="to_user" value="all" disabled class="d-none">
<input  type="text" name="message"  id="message" class="form-control"></input>*/
}