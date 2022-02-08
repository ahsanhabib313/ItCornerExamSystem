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

    //hide the error and sucess message at the begining
    $('#editQuestionModal').find('.success_msg').css('display', 'none');
    $('#editQuestionModal').find('.error_msg').css('display', 'none');
    var formData = new FormData();
    formData.append('id', value);
    var formUrl = $('#questionForm').attr('action');

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
            $('#question_type_id').val(data.question.question_type_id);

            //set the quetion id
            $('#question_id').val(data.question.id);

            // set the category option in category select box
            var option = '';
            for (var i = 0; i < data.categories.length; i++) {
                option += '<option value="' + data.categories[i].id + '" class="category_option' + value + '">' + data.categories[i].name + '</option>'
            }

            $('#updateForm').find('#category_id').html('');
            $('#updateForm').find('#category_id').append(option);

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
            $('#editQuestionModal').find('#question').val(data.question.question);

            /****set the value in question mark field****/
            $('#editQuestionModal').find('#question_mark').val(data.question.question_mark);

            /****whether the question type id is 2 */
            if (data.question.question_type_id == 2) {
                $('#editQuestionModal').find('#options_input').html('');
                $('#editQuestionModal').find('#option_answer').html('');
                var html = '';
                html += '<div class="mb-3">' +
                    '<label for="code_answer" class="form-label">Programming Quesiton Answer</label>' +
                    '<input type="text" id="programming_answer" class="form-control text-black" value="' + data.code_answer + '">' +
                    '</div>';

                $('#editQuestionModal').find('#code_answer').html('');
                $('#editQuestionModal').find('#code_answer').append(html);
            } else {

                /** initially hide the code answers input field */
                $('#editQuestionModal').find('#code_answer').html('');
                /** add the option input on edit field */
                var option = '';
                for (var i = 0; i < data.options.length; i++) {
                    option += '<div class="form-group">';
                    option += '<label>Option ' + (i + 1) + '</label>';
                    option += '<input type="text" onkeyup="changeOptionText(' + data.options[i].id + ')" data-id="' + data.options[i].id + '" id="option_' + data.options[i].id + '" class="form-control option_input" value="' + data.options[i].option + '">'
                    option += '</div>';

                }
                $('#editQuestionModal').find('#options_input').html('');
                $('#editQuestionModal').find('#options_input').html(option);

                /** add the option select box on edit form */
                var option_answer = '';
                option_answer += ' <div class="form-group">';
                option_answer += '<label for="option_answer">Select Option Answer</label>';
                option_answer += '<select class="form-control text-black" id="option_answer_id">';
                for (var j = 0; j < data.options.length; j++) {
                    option_answer += '<option class="option_answer option_' + data.options[j].id + '" value="' + data.options[j].id + '">' + data.options[j].option + '</option>'
                }
                option_answer += '</select></div>';

                $('#editQuestionModal').find('#option_answer').html('');
                $('#editQuestionModal').find('#option_answer').html(option_answer);

                /*select the correct answer in select box*/
                //initially unselect the categories option
                $('#option_answer .option_answer').each(function () {
                    $(this).attr('selected', false);

                })
                //select the correct option
                $('#option_answer .option_answer').each(function () {
                    if ($(this).val() == data.option_answer_id) {
                        $(this).attr('selected', true);
                    }
                });

            }
        },
        error: function (data) {
            console.log(data);

        }
    });
}

/* //update options */
function changeOptionText(id) {
    var option_text = $('#option_' + id).val();
    $('#option_answer').find('.option_' + id).text(option_text);
}

//update the question
function updateQuestion() {

    var question_type_id = $('#updateForm').find('#question_type_id').val();
    var question_id = $('#updateForm').find('#question_id').val();
    var question = $('#updateForm').find('#question').val();
    var category_id = $('#updateForm').find('#category_id').val();
    var question_mark = $('#updateForm').find('#question_mark').val();
    if (question_type_id == 1) {
        var option_id = [];
        $('#options_input .option_input').each(function () {
            option_id.push($(this).attr('data-id'));
        });

        //convert array object into string
        option_id = JSON.stringify(option_id);

        var option_text = [];
        $('#options_input .option_input').each(function () {
            option_text.push($(this).val());
        });

        //convert array object into string
        option_text = JSON.stringify(option_text);

        var option_answer_id = $('#updateForm').find('#option_answer_id').val();

    } else {
        var code_answer = $('#updateForm').find('#programming_answer').val();
    }

    //convert form data
    var formData = new FormData();
    formData.append('question_type_id', question_type_id);
    formData.append('question_id', question_id);
    formData.append('question', question);
    formData.append('category_id', category_id);
    formData.append('question_mark', question_mark);
    if (question_type_id == 1) {
        formData.append('option_id', option_id);
        formData.append('option_text', option_text);
        formData.append('option_answer_id', option_answer_id);
    } else {
        formData.append('code_answer', code_answer);
    }
    //get the url
    var questionUpdateRoute = $('#updateForm').attr('action');
    var questionUpdateMethod = $('#updateForm').attr('method');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //ajax call
    $.ajax({
        url: questionUpdateRoute,
        type: questionUpdateMethod,
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        cache: false,
        success: function (data) {
            if (true) {
                $('#editQuestionModal').find('.success_msg').html('Question has been updated successfully..!');
                $('#editQuestionModal').find('.success_msg').css('display', 'block');

                var category_text = $('#updateForm').find('#category_id option:selected').text();
                var option_answer_text = $('#updateForm').find('#option_answer_id option:selected').text();
                var code_answer_text = $('#updateForm').find('#programming_answer').val();

                $('#question_section_' + question_id).find('.question').text(question);
                $('#question_section_' + question_id).find('.category').text(category_text);
                if (question_type_id == 1) {

                    var option_id = [];
                    $('#options_input .option_input').each(function () {
                        option_id.push($(this).attr('data-id'));
                    });

                    var option_text = [];
                    $('#options_input .option_input').each(function () {
                        option_text.push($(this).val());
                    });

                    for (var i = 0; i < option_id.length; i++) {
                        $('#question_section_' + question_id).find('.option_' + parseInt(option_id[i])).text(option_text[i]);
                    }
                    $('#question_section_' + question_id).find('.correct_answer').text(option_answer_text);

                } else {
                    $('#question_section_' + question_id).find('.correct_answer').text(code_answer_text);
                }


                setTimeout(function () {
                    $('.modal').modal('hide');
                }, 2000);



            }


        },
        error: function (xhr, status, error) {

            $('#editQuestionModal').find('.error_msg').html(xhr.responseJSON.message);
            $('#editQuestionModal').find('.error_msg').css('display', 'block');

        }
    });
}



/*........delete the Question.......*/

function deleteQuestion(question_id, question_type_id) {

    $('#deleteQuestionModal').find('.error_msg').css('display', 'none');
    $('#deleteQuestionModal').find('.success_msg').css('display', 'none');
    //assign the value in the question_id input
    $('#deleteQuestionModal').find('#question_id').val(question_id);
    $('#deleteQuestionModal').find('#question_type_id').val(question_type_id);

}

// devare confirmation
$('#confirmBtn').click(function () {

    var question_id = $('#deleteQuestionModal').find('#question_id').val()
    var question_type_id = $('#deleteQuestionModal').find('#question_type_id').val();

    var formData = new FormData();
    formData.append('question_id', question_id);
    formData.append('question_type_id', question_type_id);

    var deleteQuestionRoute = $('#deleteQuestionForm').attr('action');
    var deleteQuestionMethod = $('#deleteQuestionForm').attr('method');


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: deleteQuestionRoute,
        type: deleteQuestionMethod,
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        cache: false,
        success: function (response) {

            if (true) {
                $('#deleteQuestionModal').find('.success_msg').html('Question has been deleted successfully...!');
                $('#deleteQuestionModal').find('.success_msg').css('display', 'block');

                //set a timeout for modal hide and reset the text
                setTimeout(function () {
                    //hide the devare modal
                    $('#deleteQuestionModal').modal('hide');
                    //devare the devared questions and answer from the view
                    $('#question_section_' + question_id).remove();

                }, 2000);


            }


        },
        error: function (xhr, status, error) {
            $('#editQuestionModal').find('.error_msg').html(xhr.responseJSON.message);
            $('#editQuestionModal').find('.error_msg').css('display', 'block');
        }
    })

});


