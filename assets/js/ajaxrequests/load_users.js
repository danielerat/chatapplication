// Ajax to Keep finding users when and the latest message sent to them, also , help to tell is 
// A user is online or not 
setInterval(() =>{
    let xhr= new XMLHttpRequest();
    xhr.open("GET","private/find_contacts.php",true);
    xhr.onreadystatechange= function (){ //call back function
    if(xhr.readyState== 4 && xhr.status== 200){
        let result=xhr.responseText;
        
        let target=document.querySelector(".contacts_list");
        if(!searchBar.classList.contains("active")){
        target.innerHTML=result;

        }
    }
    }
  xhr.send();
}, 1000);


