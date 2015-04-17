/**
 * Created by matt on 3/1/15.
 */
$(document).ready(function(){
    var $confirmModal = $('#confirmModal');
    var $saveButton = $('#saveButton');

    $('.btn-primary').click(function(){
        if($(this).is('.btn-success')){
            $(this).removeClass('btn-success');
        }
        else{
            $(this).addClass('btn-success');
        }
    });

    $confirmModal.on('show.bs.modal', function(){
        var selection = getSelection();
        var checkinChildren = selection[0];
        var checkoutChildren = selection[1];

        var $checkinTable = $('#checkin-table').find('tbody');
        var rowHtml = '';
        for (var i=0; i<checkinChildren.length; i++){
            var id = checkinChildren[i][0];
            var name = checkinChildren[i][1];
            rowHtml += '<tr><td>'+name+'</td><input type="hidden" name="checkinChildId[]" value="'+id+'">';
            rowHtml += '<td><input type="text" name="checkinActor[]"></td></tr>';
        }
        $checkinTable.html(rowHtml);

        var $checkoutTable = $('#checkout-table').find('tbody');
        rowHtml = '';
        for (i=0; i<checkoutChildren.length; i++){
            id = checkoutChildren[i][0];
            name = checkoutChildren[i][1];
            rowHtml += '<tr><td>'+name+'</td><input type="hidden" name="checkoutChildId[]" value="'+id+'">';
            rowHtml += '<td><input type="text" name="checkoutActor[]"></td></tr>';
        }
        $checkoutTable.html(rowHtml);

        $('#modal-ci-number').html('You are about to check-in '+checkinChildren.length+' children:');
        $('#modal-co-number').html('You are about to check-out '+checkoutChildren.length+' children:');
    });

    $confirmModal.on('hidden.bs.modal', function(){
        $saveButton.removeClass('btn-success');
    });
});

function getSelection(){
    var checkinChildren = [];
    var checkoutChildren = [];
    $('.btn-ci.active').each(function(){
        checkinChildren.push(this.value.split(","));
    });
    $('.btn-co.active').each(function(){
        checkoutChildren.push(this.value.split(","));
    });

    return [checkinChildren,checkoutChildren];
}