<?php
include("config.php");

$stmt = $conn->prepare(
    "SELECT 
        CT.Ma_bo_sat,
        CT.Ma_gio_hang,
        CT.So_luong,
        BS.Ten_bo_sat,
        BS.Gia,
        BS.Mo_ta,
        BS.Ngay_nhap,
        BS.Ma_danh_muc,
        A.Ma_anh,
        A.Duong_dan_anh
    FROM CHI_TIET_GIO_HANG CT
    JOIN BO_SAT BS ON BS.Ma_bo_sat = CT.Ma_bo_sat
    LEFT JOIN ANH A ON A.Ma_bo_sat = CT.Ma_bo_sat AND A.Ma_anh = 1  -- Giả sử Ma_anh = 1 là ảnh đại diện
    WHERE CT.Ma_gio_hang = ?"
);
$stmt->execute([1]);  // Giỏ hàng có Ma_gio_hang = 1

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    print_r($row);  // Hiển thị thông tin sản phẩm và ảnh đại diện
    echo "<br>";
}
?>