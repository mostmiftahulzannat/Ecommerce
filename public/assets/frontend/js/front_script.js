$(document).ready(function() {
    $(document).on('change','#district',function(){
        var districtId = $(this).val();
        $.ajax({
            url: '/upzilla/ajax',
            method: 'get',
            data:{districtId:districtId},
            success: function(res){
               $("#sub_district").html(res);
            },
            error:function(){
                alert('problem');
            }
        });

    });
});
