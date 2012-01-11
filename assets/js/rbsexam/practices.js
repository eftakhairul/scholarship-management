//function addElement()
//{
//    try {
//        var tableName = document.getElementById('choice-table');
//        document.getElementById('newRow').innerHTML = tableName;
//        var newRow = document.getElementById('newRow');
//
//        var newColumns = "<td><input type='text' name='choice[]' class='text large' /></td>" +
//                     "<td><input type='checkbox' class='checkbox' name='right[]' /></td>" +
//                     "<td><a href='' onclick='return addElement()'>Add More</a></td>";
//
//        newRow.innerHTML = newColumns;
//        newRow.removeAttribute('id');
//        newRow.setAttribute('class', 'choice-row');
//
//        newRow = tableName.insertRow(tableName.rowCount-1);
//        newRow.appendChild(newColumns);
//        newRow.setAttribute('id', 'choice-rowsss');
//        newRow.innerHTML = "<td colspan='3'>HI THERE</td>";
//        tableName.appendChild(newRow);
//        return false;
//    }
//    catch (excp){
//        return false;
//    }
//}
//
//function removeElement(divNum) {
//    var d = document.getElementById('myDiv');
//    var olddiv = document.getElementById(divNum);
//    d.removeChild(olddiv);
//}
//
//function addRowInTable(tableName)
//{
//    newChild = "<tr id='newRow'></tr>";
//    tableName.appendChild(newChild);
//}