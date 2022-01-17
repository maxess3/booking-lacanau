// Menu
const chat = document.getElementById("inner-chat-menu");
const menu = document.querySelector(".list-chat-menu");
// Settings
const btnSettings = document.getElementById("settings");
const settings = document.getElementById("settings-container");
// Delete Booking
const btnDeleteMyBookings = document.getElementById("deleteMyBookings");

chat.addEventListener("click", () => {
    menu.classList.toggle("menu-open");
    let media = window.matchMedia("(max-width: 1200px)");
    if (!media.matches) {
        chat.classList.remove("animMenu");
        window.requestAnimationFrame(function() {
            chat.classList.add('animMenu');
        })
    }
})

window.addEventListener('click', ({ target }) => {
    const popup = target.closest('.list-chat-menu');
    if (!popup && target.id !== "inner-chat-menu") {
        menu.classList.remove("menu-open");
        menu.classList.add("menu-hide")
    }
    if (popup) {
        menu.classList.remove("menu-open");
    }
})

if (btnSettings) {
    btnSettings.addEventListener("click", () => {
        settings.classList.add("open-settings");
    })
}

if (settings) {
    settings.addEventListener("click", (e) => {
        if (settings.classList.contains("open-settings") && !e.target.closest("#form-settings")) {
            settings.classList.remove("open-settings");
        }
    })
}

if (btnDeleteMyBookings) {
    btnDeleteMyBookings.addEventListener("click", () => {
        clearTimeout(getBooking);
        let confirm = window.confirm("🚨 Voulez-vous supprimer toutes vos réservations ?");
        if (confirm === true) {
            let myUniqueCards = document.querySelectorAll(".unique-card-color");
            let cardsToDelete = [];
            myUniqueCards.forEach(el => {
                cardsToDelete.push(el.closest(".booking-card"));
            });
            if (cardsToDelete.length > 0 && typeof username !== undefined) {
                fetchDeletePersonalBookings(username, cardsToDelete);
            } else {
                contentMessage.textContent = "Suppression impossible, vous n'avez pas de réservations...";
                infoIcon.src = "assets/img/error.png";
                messageSuccess.classList.remove("message-ajax-anim");
                window.requestAnimationFrame(function() {
                    messageSuccess.classList.add('message-ajax-anim');
                })
                getBooking = setInterval(function() {
                    fetchBooking();
                }, 5000);
            }
        } else {
            getBooking = setInterval(function() {
                fetchBooking();
            }, 5000)
        }
    })
}