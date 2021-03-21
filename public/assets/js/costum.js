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
    var ttl = document.querySelectorAll("#ttd");

    if (ttl.length > 1) {
        for (let index = 0; index < ttl.length; index++) {
            ttl[index].innerText = formatRupiah(
                ttl[index].innerText + "000",
                "Rp. "
            );
        }
        var xq = [];
        for (let index = 0; index < ttl.length; index++) {
            var re = ttl[index].innerText.replace("Rp. ", "");
            xq.push(parseInt(re));
        }
        var total = xq.reduce((a, b) => a + b, 0);
        var str = total.toString() + "000";
        document.getElementById("total").innerText = formatRupiah(str, "Rp.");
        document.getElementById("totalread").value = formatRupiah(str, "Rp. ");
        document.getElementById("totalread1").value = formatRupiah(str, "Rp. ");
    } else {
        var tesas = ttl[0].innerText + "000";
        ttl[0].innerText = formatRupiah(tesas, "Rp. ");
        document.getElementById("total").innerText = formatRupiah(
            tesas,
            "Rp. "
        );
        document.getElementById("totalread").value = formatRupiah(
            tesas,
            "Rp. "
        );
        document.getElementById("totalread1").value = formatRupiah(
            tesas,
            "Rp. "
        );
    }
});

var rupiah = document.getElementById("harga");
rupiah.addEventListener("keyup", function (e) {
    // tambahkan 'Rp.' pada saat ketik nominal di form kolom input
    // gunakan fungsi formatRupiah() untuk mengubah nominal angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value);
});
/* Fungsi formatRupiah */

function sumKem() {
    var tunai = document.getElementsByName("tunai")[0];
    var kembalian = document.getElementsByName("kembalian")[0];
    var total = document.getElementById("totalread").value;
    var re = total.replace("Rp.", "");
    var x = tunai.value.replace(".", "") - re.replace(".", "");
    if (x > 0) {
        kembalian.value = formatRupiah(x.toString(), "Rp. ");
    } else {
        kembalian.value = 0;
    }
}
