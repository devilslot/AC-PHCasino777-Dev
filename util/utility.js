function getConfirm(promoid) {
    swal.fire({
        title: 'สมาชิกจะรับโปรฯ หรือร่วมกิจกรรมได้หลังจากทำรายการฝากเข้ามาแล้วเท่านั้น',
        text: 'ตกลงรับโปรฯ นี้?',
        showCancelButton: true,
        type: 'warning',
        cancelButtonColor: '#d33',
    })
        .then((res) => {
            if (res.value) {
                console.log('confirmed : '+promoid);
                Swal.fire('สำเร็จ', 'ขอให้สนุกนะคะ', 'success');
//                return true;
            } else if (res.dismiss == 'cancel') {
                console.log('cancel');
//                return false;
            } else if (res.dismiss == 'esc') {
                console.log('cancle-esc**strong text**');
//                return false;
            }
        });
}



function getConfirmPromo(promoid,memberno) {
    swal
      .fire({
        title: "ยืนยัน",
        text: "คุณต้องการรับโบนัสooooooใช่หรือไม่ ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
      })
      .then((res) => {
        if (res.value) {
          console.log("confirmed : " + promoid);
          Swal.fire("ทำรายการสำเร็จ", "ขอให้สนุกนะคะ", "success");

        } else if (res.dismiss == "cancel") {
          console.log("cancel");
          Swal.fire("ทำรายการไม่สำเร็จ", "คุณไม่สามารถรับโปรฯ นี้ได้", "warning");
          //                return false;
        } else if (res.dismiss == "esc") {
          console.log("cancle-esc**strong text**");
          //                return false;
        }
      });
}

function setPromo(promoid,memberno) {
    console.log('promo : '+promoid);
    console.log('member_no : '+memberno);
    var mysql = require('mysql');

    var con = mysql.createConnection({
        host: "localhost",
        user: "dev01_usr",
        password: "4i5yH7ZWMO1zY35k",
        database: "dev01"
    });

    con.connect(function (err) {
        if (err) throw err;
        console.log("Connected!");
        var sql = "INSERT INTO customers (name, address) VALUES ('Company Inc', 'Highway 37')";
        con.query(sql, function (err, result) {
            if (err) throw err;
            console.log("1 record inserted");
        });
    });
}
