

  //edit the settings
  function editSetting(item_id, category_id){
    var id = item_id;
   var c = category_id;
    //get the value
    
    var q_limit = $('input[name = question_limit_'+id+']').val();
    var p_mark = $('input[name = pass_mark_'+id+']').val();
    var catagory = $('input[name = category_name_'+id+']').val();
    var mcq_q_time = $('input[name = mcq_ques_time_'+id+']').val();
    var code_q_time = $('input[name = code_ques_time_'+id+']').val();

  

    //assign the value 

   
    $('#editSettingModal').find('#id').val(id);
    $('#editSettingModal').find('#question_limit').val(q_limit);
    $('#editSettingModal').find('#pass_mark').val(p_mark);
    $('#editSettingModal').find("#category_id" ).val($("#category_id option").eq(category_id).val());
 
    $('#editSettingModal').find('#mcq_ques_time').val(mcq_q_time);
    $('#editSettingModal').find('#code_ques_time').val(code_q_time);

    //update the settings
    $('#update').click(function(e){
           
            e.preventDefault();
            var formUrl = $('#editForm').attr('action')
            var id      = $('#editSettingModal').find('#id').val();
            var question_limit = $('#editSettingModal').find('#question_limit').val();
            var pass_mark      = $('#editSettingModal').find('#pass_mark').val();
            var category_id    = $('#editSettingModal').find('#category_id').val();
            var mcq_ques_time  = $('#editSettingModal').find('#mcq_ques_time').val();
            var code_ques_time = $('#editSettingModal').find('#code_ques_time').val();
            
        

            //convert the data into formData
            var formData = new FormData();
            formData.append('id', id);
            formData.append('question_limit', question_limit);
            formData.append('pass_mark_percentage', pass_mark);
            formData.append('category_id', category_id);
            formData.append('mcq_ques_time', mcq_ques_time);
            formData.append('code_ques_time', code_ques_time);
            

            //csrf token
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            //call to ajax
            $.ajax({
                url: formUrl,
                type:'post',
                data: formData,
                processData: false,
                contentType: false,
                cache:false,
                dataType: 'json',
                success: function(data){
                    if(data.success){
                            //after updateing hide the modal
                            $('#editSettingModal').modal('hide');

                            //getting data from modal
                            var id      = $('#editSettingModal').find('#id').val();
                            var question_limit = $('#editSettingModal').find('#question_limit').val();
                            var pass_mark      = $('#editSettingModal').find('#pass_mark').val();
                            var category    = $('#editSettingModal').find('#category_id').text();
                           
                            var mcq_ques_time  = $('#editSettingModal').find('#mcq_ques_time').val();
                            var code_ques_time = $('#editSettingModal').find('#code_ques_time').val();
                          
                            //settings data to table
                            $('.question_limit_'+id).text(question_limit);
                            $('.pass_mark_'+id).text(pass_mark);
                            $('.category_name_'+id).text();
                            $('.category_name_'+id).text(category);
                             
                            $('.mcq_ques_time_'+id).text(mcq_ques_time+'s');
                            $('.code_ques_time_'+id).text(code_ques_time+'s');
                            

                            //highlight the success method
                            $('.success_msg').text(data.success);
                            $('.success_msg').css('display','block');

                            setTimeout(function(){
                                $('.success_msg').css('display','none');
                            }, 5000);
                    }else{
                        
                         //highlight the success method
                         $('.error_msg').text(data.error);
                         $('.error_msg').css('display','block');

                         setTimeout(function(){
                             $('.error_msg').css('display','none');
                         }, 3000);
                    }
                },
                error: function(data){
                    console.log(data)
                }
            })
    });


}

  