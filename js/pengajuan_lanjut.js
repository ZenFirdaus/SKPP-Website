const slip = document.getElementById("slip");
const sk = document.getElementById("sk");
const surat = document.getElementById("surat");
const submitBtn = document.getElementById("submitBtn");

function checkForm() {
    if (slip.files.length && sk.files.length && surat.files.length) {
    submitBtn.disabled = false;
  } else {
    submitBtn.disabled = true;
  }
}

function saveData() {
  const max = 2 * 1024 * 1024;

  // CEK FORMAT PDF
  if (!isPDF(slip.files[0]) || !isPDF(sk.files[0]) || !isPDF(surat.files[0])) {
    alert("File harus berformat PDF!");
    return;
  }

  // CEK UKURAN
  if (
    slip.files[0].size > max ||
    sk.files[0].size > max ||
    surat.files[0].size > max
  ) {
    alert("Ukuran maksimal 2MB!");
    return;
  }

  const data = {
    slip: slip.files[0].name,
    sk: sk.files[0].name,
    surat: surat.files[0].name,
    date: new Date().toLocaleString(),
  };

  let list = JSON.parse(localStorage.getItem("pengajuan")) || [];
  list.push(data);
  localStorage.setItem("pengajuan", JSON.stringify(list));

  showHistory();
  showModal();

  slip.value = "";
  sk.value = "";
  surat.value = "";
  submitBtn.disabled = true;
}

function showHistory() {
  const container = document.getElementById("history");
  container.innerHTML = "";
  let list = JSON.parse(localStorage.getItem("pengajuan")) || [];

  list.forEach((item, index) => {
    container.innerHTML += `
        <div class="history-item">
            <div>${item.date}</div>
            <i class="fa-solid fa-trash delete" onclick="deleteData(${index})"></i>
        </div>`;
  });
}

function deleteData(index) {
  let list = JSON.parse(localStorage.getItem("pengajuan")) || [];
  list.splice(index, 1);
  localStorage.setItem("pengajuan", JSON.stringify(list));
  showHistory();
}

function showModal() {
  const modal = document.getElementById("successModal");
  modal.style.display = "flex";
  setTimeout(() => {
    modal.style.display = "none";
  }, 2000);
}

function isPDF(file) {
  return file.type === "application/pdf";
}

const maxSize = 2 * 1024 * 1024;

function validateFile(input, errorEl, infoEl) {
    const file = input.files[0];
    errorEl.textContent = "";
    infoEl.innerHTML = "";

    if (!file) {
        checkForm();
        return;
    }

  // Validasi Format
    if (file.type !== "application/pdf") {
        errorEl.textContent = "File harus PDF!";
        input.value = "";
        checkForm();
        return;
    }

  // Validasi Ukuran
    if (file.size > 2 * 1024 * 1024) {
        errorEl.textContent = "Ukuran maksimal 2MB!";
        input.value = "";
        checkForm();
        return;
    }

  // Jika Valid, munculkan info file dan tombol hapus
    infoEl.innerHTML = `
        <div class="file-name-container" style="display:flex; justify-content:space-between; align-items:center; margin-top:5px; background:#eef; padding:5px 10px; border-radius:5px;">
            <span style="font-size:12px; color:#333;">${file.name}</span>
            <i class="fa-solid fa-trash" style="color:red; cursor:pointer;" onclick="deleteFile('${input.id}')"></i>
        </div>
    `;

    checkForm();
}

function deleteFile(id) {
    const input = document.getElementById(id);
    const info = document.getElementById(id + "Info");
    input.value = "";
    info.innerHTML = "";
    checkForm();
}


function renameFile(id) {
  const input = document.getElementById(id);
  const info = document.getElementById(id + "Info");

  const newName = prompt("Masukkan nama baru (tanpa .pdf)");

  if (newName) {
    info.querySelector("span").textContent = newName + ".pdf";
  }
}

slip.addEventListener("change", () => validateFile(slip, document.getElementById("slipError"), document.getElementById("slipInfo")));
sk.addEventListener("change", () => validateFile(sk, document.getElementById("skError"), document.getElementById("skInfo")));
surat.addEventListener("change", () => validateFile(surat, document.getElementById("suratError"), document.getElementById("suratInfo")));

slip.addEventListener("change", () => {
  validateFile(
    slip,
    document.getElementById("slipError"),
    document.getElementById("slipInfo"),
  );
});

sk.addEventListener("change", () => {
  validateFile(
    sk,
    document.getElementById("skError"),
    document.getElementById("skInfo"),
  );
});

surat.addEventListener("change", () => {
  validateFile(
    surat,
    document.getElementById("suratError"),
    document.getElementById("suratInfo"),
  );
});

function checkForm() {
  if (slip.files.length && sk.files.length && surat.files.length) {
    submitBtn.disabled = false;
  } else {
    submitBtn.disabled = true;
  }
}

showHistory();
