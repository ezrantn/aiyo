document
  .getElementById("registerButton")
  .addEventListener("click", function (event) {
    event.preventDefault();

    document.getElementById("overlay").style.display = "block";

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
        const formData = {
          "Nama Siswa": document.getElementById("memberName").value,
          Email: document.getElementById("memberEmail").value,
          "Nomor Telepon": document.getElementById("memberPhone").value,
          "Asal Sekolah": document.getElementById("memberSekolah").value,
          "Alasan Mendaftar": document.getElementById("memberAlasan").value,
        };

        fetch("submit_pendaftaran.php", {
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
              throw new Error("No userId returned from submit_pendaftaran.php");

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
            }).then(() => {
              document.getElementById("overlay").style.display = "none";
            });
          });
      } else {
        document.getElementById("overlay").style.display = "none";
      }
    });
  });

function showAlert(userId) {
  document.getElementById("overlay").style.display = "block";

  Swal.fire({
    title: "Warning",
    text: `Please keep the generated ID securely. You will need it later.\n${userId}`,
    icon: "warning",
    html: `
        <p>Please confirm that you have copied your ID.</p>
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
    willClose: () => {
      document.getElementById("overlay").style.display = "none";
    },
  });
}
