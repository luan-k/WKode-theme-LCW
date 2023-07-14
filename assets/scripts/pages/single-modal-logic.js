// Wait for the DOM to be ready
document.addEventListener("DOMContentLoaded", function () {
  // Get the modal element
  let modal = document.getElementById("myModal");

  // Get the button that opens the modal
  let openModalBtn = document.getElementById("openModalBtn");
  let openModalBtns = document.querySelectorAll(".openModalBtn");

  if (modal) {
    // Get the <span> element that closes the modal
    let closeBtn = modal.querySelector(".close");

    if (modal && openModalBtn && closeBtn) {
      // Function to toggle the modal and body classes
      function toggleModal() {
        modal.classList.toggle("modal-active");
        document.body.classList.toggle("modal-open");
      }

      // Event listener for the open modal button
      openModalBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default link behavior
        toggleModal();
      });

      // Event listener for the close button
      closeBtn.addEventListener("click", toggleModal);

      // Event listener for clicks outside the modal to close it
      window.addEventListener("click", function (event) {
        if (event.target === modal) {
          toggleModal();
        }
      });

      // Event listener for clicks on the body to remove modal function
      document.body.addEventListener("click", function (event) {
        if (event.target !== openModalBtn && !modal.contains(event.target)) {
          modal.classList.remove("modal-active");
          document.body.classList.remove("modal-open");
        }
      });
    }
  }
});

document.addEventListener("DOMContentLoaded", function () {
  // Get the modal element
  let modal = document.getElementById("myModalConsorcio");

  // Get the button that opens the modal
  let openModalBtns = document.querySelectorAll(".openModalBtnConsorcio");

  if (modal) {
    // Get the <span> element that closes the modal
    let closeBtn = modal.querySelector(".closeConsorcio");

    if (openModalBtns.length > 0 && closeBtn) {
      // Function to toggle the modal and body classes
      function toggleModal() {
        modal.classList.toggle("modal-active");
        document.body.classList.toggle("modal-open");
      }

      // Event listener for each open modal button
      openModalBtns.forEach(function (btn) {
        btn.addEventListener("click", function (event) {
          event.preventDefault(); // Prevent the default link behavior
          toggleModal();
        });
      });

      // Event listener for the close button
      closeBtn.addEventListener("click", toggleModal);

      // Event listener for clicks outside the modal to close it
      window.addEventListener("click", function (event) {
        if (event.target === modal) {
          toggleModal();
        }
      });

      // Event listener for clicks on the body to remove modal function
      document.body.addEventListener("click", function (event) {
        let isButtonClick = false;

        for (let i = 0; i < openModalBtns.length; i++) {
          if (
            event.target === openModalBtns[i] ||
            openModalBtns[i].contains(event.target)
          ) {
            isButtonClick = true;
            break;
          }
        }

        if (!isButtonClick && !modal.contains(event.target)) {
          modal.classList.remove("modal-active");
          document.body.classList.remove("modal-open");
        }
      });
    }
  }
});
