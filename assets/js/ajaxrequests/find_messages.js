// True , means messages from uses are the one being fetched , 
//  False means group messages are being fetched  
normalmessages=null;


    // Ajax To find Messages accordingly to the chat
    chatBox = document.querySelector(".whrmsggoes")
            // Function To scroll the Mouse to the bottom 
    function scrollToBottom(){
                chatBox.scrollTop = chatBox.scrollHeight;
            }
           

    //Function That will be called over and over again after some interval of time
        function get_messages_again(l) {
        url = "private/find_messages.php?chat=" + l;
        let xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var d = new Date();
            var t = d.toLocaleTimeString();
            let result = xhr.responseText;
            let target = document.querySelector(".whrmsggoes");
            target.innerHTML = result;
            document.querySelector(".textmessageid").value=l;
            // Check is user is in or out to do the scrolling after getting the data
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
            }
        }
    }
    xhr.send();
}
    
var settfunc = "";
        function end_get_messages() {
        clearInterval(settfunc);
        }
    // sent Interval Function to call the getMessage function over and over
    var identifier=0;
    function keepfindingtext(l) {
        normalmessages=true;
         identifier=l;
        // When New Contact is selected , we need to end the interval of the previous selection by clearing it
        // Create a new interval accordingly to the selected contact
        //End Previous Set Interval in case user was in a group
        end_group_messages();
        end_get_messages();
        settfunc = setInterval(get_messages_again, 500, l);
    }




    // Find Group Messages



    //Function That will be called over and over again after some interval of time
        function get_group_messages_again(l) {
        url = "private/find_group_messages.php?chat=" + l;
        let xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var d = new Date();
            var t = d.toLocaleTimeString();
            let result = xhr.responseText;
            let target = document.querySelector(".whrmsggoes");
            target.innerHTML = result;
            document.querySelector(".textmessageid").value=l;
            // Check is user is in or out to do the scrolling after getting the data
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
            }
        }
    }
    xhr.send();
}
    
var setfunc2 = "";
        function end_group_messages() {
        clearInterval(setfunc2);
        }

        var identifier2=0;
    // sent Interval Function to call the getMessage function over and over
    function keepfindinggroupmsg(l) {
        normalmessages=false;
        identifier2=l;
        // When New Contact is selected , we need to end the interval of the previous selection by clearing it
        // Create a new interval accordingly to the selected contact
        //End Previous Set Interval in case user was in a contact
        end_group_messages();
        end_get_messages();
        
        setfunc2 = setInterval(get_group_messages_again, 500, l);
    }


     // Detect when the mouse enter the chatbox , so that the scrolling does not 
            // Happen as long as the user is inside the chatbox
            chatBox.onmouseenter = ()=>{
                chatBox.classList.add("active");
                end_group_messages();
                end_get_messages();
                }
            // As soon as the user leave then sroll to the latest message
            chatBox.onmouseleave = ()=>{
                chatBox.classList.remove("active");
                if(normalmessages==true){
                settfunc = setInterval(get_messages_again, 500, identifier);
                }else{
                    setfunc2 = setInterval(get_group_messages_again, 500, identifier2);
                }
                }



    



function delete_message(id){

    Swal.fire({
    title: 'Are you sure?',
    text: "Do you Really want to delete This message?",
    icon: 'warning',
    position: 'top-end',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
       
    let action="private/delete_message.php";
    var parent = document.querySelector(".msg_"+id);
    console.log("Parent is: "+parent)
    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
    if(xhr.readyState == 4 && xhr.status == 200) {
        let result = xhr.responseText;
        console.log('Result: ' + result);
        let json = JSON.parse(result);
        if(json.hasOwnProperty('errors') && json.errors.length > 0) {
             Swal.fire(
             'Eroor!',
             'Please Try Again Later.',
             'error'
             )
        } else {
            parent.classList.add("d-none");

            Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Record Deleted Successfully',
        showConfirmButton: false,
        timer: 1000
        });     
        
     }
    }
    };
    xhr.send("msg_id=" + id);
    }
    })
}