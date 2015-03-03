/**
 * Created by matt on 3/1/15.
 */
$(document).ready(function(){
    $('.btn-primary').click(function(){
        if($(this).is('.btn-success')){
            $(this).removeClass('btn-success');
        }
        else{
            $(this).addClass('btn-success');
        }
    });

    $('#myModal').on('show.bs.modal', function(){
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