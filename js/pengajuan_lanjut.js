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

  // CEK PDF
  if (file.type !== "application/pdf") {
    errorEl.textContent = "File harus PDF!";
    input.value = "";
    checkForm();
    return;
  }

  // CEK SIZE
  if (file.size > maxSize) {
    errorEl.textContent = "Ukuran maksimal 2MB!";
    input.value = "";
    checkForm();
    return;
  }

  // Kalau valid
  document.getElementById(input.id + "Text").textContent = file.name;

infoEl.innerHTML = `
    <i class="fa-solid fa-pen" onclick="renameFile('${input.id}')"></i>
    <i class="fa-solid fa-trash" onclick="deleteFile('${input.id}')"></i>
`;


  checkForm();
}

function deleteFile(id) {
  const input = document.getElementById(id);
  const info = document.getElementById(id + "Info");
  const text = document.getElementById(id + "Text");

  input.value = "";
  info.innerHTML = "";
  text.textContent = "Upload File (PDF)";

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
