
function checkWhoIsChecked(id){
    var recordCheckedLen = $("input.admin-checked:checkbox:checked").length,
        allRecords = $("input.admin-checked:checkbox").length;
    if (recordCheckedLen == allRecords) {
        $("#all-admins").prop('checked', true);
    } else {
        $("#all-admins").prop('checked', false);
    }
    if($("a#del-record-btn-"+id).hasClass('disabled')){
        $("a#del-record-btn-"+id).removeClass('disabled');
    }else{
        $("a#del-record-btn-"+id).addClass('disabled');
    }
}

function checkAll(){
    $(function() {
        if($("#all-admins").is(':checked')){
            $('input.admin-checked[type=checkbox]').each(function() {
                $(this).prop('checked', true);
            });
            $("a.del-record-btn").each(function() {
                    $(this).addClass("disabled");
            });
        }else{
            $('input.admin-checked[type=checkbox]').each(function() {
                $(this).prop('checked', false);
            });
            $("a.del-record-btn").each(function() {
                    $(this).removeClass("disabled");
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

function warningDelOne(id, name) {
    $(function() {
        $("#one-record").removeClass('hidden');
        $("#del-record").removeClass('hidden');
        $("#del-form").attr('action', window.location.origin+'/admin/control/'+id);
        $("#record-name").text(name).css('color', 'red');
        $("#warning-del").modal("show");
    });
}

function makeAllMsgHidden(){
    $(function() {
        $("#one-record").addClass('hidden');
        $("#no-empty-record").addClass('hidden');
        $("#empty-record").addClass('hidden');
        $("#del-record").addClass('hidden');
        $("#del-form").attr('action', window.location.origin+'/admin/control/delete/selected');
    });
}

function deleteConfirmed(){
    $("#del-form").submit();
}