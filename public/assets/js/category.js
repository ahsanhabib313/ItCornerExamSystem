 //edit the category
    function editCategory(data){
        var id = data;

        //get the value
        var serial_no = $('.serial_'+id).text();
        var name = $('.name_'+id).text();

        //assign the value 
        $('#editCategoryModal').find('#id').val(id);
        $('#editCategoryModal').find('.serial').text(serial_no);
        $('#editCategoryModal').find('#name').val(name);

        //update the category
        $('#update').click(function(e){

                e.preventDefault();
                var formUrl = $('#editForm').attr('action')
                var id        = $('#editCategoryModal').find('#id').val();
                var name      = $('#editCategoryModal').find('#name').val();

                //convert the data into formData
                var formData = new FormData();
                formData.append('id', id);
                formData.append('name', name);

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
                                $('#editCategoryModal').modal('hide');
                                //get the id and category name from edit modal
                                var id        = $('#editCategoryModal').find('#id').val();
                                var name      = $('#editCategoryModal').find('#name').val();

                                // set the updated category name on the table 
                                $('.name_'+id).text(name);

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

    //delete category 
    function deleteCategory(data){
        var id = data;
        //set the id in delete modal input
        $('#deleteCategoryModal').find('#id').val(id);
        
        $('#delete').click(()=>{
                //get the delete form url
                let formUrl = $('#deleteForm').attr('action');

                //convert into form data
                var formData = new FormData();
                formData.append('id', id);

                //csrf token
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                //call to ajax url
                $.ajax({
                    url: formUrl,
                    type:'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',
                    success: function(data){

                        if(data.success){
                            //after deleting hide the modal
                            $('#deleteCategoryModal').modal('hide');

                            //get the id and category name from edit modal
                            var id = $('#deleteCategoryModal').find('#id').val();
                            //delete the row
                            $('.serial_'+id).parent().remove();

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

                    }
                })


                })
       
    }

