const ul = document.getElementById("names");
let currentIndex = 0;
let interval;
let scrollDirection = 1; // 1 untuk scroll ke bawah
let names = [];
let namapilihan = [];
const progressVisual = document.querySelector(".progress-visual");
let isDragging = false; // Status drag
let startY = 0; // Posisi Y awal
let stts = "";
let pilihanSusah = false;
let delay = 10; 
const delayNormal = 10;

async function fetchChoiceNames() {
    try {
        const response = await fetch("http://localhost:8000/api/names"); // Ganti dengan URL API Anda
        const data = await response.json();
        namapilihan = data.names_choice; // Ambil nama dari respons API
        console.log(namapilihan);
    } catch (error) {
        console.error("Error fetching names:", error);
    }
}
fetchChoiceNames();

function getLiHeight() {
    const li = ul.querySelector("li");
    return li ? li.offsetHeight : 0;
}

function getContainerHeight() {
    const container = document.querySelector(".container");
    return container ? container.offsetHeight : 0;
}

function populateNames() {
    ul.innerHTML = names.map((name) => `<li>${name}</li>`).join("");
    updateVisual();
}

function updateVisual() {
    const liElements = ul.querySelectorAll("li");
    liElements.forEach((li, i) => {
        li.classList.remove("center", "small");
        if (i === currentIndex) {
            li.classList.add("center"); // Nama yang terfokus
        } else {
            li.classList.add("small"); // Nama yang tidak terfokus
        }
    });
}

function scrollNames() {
    const liHeight = getLiHeight();
    const containerHeight = getContainerHeight();
    const centerOffset = (containerHeight - liHeight) / 2; // Menghitung offset untuk membuat nama di tengah

    let translateY = -currentIndex * liHeight + centerOffset; // Menempatkan nama terpilih di tengah

    // Membatasi pergerakan pada batas atas dan bawah
    if (translateY < -(names.length - 1) * liHeight + centerOffset) {
        translateY = -(names.length - 1) * liHeight + centerOffset;
    } else if (translateY > centerOffset) {
        translateY = centerOffset;
    }

    ul.style.transform = `translateY(${translateY}px)`; // Scroll nama
    updateVisual(); // Perbarui visual nama

    // Perbarui tinggi visual progress
    const progressVisual = document.querySelector(".progress-visual");
    const progressHeight = ((currentIndex + 1) / names.length) * 100; // Hitung tinggi progres
    progressVisual.style.height = `${progressHeight}%`; // Atur tinggi elemen visual
}

progressVisual.addEventListener("mousedown", (event) => {
    isDragging = true; // Set status drag menjadi true
    startY = event.clientY; // Simpan posisi Y saat mouse ditekan
    event.preventDefault(); // Mencegah pemilihan teks
});

// Mendengarkan pergerakan mouse ketika dragging
document.addEventListener("mousemove", (event) => {
    if (!isDragging) return; // Jika tidak dalam status drag, keluar dari fungsi

    const container = document.querySelector(".container");
    const containerRect = container.getBoundingClientRect(); // Ambil informasi posisi kontainer
    const containerHeight = containerRect.height; // Tinggi kontainer
    const offsetY = event.clientY - containerRect.top; // Hitung offset Y dalam kontainer
    const percentage = offsetY / containerHeight; // Hitung persentase posisi

    // Batasi persentase dalam rentang 0 hingga 1
    if (percentage < 0) {
        currentIndex = 0; // Jika di atas, set ke 0
    } else if (percentage > 1) {
        currentIndex = names.length - 1; // Jika di bawah, set ke nama terakhir
    } else {
        currentIndex = Math.floor(percentage * names.length); // Hitung currentIndex
    }

    scrollNames(); // Perbarui tampilan scroll
});

// Mendengarkan saat mouse dilepaskan
document.addEventListener("mouseup", () => {
    isDragging = false; // Set status drag menjadi false
});

// Agar mouse keluar dari area kontainer tetap memperhitungkan drag
progressVisual.addEventListener("mouseleave", () => {
    isDragging = true; // Set status drag menjadi false
});

// Tombol aksi
document.getElementById("startBtn").addEventListener("click", startScrolling);

// Inisialisasi
fetchNames();

function startScrolling() {
    clearInterval(interval);
    intervalStart = setInterval(() => {
        currentIndex += scrollDirection;

        if (currentIndex >= names.length - 1) {
            currentIndex = names.length - 1;
            scrollDirection = -1;
            stopScrolling();
            clearInterval(intervalStart);
        } else if (currentIndex < 0) {
            currentIndex = 0;
            scrollDirection = 1;
        }

        scrollNames();
    }, delayNormal); // Kecepatan scroll
}

function showPopup(title, content) {
    const popup = document.getElementById("popupNotification");
    const popupTitle = document.getElementById("popupTitle");
    const popupContent = document.getElementById("popupContent");

    popupTitle.textContent = title; // Set judul popup
    popupContent.textContent = content; // Set konten popup
    window.location.hash = "popupNotification";
    
    // Tambahkan event listener untuk menutup popup ketika tombol close ditekan
    document.querySelector(".close").addEventListener("click", function(event) {
        event.preventDefault(); // Mencegah href "#" berfungsi
        window.location.hash = ""; // Sembunyikan popup
    });
}

let cnt = 0;

function stopScrolling() {
    
    let choice = namapilihan[cnt];
    const targetIndex = names.indexOf(choice);
    if (currentIndex >= targetIndex && targetIndex >= names.length / 2){
        pilihanSusah = true;
    }

    const scrollStep = () => {
       let stepsToTarget1 = Math.abs(currentIndex - targetIndex);
        // Jika langkah tersisa 17 atau kurang, tambahkan delay
        if (stepsToTarget1 <= 17) {
            clearInterval(intervalStop);
            delay = delay + 40; // Tambah delay
            startScrollingInterval();
        } else if (stepsToTarget1 > 17 && delay !== delayNormal) {
            clearInterval(intervalStop);
            delay = delayNormal; // Kembali ke delay default
            startScrollingInterval();
        }

        // Perbarui currentIndex
        if (currentIndex > targetIndex) {
            currentIndex--; // Kurangi currentIndex
        } else if (currentIndex < targetIndex) {
            currentIndex++; // Tambah currentIndex
        }

        scrollNames(); // Perbarui tampilan

        // Jika currentIndex mencapai targetIndex, hentikan interval
        if (currentIndex === targetIndex) {
            cnt = (cnt + 1) % namapilihan.length; // Pastikan cnt tidak keluar dari batas
            showPopup("Selamat",""+choice+" anda terpilih!");
            pilihanSusah = false;
            clearInterval(intervalStop); // Hentikan interval setelah mencapai targetIndex
        }
    };

    const startScrollingInterval = () => {
        intervalStop = setInterval(scrollStep, delay);
    };

    if (currentIndex >= targetIndex && targetIndex >= names.length / 2) {
        console.log("pilihan susah :"+pilihanSusah);
        interval1 = setInterval(() => {
            // arah scroll ke atas
            scrollDirection = -1;
            currentIndex += scrollDirection;
            scrollNames();

            // jika posisi sudah diatas cari target
            if (currentIndex <= 0) {
                console.log("pencarian target susah dimulai!");
                pilihanSusah = false;
                stopScrolling();
                clearInterval(interval1);
            }
        }, delayNormal);
    }

    

    // Mulai interval pertama kali
    if (pilihanSusah == false) {
        startScrollingInterval();
    }
}

async function fetchNames() {
    try {
        const response = await fetch("http://localhost:8000/api/names"); // Ganti dengan URL API Anda
        const data = await response.json();
        names = data.names;
        namapilihan = data.names_choice; // Ambil nama dari respons API
        populateNames(); // Panggil fungsi untuk menampilkan nama
        document.getElementById("totalCount").textContent = names.length;
    } catch (error) {
        console.error("Error fetching names:", error);
    }
}

// Fungsi untuk menangani scroll mouse di dalam container
const container = document.querySelector(".container");
container.addEventListener("wheel", (event) => {
    event.preventDefault(); // Mencegah scroll halaman
    currentIndex += event.deltaY > 0 ? 1 : -1; // Ubah indeks berdasarkan arah scroll
    // Batasi nilai currentIndex
    if (currentIndex < 0) {
        currentIndex = 0;
    } else if (currentIndex >= names.length) {
        currentIndex = names.length - 1;
    }
    scrollNames(); // Perbarui tampilan
});

// Tombol aksi
document.getElementById("startBtn").addEventListener("click", startScrolling);

// Inisialisasi

fetchNames();
