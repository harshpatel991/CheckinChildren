/**
 * Created by matt on 3/1/15.
 */
$(document).ready(function(){
    //$('.panel-heading').css('min-height', 40);

    $('.btn-primary').click(function(){
        if($(this).is('.btn-success')){
            $(this).removeClass('btn-success');
        }
        else{
            $(this).addClass('btn-success');
        }
    });

    $('#confirmModal').on('show.bs.modal', function(){
        $('#ci-list').find('li').addClass('hidden');
        $('#co-list').find('li').addClass('hidden');

        var selection = getSelection();
        var checkinIds = selection[0];
        var checkoutIds = selection[1];

        $('#modal-ci-number').html('You are about to check-in '+checkinIds.length+' children:');
        $('#modal-co-number').html('You are about to check-out '+checkoutIds.length+' children:');

        checkinIds.map(function(id) {
            $('#modal-ci-' + id).removeClass('hidden');
        });
        checkoutIds.map(function(id) {
            $('#modal-co-' + id).removeClass('hidden');
        });
    });
});


function checkinSubmit(){
    var inputs = getInputs();
    var selectedCheckinIds = inputs[0];
    var selectedCheckoutIds = inputs[1];

    var para = document.getElementById('checkinInputs');
    for (var i=0; i<selectedCheckinIds.length; i++){
        addHiddenInput(para, 'checkinIds[]', selectedCheckinIds[i]);
    }
    for (var i=0; i<selectedCheckoutIds.length; i++){
        addHiddenInput(para, 'checkoutIds[]', selectedCheckoutIds[i]);
    }

    return true;
}

function addHiddenInput(para, name, value){
    var hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = name;
    hiddenInput.value = value;
    para.appendChild(hiddenInput);
    var br = document.createElement('br');
    para.appendChild(br);
}

function getSelection(){
    var checkinIds = [];
    var checkoutIds = [];
    $('.btn-ci.active').each(function(){
        checkinIds.push(this.value);
    });
    $('.btn-co.active').each(function(){
        checkoutIds.push(this.value);
    });

    return [checkinIds,checkoutIds];
}

function getInputs(){
    var checkinIds = [];
    var checkoutIds = [];
    $('.ci-input').not('.hidden').each(function(){
        checkinIds.push(this.value);
    });
    $('.co-input').not('.hidden').each(function(){
        checkoutIds.push(this.value);
    });

    return [checkinIds,checkoutIds];
}