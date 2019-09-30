
function checkWhoIsChecked(id, forAdmin = true){
    $(document).ready(function() {
        var recordCheckedLen = $("input.admin-checked:checkbox:checked").length,
            allRecords = $("input.admin-checked:checkbox").length, toAdd = 0;
        forAdmin ? toAdd = 1 : toAdd = 0; 
        if (recordCheckedLen + toAdd == allRecords) {
            $("#all-admins").prop('checked', true);
        } else {
            $("#all-admins").prop('checked', false);
        }
        $("#selected-"+id).is(':checked') ? $("#del-record-btn-"+id).addClass('disable') : $("#del-record-btn-"+id).removeClass('disable')
    });
}

function checkAll(userId){
    $(function() {
        if($("#all-admins").is(':checked')){
            $('input.admin-checked[type=checkbox]').each(function() {
                $(this).attr('id') != "selected-"+userId ? $(this).prop('checked', true) : '';
            });
            $("a.del-record-btn").each(function() {
                $(this).attr('id') != "del-record-btn-"+userId ? $(this).addClass("disabled") : '';
            });
        }else{
            $('input.admin-checked[type=checkbox]').each(function() {
                $(this).attr('id') != "selected-"+userId ? $(this).prop('checked', false) : '';
            });
            $("a.del-record-btn").each(function() {
                $(this).attr('id') != "del-record-btn-"+userId ? $(this).removeClass("disabled") : '';
            });
        }
    });
}


function warningDelAll(){
    $(function() {
        var len = $('input.admin-checked:checkbox:checked').length;
        if (len > 0) {
            $("#no-empty-record").removeClass('hidden');
            $("#del-record").removeClass('hidden');
            $("#number-checked").text(len).css('color', 'red');
        }
        else {
            $("#empty-record").removeClass('hidden');
        }
        $('#warning-del').modal('show');
    });
}

$(function() {
    $("#del-record").click(function() {
        $("#del-submit").submit();
    });
})

function warningDelOne(id, name, deletePath) {
    $(function() {
        $("#one-record").removeClass('hidden');
        $("#del-record").removeClass('hidden');
        $("#del-form").attr('action', deletePath+'/'+id);
        $("#record-name").text(name).css('color', 'red');
        $("#warning-del").modal("show");
    });
}

function makeAllMsgHidden(deletePath){
    $(function() {
        $("#one-record").addClass('hidden');
        $("#no-empty-record").addClass('hidden');
        $("#empty-record").addClass('hidden');
        $("#del-record").addClass('hidden');
        $("#del-form").attr('action', deletePath);
    });
}

function deleteConfirmed(){
    $("#del-form").submit();
}

function showDetails(){
    $(function() {
        $("#show-details").modal('show');
    });
}