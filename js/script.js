const profile = document.querySelector(".profile-ctn");
if (profile != undefined || profile != null) {
    profile.addEventListener("click", () => {
        window.open("login.php", "_self");
    })
}

const getInfoStatusBtn = document.querySelectorAll(".update-time-status");
const msgStatus = document.querySelectorAll(".status-msg");
for (let i = 0; i < getInfoStatusBtn.length; i++) {
    getInfoStatusBtn[i].addEventListener("click", (e) => {
        msgStatus[i].classList.toggle("info-toggle");
    });
}

const bookingCard = document.getElementsByClassName("booking-card");
const deleteBooking = document.getElementsByClassName("delete-booking");
const messageSuccess = document.querySelector(".message-ajax");
const contentMessage = document.querySelector(".content-message-ajax");
const infoIcon = document.querySelector(".info-icon");
let serverResponse = null;
let confirm = null;
let xhr = null;
if (deleteBooking != undefined || deleteBooking != null) {
    for (let i = 0; i < deleteBooking.length; i++) {
        deleteBooking[i].onclick = function(e) {
            clearInterval(getBooking);
            if (messageSuccess !== undefined || messageSuccess !== null || contentMessage !== undefined || contentMessage !== null) {
                if (messageSuccess.classList.contains("message-ajax-anim")) {
                    e.preventDefault();
                    console.log("Patientez...");
                } else {
                    let confirm = window.confirm("Voulez-vous supprimer la réservation ?");
                    if (confirm) {
                        fetchDeleteBooking(this.parentNode.id, this.parentNode)
                    } else {
                        getBooking = setInterval(function() {
                            fetchBooking();
                        }, 5000)
                    }
                }
            }
        }
    }
}

function fetchDeleteBooking(id, deleteElement) {
    xhr = new XMLHttpRequest();
    xhr.onload = function() {
        serverResponse = this.responseText;
        if (infoIcon !== undefined || infoIcon !== null) {
            if (serverResponse === "success") {
                contentMessage.textContent = "La réservation a bien été supprimée";
                infoIcon.src = "assets/img/valid.png";
                messageSuccess.classList.add("message-ajax-anim");
                for (let i = 0; i < deleteBooking.length; i++) {
                    deleteBooking[i].style.opacity = "0.2";
                    deleteBooking[i].style.cursor = "not-allowed";
                }
                window.setTimeout(function() {
                    messageSuccess.classList.remove("message-ajax-anim");
                    for (let i = 0; i < deleteBooking.length; i++) {
                        deleteBooking[i].style.opacity = "0.9";
                        deleteBooking[i].style.cursor = "pointer";
                    }
                    deleteElement.remove();
                    getBooking = window.setInterval(function() {
                        fetchBooking();
                    }, 5000)
                }, 4500);
            } else {
                contentMessage.textContent = "Un problème est survenu dans la suppression de la réservation";
                infoIcon.src = "assets/img/error.png";
            }
        }
    }

    xhr.open("POST", "functions/functionDeleteBooking.php")
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`deleteBooking=${id}`);
}

const listBookingInner = document.querySelector(".list-booking-inner");

function fetchBooking() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = xhttp.responseText;
            listBookingInner.innerHTML = response;
            setTimeout(function() { addeventatc.refresh(); }, 200);
            const getInfoStatusBtn = document.querySelectorAll(".update-time-status");
            const msgStatus = document.querySelectorAll(".status-msg");
            for (let i = 0; i < getInfoStatusBtn.length; i++) {
                getInfoStatusBtn[i].addEventListener("click", () => {
                    msgStatus[i].classList.toggle("info-toggle");
                });
            }
            if (deleteBooking != undefined || deleteBooking != null) {
                for (let i = 0; i < deleteBooking.length; i++) {
                    deleteBooking[i].onclick = function(e) {
                        clearInterval(getBooking)
                        if (messageSuccess !== undefined || messageSuccess !== null || contentMessage !== undefined || contentMessage !== null) {
                            if (messageSuccess.classList.contains("message-ajax-anim")) {
                                e.preventDefault();
                                console.log("Patientez...");
                            } else {
                                let confirm = window.confirm("Voulez-vous supprimer la réservation ?");
                                if (confirm) {
                                    fetchDeleteBooking(this.parentNode.id, this.parentNode)
                                } else {
                                    getBooking = setInterval(function() {
                                        fetchBooking();
                                    }, 5000)
                                }
                            }
                        }
                    }
                }
            }
        }
    };
    xhttp.open("GET", "functions/functionGetBooking.php", true);
    xhttp.send();
}

let getBooking = setInterval(function() {
    fetchBooking();
}, 5000);