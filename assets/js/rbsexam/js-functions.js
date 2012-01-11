var totalRow = 0

document.onload = function()
{
    document.getElementById('jsMessage').innerHTML = 'abc';
}

function confirmDeletion()
{
    return confirm("Do you want to delete really?");
}

function searchBy(url, commonId)
{
    document.getElementById('jsMessage').innerHTML = 'abc';
    var link = "'" + url + '/'+ commonId + "'";
    
    location = link;
    
}

function addElement(element)
{
    element.removeAttribute('onclick');
    element.setAttribute('onclick', ' return deleteElement(this)');
    element.innerHTML = "Remove";
    addLastElement();
    return false;
}

function addLastElement()
{
    var tableName = document.getElementById('choice-table');
    totalRow = totalRow + 1;
    var rowCount = tableName.rows.length;
    var newRow = tableName.insertRow(rowCount);
    newRow.setAttribute('class', 'choice-row');
    newRow.setAttribute('id', 'rbs'+ totalRow);

    var cell1 = newRow.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = 'text';
    element1.name='choice[]';
    element1.setAttribute('class', 'text large');
    cell1.appendChild(element1);

    var cell2 = newRow.insertCell(1);
    var element2 = document.createElement("input");
    element2.type = 'checkbox';
    element2.name='right[]';
    element2.setAttribute('class', 'checkbox');
    cell2.appendChild(element2);

    var cell3 = newRow.insertCell(2);
    var element3 = document.createElement("a");
    element3.setAttribute('href', '');
    element3.setAttribute('onclick', 'return addElement(this)');
    element3.innerHTML = 'Add More';
    cell3.appendChild(element3);
            
    return false;
}

function deleteElement(element)
{
    var table = document.getElementById('choice-table');
    var tableRow = element.parentNode.parentNode;
    table.deleteRow(tableRow.rowIndex);

    return false;
}

function nav()
   {  
   window.location.href = document.getElementById('moduleID').value;   
   }
