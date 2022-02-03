// hide options for code
function questionTypeChange(value){
   if( value ==2 ){
       $('.option_section').css('display', 'none');
       $('.admin-panel-shadow').css('padding-bottom', '50px');
       $('#question').parent().after('<div class="mt-3 mb-3">' +
            '<label for="question_answer">Question Answer</label>'+
            '<input type="text" class="form-control" id="question_answer" name="question_answer">'+
           '</div>');
   }else{
       $('#question').parent().next().remove();
       $('.option_section').css('display', 'block');
       $('#question').attr('rows', 3);
   }
}


//edit the question
function editQuestion(value){

    let formData = new FormData();
    formData.append('id', value);
    let formUrl = $('#questionForm').attr('action');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //ajax call
    $.ajax({
        url: formUrl,
        type:'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        cache: false,
        success: function(data){
            console.log(data);
              $('#editQuestionModal').find('textarea').val(data.question.question);
              // set the category option in category select box
              var option = '';
              for(let i=0; i<data.categories.length; i++){
                  option += '<option value="'+ data.categories[i].id +'" class="category_option">'+data.categories[i].name+'</option>'
              }
              $('#updateForm').find('#categories').html('');
              $('#updateForm').find('#categories').append(option);

              //select the correct option
            $('.category_option')

        },
        error: function(data){
            console.log(data);

        }
    });
}

//update the question
$('#updateQuestion').click(function(){

    let question_id = $('#updateForm').find('#question_id').val();
    let question = $('#updateForm').find('#question').val();
    let option_text = [];
    let option_id = [];

    //add option text in a array
    $('.option').each(function(){
       option_text.push(this.value)
    });
    //add option id in a array
    $('.option').each(function(){
       option_id.push(this.getAttribute('data-id'))
    });

    //convert form data
    let formData = new FormData();
    formData.append('question_id', question_id);
    formData.append('question', question);
    formData.append('option_text[]', option_text);
    formData.append('option_id[]', option_id);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let formUrl = $('#updateForm').attr('action');

    //ajax call
    $.ajax({
        url: formUrl,
        type:'post',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        cache: false,
        success: function(data){


        },
        error: function(data){
            console.log(data);

        }
    });


})

 /*........Delete the Question.......*/

    function deleteQuestion(question_id){

        //assign the value in the question_id input
        $('input[name="question_id"]').val(question_id)

    }

    // delete confirmation
    $('#delete').click(function (){

        var id =   $('input[name="question_id"]').val()

        $.ajax({
            url: deleteQuestionUrl+'/'+id,
            type:'get',
            success: function (response){

                //hide the confirm text
                $('.confirm').css('display', 'none');

                //show the success method
                $('.msg').css('display','block');
                $('.msg').text(response.message);

                //set a timeout for modal hide and reset the text
                setTimeout(function (){
                    //hide the delete modal
                    $('#deleteQuestionModal').modal('hide');
                    $('.confirm').css('display', 'block');
                    $('.msg').css('display','none');

                    //delete the deleted questions and answer from the view
                    $('#question_section_'+id).remove();

                }, 2000);




            },
            error: function (error){

            }
        })

    });


