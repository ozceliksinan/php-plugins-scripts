document.addEventListener(
    "wpcf7submit",
    function (event) {
        if (event.detail.status == "validation_failed") {
            Swal.fire({
                title: "",
                text: event.detail.apiResponse.message,
                width: cf7windowWidth,
                icon: "error",
                showCloseButton: true,
                timer: cf7simplePopupAutoClose,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const b = Swal.getHtmlContainer().querySelector("b");
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft();
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            });
        } else {
            Swal.fire({
                title: "",
                text: event.detail.apiResponse.message,
                width: cf7windowWidth,
                icon: "success",
                showCloseButton: true,
                timer: cf7simplePopupAutoClose,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const b = Swal.getHtmlContainer().querySelector("b");
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft();
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            });
        }
    },
    false
);