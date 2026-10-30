//-- Sumber dari Stack Developer:
$(document).ready(function(){
    $(document).on("click", ".updateStatusUser", function(){
        var $el = $(this);
        var user_id = $el.attr("user_id");
        $.ajax({
            type: "POST",
            url: "/admin/user/update-status-user",
            data: {user_id: user_id},
            success: function(resp){
                if(resp['status'] == 'Active'){
                    $el.text('Active');
                }else if(resp['status'] == 'Inactive'){
                    $el.text('Inactive');
                }
            },
            error: function(){
                alert("Error updateStatusUser");
            }
        });
    });

    //--Delete Record:
    $(".confirmDelete").click(function(){
        var record = $(this).attr("record");
        var record_id = $(this).attr("record_id");
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete it!'
        }).then((result) => {
            console.log(result);
            if(result.value){
                window.location.href = "/admin/"+record+"/hapus/"+record_id;
            }
        });
    });

    //--Updating Confirmation:
    $(".confirmUpdate").click(function(){
        var controller = $(this).attr("controller");
        var record_id = $(this).attr("record_id");
        Swal.fire({
            title: "Confirmation",
            text: "You are about to update this data. Proceed?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, Update it!'
        }).then((result) => {
            console.log(result);
            if(result.value){
                window.location.href = controller+"/update/"+record_id;
            }
        });
    });

});
