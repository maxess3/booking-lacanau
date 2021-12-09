function scrollToPendingList(element) {
    element.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

const bookingSuccess = document.querySelector(".booking-success");
const sectionPendingList = document.getElementById("pending-list");
if (bookingSuccess != undefined || bookingSuccess != null && sectionPendingList != undefined && sectionPendingList != null) {
    scrollToPendingList(sectionPendingList);
}