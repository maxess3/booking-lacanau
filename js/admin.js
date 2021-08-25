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
        if(targetClassList.contains("accepted")){
            console.log(target.parentNode.parentNode.parentNode.dataset.appartment)
        } else if(targetClassList.contains("pending")){
            console.log("pending");
        } else if(targetClassList.contains("rejected")){
            console.log("rejected");
        } else {
            console.log("problème...");
        }
    });
};