function makeSublist(parent,child,isSubselectOptional,childVal)
{
    var relation = parent+child;
    $("body").append("<select style='display:none' id='"+relation+"'></select>");
    $('#'+relation).html($("#"+child+" option"));

    var parentValue = $('#'+parent).attr('value');
    $('#'+child).html($("#"+relation+" .sub_"+parentValue).clone());

    childVal = (typeof childVal == "undefined")? "" : childVal ;
    $("#"+child).val(childVal).attr('selected','selected');

    $('#'+parent).change(function(){
        var parentValue = $('#'+parent).attr('value');
        $('#'+child).html($("#"+relation+" .sub_"+parentValue).clone());
        if(isSubselectOptional) $('#'+child).prepend("<option value='' selected='selected'> -- Select -- </option>");
        $('#'+child).trigger("change");
        $('#'+child).focus();
    });

    if(selectedDistrict != 0)
        updateSelectBoxes("#child", selectedDistrict);
    if(selectedUpazilla != 0)
        updateSelectBoxes("#grandson", selectedUpazilla);
//    if(selectedFacility != 0)
//        updateSelectBoxes("#grandgrandson", selectedFacility);
}

function updateSelectBoxes(targetSelectElement, selectedValue)
{
    $(targetSelectElement).children().each(function(){
        var selectedItemValue = $(this).val();
        if (selectedItemValue == selectedValue) {
            $(this).attr("selected", "selected");
        }
    });
}

$(document).ready(function()
{
    //if(selectedFacility != 0)
        makeSublist('grandson','grandgrandson', true, '1');
    //if(selectedUpazilla != 0)
        makeSublist('child','grandson', true, '1');
    //if(selectedDistrict != 0)
        makeSublist('parent','child', true, '1');
});

