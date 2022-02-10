


//edit the settings
function editSetting(id) {

    //get the value

    var question_limit = $('#settingTable').find('input[name = question_limit_' + id + ']').val();
    var pass_mark = $('#settingTable').find('input[name = pass_mark_' + id + ']').val();
    var category_id = $('#settingTable').find('input[name = category_id_' + id + ']').val();
    var mcq_ques_time = $('#settingTable').find('input[name = mcq_ques_time_' + id + ']').val();
    var code_ques_time = $('#settingTable').find('input[name = code_ques_time_' + id + ']').val();

    //assign the value 
    $('#editSettingModal #updateForm').find('#setting_id').val(id);
    $('#editSettingModal #updateForm').find('#question_limit').val(question_limit);
    $('#editSettingModal #updateForm').find('#pass_mark').val(pass_mark);
    $('#editSettingModal #updateForm').find('#mcq_ques_time').val(mcq_ques_time);
    $('#editSettingModal #updateForm').find('#code_ques_time').val(code_ques_time);


    //initially unselect all categories
    $('#category_id .category_option').each(function () {

        $(this).attr('selected', false)

    })

    //seletected the targeted category option
    $('#category_id .category_option').each(function () {
        if ($(this).val() == category_id) {
            $(this).attr('selected', true)
        }
    })

    //update the settings
    $('#updateSettingBtn').click(function (e) {

        e.preventDefault();
        var formUrl = $('#updateForm').attr('action')
        var formMethod = $('#updateForm').attr('method')
        var setting_id = $('#editSettingModal #updateForm').find('#setting_id').val();
        var question_limit = $('#editSettingModal #updateForm').find('#question_limit').val();
        var pass_mark = $('#editSettingModal #updateForm').find('#pass_mark').val();
        var category_id = $('#editSettingModal #updateForm').find('#category_id').val();
        var mcq_ques_time = $('#editSettingModal #updateForm').find('#mcq_ques_time').val();
        var code_ques_time = $('#editSettingModal #updateForm').find('#code_ques_time').val();


        //convert the data into formData
        var formData = new FormData();
        formData.append('id', setting_id);
        formData.append('question_limit', question_limit);
        formData.append('pass_mark', pass_mark);
        formData.append('category_id', category_id);
        formData.append('mcq_ques_time', mcq_ques_time);
        formData.append('code_ques_time', code_ques_time);


        //csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        //call to ajax
        $.ajax({
            url: formUrl,
            type: formMethod,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data = true) {

                    $('#editSettingModal #updateForm').find('.success_msg').html('Setting has been updated Successfully...!');
                    $('#editSettingModal #updateForm').find('.success_msg').css('display', 'block');

                    //assign the updated form value into the blade template
                    $('.question_limit_' + setting_id).text($('#editSettingModal #updateForm').find('#question_limit').val());
                    $('.pass_mark_' + setting_id).text($('#editSettingModal #updateForm').find('#pass_mark').val());
                    $('.category_name_' + setting_id).text($('#editSettingModal #updateForm').find('#category_id option:selected').text());
                    $('.mcq_ques_time_' + setting_id).text($('#editSettingModal #updateForm').find('#mcq_ques_time').val());
                    $('.code_ques_time_' + setting_id).text($('#editSettingModal #updateForm').find('#code_ques_time').val());

                    //  console.log($('#editSettingModal #updateForm').find('#mcq_ques_time').val())
                    //console.log($('#editSettingModal #updateForm').find('#code_ques_time').val())
                    //assign the updated form value into the blade template
                    $('input[name="question_limit_' + setting_id + '"]').val($('#editSettingModal #updateForm').find('#question_limit').val());
                    $('input[name="pass_mark_' + setting_id + '"]').val($('#editSettingModal #updateForm').find('#pass_mark').val());
                    $('input[name="category_id_' + setting_id + '"]').val($('#editSettingModal #updateForm').find('#category_id option:selected').val());
                    $('input[name="mcq_ques_time_' + setting_id + '"]').val($('#editSettingModal #updateForm').find('#mcq_ques_time').val());
                    $('input[name="code_ques_time_' + setting_id + '"]').val($('#editSettingModal #updateForm').find('#code_ques_time').val());

                    setTimeout(function () {

                        $('#editSettingModal').modal('hide');
                        $('#editSettingModal #updateForm').find('.success_msg').css('display', 'none');

                    }, 2000);
                }
            },
            error: function (xhr, status, error) {
                $('#editSettingModal #updateForm').find('.error_msg').html(xhr.responseJSON.message);
                $('#editSettingModal #updateForm').find('.error_msg').css('display', 'block');
                setTimeout(function () {

                    $('#editSettingModal').modal('hide');
                    $('#editSettingModal #updateForm').find('.error_msg').css('display', 'none');

                }, 2000)

            }
        })
    });


}


//delete the settings
function deleteSetting(id) {
    $('#deleteSettingModal').find('.error_msg').css('display', 'none');
    $('#deleteSettingModal').find('.success_msg').css('display', 'none');

    //assign the value in the question_id input
    $('#deleteSettingModal').find('#setting_id').val(id);
}

//confirm delete setting
$('#confirmDelete').click(function (e) {

    e.preventDefault();
    //assign the value in the setting input
    var setting_id = $('#deleteSettingModal').find('#setting_id').val();

    var formData = new FormData();
    formData.append('id', setting_id);

    var deleteSettingUrl = $('#deleteSettingForm').attr('action');
    var deleteSettingMethod = $('#deleteSettingForm').attr('method');


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: deleteSettingUrl,
        type: deleteSettingMethod,
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        cache: false,
        success: function (data) {

            if (data = true) {
                $('#deleteSettingModal').find('.success_msg').html('Setting has been deleted successfully...!');
                $('#deleteSettingModal').find('.success_msg').css('display', 'block');

                //set a timeout for modal hide and reset the text
                setTimeout(function () {
                    //hide the devare modal
                    $('#deleteSettingModal').modal('hide');
                    //devare the devared questions and answer from the view
                    $('#setting_row_' + setting_id).remove();

                }, 2000);


            }


        },
        error: function (xhr, status, error) {
            $('#deleteSettingModal').find('.error_msg').html(xhr.responseJSON.message);
            $('#deleteSettingModal').find('.error_msg').css('display', 'block');
        }
    })


})
