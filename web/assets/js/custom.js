/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$( document ).ready(function() {
  
    var currencyFromOb  = $("[name='form[currencyFrom]']");
    var currencyToOb    = $("[name='form[currencyTo]']");
    var currencyFromVal = "";
    var elemToRestore   = "";
  
    function removeSelectedCode(elemToDelete) {

        if (elemToRestore.length > 0) {
            currencyToOb.append($("<option></option>").attr("value", elemToRestore).text(elemToRestore));
        }
        currencyToOb.find('option[value='+elemToDelete+']').remove();
        elemToRestore = elemToDelete;
    }
    
    function sortSelectOptions(selector, skip_first) {
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
  
    $(currencyFromOb)
        .change(function() {
            $( ":selected", this ).each(function() {
                currencyFromVal = $( this ).val();
            });
            removeSelectedCode(currencyFromVal);
            sortSelectOptions("[name='form[currencyTo]']", true);
        })
    .trigger( "change" );
  
  
  
});