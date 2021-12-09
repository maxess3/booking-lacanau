const btnIndex = document.querySelector(".backToIndex");
if(btnIndex != undefined || btnIndex != null){
    btnIndex.addEventListener("click", () => {
        window.open("index.php","_self");
    })
};

const btnModify = document.querySelectorAll(".modify");
let target = null;
let targetClassList = null;
let idAppt = null;
for(let i = 0; i < btnModify.length; i++) {
    btnModify[i].addEventListener("click", (e) => {
        target = e.target;
        targetClassList = target.classList;
        idAppt = target.parentNode.parentNode.parentNode.dataset.appartment;
        if(targetClassList.contains("pending")){
            fetchUpdateBooking(0,idAppt);
        } else if(targetClassList.contains("accepted")){
            fetchUpdateBooking(1,idAppt);
        } else if(targetClassList.contains("rejected")){
            fetchUpdateBooking(2,idAppt);
        } else {
            console.log("problème...");
        }
    });
};

let xhr = null;
let serverResponse = null;
function fetchUpdateBooking(status,idAppt){
    xhr = new XMLHttpRequest();
    xhr.onload = function(){
    serverResponse = this.responseText;
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                document.location.reload();
            } else {
                console.log("Il y a un problème...");
            }
        }
    }
    xhr.open("POST", "functions/functionUpdateStatus.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`status=${status}&idAppt=${idAppt}`);
 }
 