// Getting references to the button and modal
var showModalButton = document.getElementById("addTask");
var closeModalButton = document.getElementById("closeModalButton");
var modal = document.getElementById("taskDiv");

// Showing the modal when the button is clicked
showModalButton.addEventListener("click", function() {
    modal.style.display = "block";
});

// Closing the modal when the close button is clicked
closeModalButton.addEventListener("click", function() {
    modal.style.display = "none";
});

// Closing the modal if the user clicks outside of it (optional)
window.addEventListener("click", function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
});
