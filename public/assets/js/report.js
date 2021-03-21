document.addEventListener("DOMContentLoaded", function () {
    var harian = document.querySelectorAll("#ttlHr");
    var arr = [];
    if (harian.length < 1) {
        console.log("aw");
    } else {
        for (let i = 0; i < harian.length; i++) {
            var re = harian[i].innerHTML.replace("Rp. ", "");
            arr.push(parseInt(re));
        }
        var total = arr.reduce((a, b) => a + b, 0);
        var str = total.toString() + "000";
        document.getElementById("total").innerHTML = formatRupiah(str, "Rp. ");
    }
    var bulanan = document.getElementById("bulanan").innerHTML + "000";
    document.getElementById("bulanan").innerHTML = formatRupiah(
        bulanan,
        "Rp. "
    );
});
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }
    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}
