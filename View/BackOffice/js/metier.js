document.getElementById('search1').addEventListener('input', function () {
  var td = this.value.toLowerCase();  // Convertir en minuscules
  var rows = document.querySelectorAll('#tbody1 tr');

  rows.forEach(row => {
      var text = row.innerText.toLowerCase();
      row.style.display = text.includes(td) ? '' : 'none';
  });
});

document.getElementById('search2').addEventListener('input', function () {
  var td = this.value.toLowerCase();  // Convertir en minuscules
  var rows = document.querySelectorAll('#tbody2 tr');

  rows.forEach(row => {
      var text = row.innerText.toLowerCase();
      row.style.display = text.includes(td) ? '' : 'none';
  });
});

function sortTable1() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("tbody1");
    switching = true;
    while (switching) {
      switching = false;
      rows = table.rows;
      for (i = 0 ; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[4];
        y = rows[i + 1].getElementsByTagName("TD")[4];
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  }
  function sortTable2() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("tbody2");
    switching = true;
    while (switching) {
      switching = false;
      rows = table.rows;
      for (i = 0; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[1];
        y = rows[i + 1].getElementsByTagName("TD")[1];
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  }