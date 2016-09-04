/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$( document ).ready(function() {
  
    var currencyFromOb  = $("[name='form[currencyFrom]']");
    var currencyToOb    = $("[name='form[currencyTo]']");
    var currencyFromVal = "";
    var currencyToVal   = "";
    var elemToRestore   = "";
  
    function removeSelectedCode(elemToDelete) 
    {   
//        if (elemToRestore.length > 0) {
//            currencyToOb.append($("<option></option>").attr("value", elemToRestore).text(elemToRestore));
//        }
        if (elemToRestore.length > 0 && elemToRestore !== elemToDelete) {
            currencyToOb.find('option[value='+elemToRestore+']').remove();
            addOptionToSelectBox(currencyToOb[0], elemToRestore, elemToRestore, false);
        }
        currencyToOb.find('option[value='+elemToDelete+']').remove();
        elemToRestore = elemToDelete;
    }
    
    function sortSelectOptions(selector, skip_first) 
    {
        var options = (skip_first) ? $(selector + ' option:not(:first)') : $(selector + ' option');
        var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value, s: $(o).prop('selected') }; }).get();
        arr.sort(function(o1, o2) {
          var t1 = o1.t.toLowerCase(), t2 = o2.t.toLowerCase();
          return t1 > t2 ? 1 : t1 < t2 ? -1 : 0;
        }); 
        options.each(function(i, o) {
            o.value = arr[i].v;
            $(o).text(arr[i].t);
            if (arr[i].s) {
                $(o).attr('selected', 'selected').prop('selected', true);
            } else {
                $(o).removeAttr('selected');
                $(o).prop('selected', false);
            }
        });
    }
    
    function addOptionToSelectBox(selectBox, optionId, optionText, selectIt)
    {
        var option = document.createElement("option");
        option.value = optionId;
        option.text = optionText;
        selectBox.options[selectBox.options.length] = option;
        if (selectIt) {
            option.selected = true;
        }
    }
    //var selectBox = $('#veryImportantSelectBox')[0];
    //addOptionToSelectBox(selectBox, "ID1", "Option 1", true);
    
    /**
     * array('element_2' => currencyToOb,   'value_1' => currencyFromVal),
     * array('element_1' => currencyFromOb, 'value_2' => currencyToVal)
     *
     * @param {type} dropDownListSelector
     * @param {type} valueToFind
     * @returns {undefined}
     */
    
    function findOptionValue (dropDownListsObArr) 
    {
        var selectFrom    = dropDownListsObArr[0][0];
        var selectFromVal = dropDownListsObArr[0].val();
        var selectFromTxt = dropDownListsObArr[0].find('[value="'+selectFromVal+'"]').text();

        var selectTo      = dropDownListsObArr[1][0];
        var selectToVal   = dropDownListsObArr[1].val();
        var selectToTxt   = dropDownListsObArr[1].find('[value="'+selectToVal+'"]').text();

        $(selectTo).find('[value="'+selectFromVal+'"]').remove();
        addOptionToSelectBox(selectTo, selectFromVal, selectFromTxt, true);
        var dropDownListName = $(selectTo).attr('name');
        sortSelectOptions("[name='"+dropDownListName+"']", false);

        $(selectFrom).find('[value="'+selectToVal+'"]').remove();
        addOptionToSelectBox(selectFrom, selectToVal, selectToTxt, true);
        var dropDownListName = $(selectFrom).attr('name');
        sortSelectOptions("[name='"+dropDownListName+"']", false);
    }
    
   
  
  
  
    $('#form_exchange').click(function(){

        var dropDownLists = 
                [
                    currencyFromOb,
                    currencyToOb
                ];      

        findOptionValue(dropDownLists.reverse());
    });
  
    $(currencyFromOb)
        .change(function() {
            currencyFromVal = $(this).find(":selected").val();
            removeSelectedCode(currencyFromVal);
            sortSelectOptions("[name='form[currencyTo]']", false);
        })
    .trigger( "change" );
  
  
  
});