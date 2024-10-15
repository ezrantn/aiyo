document.getElementById("registerButton").addEventListener("click", function (event) {
    event.preventDefault();

    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Setelah data dikirim, Anda tidak bisa mengubahnya lagi.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, saya mau mendaftar!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("overlay").style.display = "block";

            const formData = {
                "Nama Siswa": document.getElementById("memberName").value,
                Email: document.getElementById("memberEmail").value,
                "Nomor Telepon": document.getElementById("memberPhone").value,
                "Asal Sekolah": document.getElementById("memberSekolah").value,
                "Alasan Mendaftar": document.getElementById("memberAlasan").value,
                lokasi_sekolah: document.querySelector('input[name="lokasi_sekolah"]:checked').value,
            };

            fetch("register-process.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: new URLSearchParams(formData).toString(),
            })
                .then((response) => response.text())
                .then((data) => {
                    const [message, userId] = data.split("|");
                    if (!userId) throw new Error("No userId returned from register-process.php");

                    // Send to Google Sheets only if userId is valid
                    return fetch(
                        "https://script.google.com/macros/s/AKfycbxbqEww2tneBmCdLiXPRmbN5fm36Umg9mlQYSRgLYa1bJ6UWnrAzqNAjTKzEejsG74/exec",
                        {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: new URLSearchParams({
                                "Nama Siswa": formData["Nama Siswa"],
                                Email: formData["Email"],
                                "Nomor Telepon": formData["Nomor Telepon"],
                                "Asal Sekolah": formData["Asal Sekolah"],
                                "Alasan Mendaftar": formData["Alasan Mendaftar"],
                                userId: userId,
                            }).toString(),
                        }
                    ).then(() => userId);
                })
                .then((userId) => {
                    showAlert(userId);
                })
                .catch((error) => {
                    Swal.fire({
                        title: "Gagal!",
                        text: error.message,
                        icon: "error",
                    });
                })
                .finally(() => {
                    document.getElementById("overlay").style.display = "none";
                });
        }
    });
});

function showAlert(userId) {
  Swal.fire({
    title: "Warning",
    text: `Please keep the generated ID securely. You will need it later.`,
    icon: "warning",
    html: `
        <p>Please confirm that you have copied your ID.</p>
        <p style="font-weight: bold; font-size: 1.5em; color: #3085d6; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">${userId}</p>
        <input type="checkbox" id="confirmCheckbox">
        <label for="confirmCheckbox">I have copied the ID.</label>
      `,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    preConfirm: () => {
      const checkbox = document.getElementById("confirmCheckbox");
      if (!checkbox.checked) {
        Swal.showValidationMessage("You need to check the box to proceed!");
        return false;
      }
      return true;
    },
    didOpen: () => {
      const confirmButton = Swal.getConfirmButton();
      confirmButton.disabled = true;

      document
        .getElementById("confirmCheckbox")
        .addEventListener("change", function () {
          confirmButton.disabled = !this.checked;
        });
    },
  }).then((result) => {
    if (result.isConfirmed) {
      showToast("Registrasi Anda berhasil!");
    }
  });
}

function showToast(message) {
  Swal.fire({
    toast: true,
    position: "top-end",
    icon: "success",
    title: message,
    showCloseButton: true,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
}
