const btnIndex = document.querySelector(".backToIndex");
if(btnIndex != undefined || btnIndex != null){
    btnIndex.addEventListener("click", () => {
        window.open("index.php","_self");
    })
};

const btnModify = document.querySelectorAll(".modify");
for(let i = 0; i < btnModify.length; i++) {
    btnModify[i].addEventListener("click", (e) => {
        let target = e.target;
        let targetClassList = target.classList;
        let idAppt = target.parentNode.parentNode.parentNode.dataset.appartment;
        if(targetClassList.contains("accepted")){
            fetchUpdateBooking(1,idAppt);
        } else if(targetClassList.contains("pending")){
            fetchUpdateBooking(0,idAppt);
        } else if(targetClassList.contains("rejected")){
            fetchUpdateBooking(2,idAppt);
        } else {
            console.log("problème...");
        }
    });
};

function fetchUpdateBooking(status,idAppt){
    const xhr = new XMLHttpRequest();
    xhr.onload = function(){
    const serverResponse = this.responseText;
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                console.log("validé");
                console.log(serverResponse);
                document.location.reload();
            } else {
                console.log("probleme");
            }
        }
    }
    xhr.open("POST", "functions/functionUpdateStatus.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`status=${status}&idAppt=${idAppt}`);
 }
 