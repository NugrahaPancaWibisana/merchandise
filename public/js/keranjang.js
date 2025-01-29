// public/js/keranjang.js
function tambahKeKeranjang(idProduk) {
    fetch("/keranjang/tambah", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({
            id_produk: idProduk,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            document.querySelector(".keranjang-container").innerHTML =
                data.keranjangHtml;
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat menambahkan ke keranjang");
        });
}

function updateJumlah(idProduk, aksi) {
    fetch("/keranjang/update-jumlah", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({
            id_produk: idProduk,
            aksi: aksi,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            document.querySelector(".keranjang-container").innerHTML =
                data.keranjangHtml;
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat mengupdate jumlah");
        });
}

// Update keranjang saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
    fetch("/keranjang/ambil-keranjang")
        .then((response) => response.json())
        .then((data) => {
            document.querySelector(".keranjang-container").innerHTML =
                data.keranjangHtml;
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat memuat keranjang");
        });
});

// Fungsi untuk memformat angka ke format rupiah
function formatRupiah(angka) {
    return new Intl.NumberFormat("id-ID").format(angka);
}

// Fungsi untuk menghitung kembalian
function hitungKembalian() {
    const uangBayar = document.getElementById("uang_bayar").value;
    const totalBayar = document.querySelector(".total-bayar").dataset.total;

    if (uangBayar && totalBayar) {
        const kembalian = uangBayar - totalBayar;
        document.querySelector(".kembalian").textContent = `Rp ${formatRupiah(
            kembalian
        )}`;
    }
}

// Event listener untuk input uang bayar
document
    .getElementById("uang_bayar")
    ?.addEventListener("input", hitungKembalian);
