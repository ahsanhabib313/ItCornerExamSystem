// hide options for code
function questionTypeChange(value) {
    if (value == 2) {
        $('.option_section').css('display', 'none');
        $('.admin-panel-shadow').css('padding-bottom', '50px');
        $('#question').parent().after('<div class="mt-3 mb-3">' +
            '<label for="question_answer">Question Answer</label>' +
            '<input type="text" class="form-control" id="question_answer" name="question_answer">' +
            '</div>');
    } else {
        $('#question').parent().next().remove();
        $('.option_section').css('display', 'block');
        $('#question').attr('rows', 3);
    }
}


//edit the question
function editQuestion(value) {

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
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        cache: false,
        success: function (data) {

            //set the question type
            $('.question_type').text(data.question.question_type.name.toUpperCase());

            //set the question type
            $('input[name="question_type_id"]').val(data.question.question_type_id);

            //set the quetion id
            $('input[name="question_id"]').val(data.question.id);

            // set the category option in category select box
            let option = '';
            for (let i = 0; i < data.categories.length; i++) {
                option += '<option value="' + data.categories[i].id + '" class="category_option' + value + '">' + data.categories[i].name + '</option>'
            }

            $('#updateForm').find('#categories').html('');
            $('#updateForm').find('#categories').append(option);

            //unselect the categories option
            $('.category_option' + value).each(function () {
                $(this).attr('selected', false);

            })
            //select the correct option
            $('.category_option' + value).each(function () {
                if ($(this).val() == data.question.category_id) {
                    $(this).attr('selected', true);
                }
            })

            /****set the value in question field****/
            $('#editQuestionModal').find('textarea[name="question"]').val(data.question.question);

            /****set the value in question mark field****/
            $('#editQuestionModal').find('input[name="question_mark"]').val(data.question.question_mark);

            /****whether the question type id is 2 */
            if (data.question.question_type_id == 2) {
                let html = '';
                html += '<div class="mb-3">' +
                    '<label for="code_answer" class="form-label">Programming Quesiton Answer</label>' +
                    '<input type="text" name="code_answer" id="code_answer" class="form-control text-black" value="' + data.code_answer + '">' +
                    '</div>';

                $('#editQuestionModal').find('#code_answer').html('');
                $('#editQuestionModal').find('#code_answer').append(html);
            } else {
                $('#editQuestionModal').find('#code_answer').html('');
            }



        },
        error: function (data) {
            console.log(data);

        }
    });
}

//update the question
$('#update-question-btn').click(function () {

    let question_type_id = $('#updateForm').find('input[name="question_id"]').val();
    let question_id = $('#updateForm').find('input[name="question_id"]').val();
    let category_id = $('#updateForm').find('select[name="category_id"]').val();
    let question = $('#updateForm').find('input[name="question"]').val();
    let question_mark = $('#updateForm').find('input[name="question_mark"]').val();
    let question_mark = $('#updateForm').find('input[name="question_mark"]').val();

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
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        cache: false,
        success: function (data) {


        },
        error: function (data) {
            console.log(data);

        }
    });


})

/*........Delete the Question.......*/

function deleteQuestion(question_id) {

    //assign the value in the question_id input
    $('input[name="question_id"]').val(question_id)

}

// delete confirmation
$('#delete').click(function () {

    var id = $('input[name="question_id"]').val()

    $.ajax({
        url: deleteQuestionUrl + '/' + id,
        type: 'get',
        success: function (response) {

            //hide the confirm text
            $('.confirm').css('display', 'none');

            //show the success method
            $('.msg').css('display', 'block');
            $('.msg').text(response.message);

            //set a timeout for modal hide and reset the text
            setTimeout(function () {
                //hide the delete modal
                $('#deleteQuestionModal').modal('hide');
                $('.confirm').css('display', 'block');
                $('.msg').css('display', 'none');

                //delete the deleted questions and answer from the view
                $('#question_section_' + id).remove();

            }, 2000);




        },
        error: function (error) {

        }
    })

});


