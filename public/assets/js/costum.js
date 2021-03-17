document.addEventListener("DOMContentLoaded", function () {
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById("time").innerHTML = h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        } // add zero in front of numbers < 10
        return i;
    }

    function getDay() {
        var d = new Date();
        var n = d.toDateString();
        document.getElementById("date").innerHTML = n;
    }
    startTime();
    getDay();
});

if (document.getElementById("harga") == null) {
    console.log("kosong");
    var td = document.querySelectorAll("[id=ttd]");
    for (let index = 0; index < td.length; index++) {
        td[index].innerHTML = formatRupiah(td[index].innerHTML);
    }
} else {
    var rupiah = document.getElementById("harga");
    rupiah.addEventListener("keyup", function (e) {
        // tambahkan 'Rp.' pada saat ketik nominal di form kolom input
        // gunakan fungsi formatRupiah() untuk mengubah nominal angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value);
    });
    /* Fungsi formatRupiah */
}
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
    return prefix == undefined ? rupiah : rupiah ? +rupiah : "";
}
