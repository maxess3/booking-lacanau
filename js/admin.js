const btnIndex = document.querySelector(".backToIndex");
if(btnIndex != undefined || btnIndex != null){
    btnIndex.addEventListener("click", () => {
        window.open("index.php","_self");
    })
};