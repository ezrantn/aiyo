function formatPhoneNumber(input) {
  let value = input.value.replace(/\D/g, "");

  if (value.length > 3 && value.length <= 6) {
    value = value.slice(0, 3) + "-" + value.slice(3);
  } else if (value.length > 6 && value.length <= 9) {
    value = value.slice(0, 3) + "-" + value.slice(3, 6) + "-" + value.slice(6);
  } else if (value.length > 9) {
    value =
      value.slice(0, 3) +
      "-" +
      value.slice(3, 6) +
      "-" +
      value.slice(6, 9) +
      "-" +
      value.slice(9);
  }

  input.value = value;
}

document.getElementById("submitButton").addEventListener("click", function () {
  Swal.fire({
    title: "Apakah Anda yakin?",
    text: "Setelah data dikirim, Anda tidak bisa mengubahnya lagi.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, Pesan Sekarang!",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById("ticketForm").submit();
    }
  });
});

if ("serviceWorker" in navigator) {
  window.addEventListener("load", () => {
    navigator.serviceWorker
      .register("/goldenphoenix/service-worker.js")
      .then((registration) => {
        console.log("ServiceWorker registration successful:", registration);
      })
      .catch((error) => {
        console.error("ServiceWorker registration failed:", error);
      });
  });
}

document.getElementById("category").addEventListener("change", function () {
  var amountField = document.getElementById("amount");
  if (this.value === "external") {
    amountField.value = 150000;
  } else {
    amountField.value = 100000;
  }
});

document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('[data-collapse-toggle="navbar-default"]');
    const navMenu = document.getElementById('navbar-default');

    hamburger.addEventListener('click', function() {
        navMenu.classList.toggle('hidden');
        navMenu.classList.toggle('block');
    });
});
