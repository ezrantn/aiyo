document
  .getElementById("registerButton")
  .addEventListener("click", function (event) {
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
          lokasi_sekolah: document.querySelector(
            'input[name="lokasi_sekolah"]:checked',
          ).value,
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
            if (!userId)
              throw new Error("No userId returned from register-process.php");

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
              },
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

function checkNusaputera() {
  const textBox = document.getElementById("memberSekolah");
  const radioButton1 = document.getElementById("dalam");
  const radioButton2 = document.getElementById("luar");
  let text = textBox.value;

  const regex =
    /\b(nusaputera|nusaputra|nusa putera|nusa putra|nusa_putera)\b/gi;

  // Check if the input contains a valid variation of "Nusaputera"
  if (regex.test(text)) {
    // Correct to "Nusaputera" and select the first radio button
    textBox.value = text.replace(regex, "Nusaputera");
    radioButton1.checked = true;
  } else {
    // Select the second radio button for other input
    radioButton2.checked = true;
  }
}

function formatPhoneNumberRegistration(input) {
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
