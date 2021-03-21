document.addEventListener("DOMContentLoaded", function () {
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById("time").innerHTML = h + ":" + m + ":" + s;
        document.getElementById("wkt").innerHTML = h + ":" + m + ":" + s;
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
        document.getElementById("tgl").innerHTML = d;
    }
    startTime();
    getDay();
    function formatDate(date) {
        var d = new Date(date),
            month = "" + (d.getMonth() + 1),
            day = "" + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = "0" + month;
        if (day.length < 2) day = "0" + day;

        return [year, month, day].join("-");
    }
    document.getElementById("tgl").innerHTML = formatDate(new Date());
    var total = document.querySelectorAll("#total");
    for (let i = 0; i < total.length; i++) {
        total[i].innerHTML = formatRupiah(total[i].innerHTML + "000", "Rp. ");
    }
    window.print();
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
window.addEventListener("afterprint", (event) => {
    console.log(event);
    // window.location.href = "/dashboard";
});
