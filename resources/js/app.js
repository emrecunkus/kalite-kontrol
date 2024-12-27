document.addEventListener('DOMContentLoaded', function () {
  const fileInputs = document.querySelectorAll('.upload-field'); // Tüm dosya yükleme alanlarını seç

  fileInputs.forEach(fileInput => {
      fileInput.addEventListener('change', function () {
          if (this.files.length > 0) {
              this.classList.add('file-uploaded');
              console.log("dosya yüklendi");
          } else {
              this.classList.remove('file-uploaded');
              console.log("dosya yüklenemedi");
          }
      });
  });
});

