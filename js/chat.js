// Menu
const chat = document.getElementById("inner-chat-menu");
const menu = document.querySelector(".list-chat-menu");
// Settings
const btnSettings = document.getElementById("settings");
const settings = document.getElementById("settings-container");

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