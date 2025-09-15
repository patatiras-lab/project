function bookTime(button) {
  const row = button.closest("tr");
  const time = row.cells[0].innerText;
  const date = document.getElementById("bookingDate").value;
  const fieldType = document.getElementById("fieldType").value;

  if (!date) {
    alert("กรุณาเลือกวันที่ก่อนจอง");
    return;
  }

  alert(`คุณได้จองสนามเวลา ${time} ในวันที่ ${date} (${fieldType})`);
  // จากตรงนี้สามารถส่งข้อมูลไปยัง backend ได้
}