$(document).ready(function(){
    // $("#add-question-btn").click(function(e){
    $('body').on('click','#add-question-btn',function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+"Mail Sending...")

        var formData = $("#add-question-form").serializeArray();

        var type = "POST";
        var ajaxurl = 'add-new-question';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("button").html('Save Question');
                if( data.hasOwnProperty('failed')){
                    $('input[name="category_id"]').addClass("is-invalid");
                    $('input[name="question_type_id"]').addClass("is-invalid");
                    $('input[name="question_mark"]').addClass("is-invalid");
                    $("textarea[name='question']").addClass("is-invalid");
                    $("input[name='question_answer']").addClass("is-invalid");
                    $("input[name='option_1']").addClass("is-invalid");
                    $("input[name='option_2']").addClass("is-invalid");
                    $("input[name='option_3']").addClass("is-invalid");
                    $("input[name='option_4']").addClass("is-invalid");

                    if($('input[name="question_mark"]').next("span").length == 0){
                        $('input[name="question_mark"]').after(
                            '<span class="text-danger">'+data.failed.question_mark[0]+'</span>'
                        );
                    }
                    if($("textarea[name=question]").next("span").length == 0){
                        $("textarea[name=question]").after(
                            '<span class="text-danger">'+data.failed.question[0]+'</span>'
                        );
                    }
                    if($("input[name='question_answer']").next("span").length == 0){
                        $("input[name='question_answer']").after(
                            '<span class="text-danger">'+data.failed.question_answer[0]+'</span>'
                        );
                    }
                    if($("input[name=option_1]").next("span").length == 0){
                        $("input[name=option_1]").after(
                            '<span class="text-danger">'+data.failed.option_1[0]+'</span>'
                        );
                    }
                    if($("input[name=option_2]").next("span").length == 0){
                        $("input[name=option_2]").after(
                            '<span class="text-danger">'+data.failed.option_2[0]+'</span>'
                        );
                    }
                    if($("input[name=option_3]").next("span").length == 0){
                        $("input[name=option_3]").after(
                            '<span class="text-danger">'+data.failed.option_3[0]+'</span>'
                        );
                    }
                    if($("input[name=option_4]").next("span").length == 0){
                        $("input[name=option_4]").after(
                            '<span class="text-danger">'+data.failed.option_4[0]+'</span>'
                        );
                    }
                }else{
                    $("input[name=question_mark]").removeClass("is-invalid");
                    $("textarea[name=question]").removeClass("is-invalid");
                    $("input[name=option_1]").removeClass("is-invalid");
                    $("input[name=question_mark]").removeClass("is-invalid");
                    $("textarea[name=question").next().remove();
                    $("input[name=option_1").next().remove();
                    $("input[name=option_2").next().remove();
                    $("input[name=option_3").next().remove();
                    $("input[name=option_4").next().remove();
                    $('.alert').fadeIn();
                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 5000);
                    // $(".alert").html(data.success);
                    $("#add-question-form").trigger('reset');
                    $.get(
                        "add-new-question",
                        function (data) {
                            $("#page-main").html(data);
                        }
                    );
                }
            }
        });
    });
});
// add answer for new question
$(document).ready(function(){
    $("body").on('click','#btn-add-ans',function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+"Request Sending...")
        // $("#page-main").load('add-new-question');
        var formData = $("#add-answer-form").serializeArray();

        var type = "POST";
        var ajaxurl = 'add-answer';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (response) {
                $.get(
                    "add-new-question",
                    function (data) {
                        $("#page-main").html(data);
                    }
                );
            },

        });
        return true;
    });
});

//setting page script
$(document).ready(function(){
    $("body").on('click','#btn_add_setting',function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+"Request Sending...")
        // $("#page-main").load('add-new-question');
        var formData = $("#add_setting_form").serializeArray();

        var type = "POST";
        var ajaxurl = $('#add_setting_form').attr('action');
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#btn_add_setting").html('Save');
                if( data.hasOwnProperty('failed')){
                    $("input[name=question_limit]").addClass("is-invalid");
                    if($("input[name=question_limit]").next("span").length == 0){
                        $("input[name=question_limit]").after(
                            '<span class="text-danger">'+data.failed.question_limit[0]+'</span>'
                        );
                    }
                    $("input[name=pass_mark]").addClass("is-invalid");
                    if($("input[name=pass_mark]").next("span").length == 0){
                        $("input[name=pass_mark]").after(
                            '<span class="text-danger">'+data.failed.pass_mark[0]+'</span>'
                        );
                    }
                    $("select[name=category_id]").addClass("is-invalid");
                    if($("select[name=category_id]").next("span").length == 0){
                        $("select[name=category_id]").after(
                            '<span class="text-danger">'+data.failed.category_id[0]+'</span>'
                        );
                    }
                    $("select[name=question_type_id]").addClass("is-invalid");
                    if($("select[name=question_type_id]").next("span").length == 0){
                        $("select[name=question_type_id]").after(
                            '<span class="text-danger">'+data.failed.question_type_id[0]+'</span>'
                        );
                    }
                }else{
                    $("input[name=question_limit]").removeClass("is-invalid");
                    $("input[name=question_limit").next().remove();
                    $("input[name=pass_mark]").removeClass("is-invalid");
                    $("input[name=pass_mark").next().remove();
                    $("input[name=category_id]").removeClass("is-invalid");
                    $("input[name=category_id").next().remove();
                    $("input[name=question_type_id]").removeClass("is-invalid");
                    $("input[name=question_type_id").next().remove();
                    $('.alert').fadeIn();
                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 5000);
                    $(".alert").html(data.success);
                    $("#add_setting_form").trigger('reset');
                }
            },
            error:function (data) {
                console.log(data);
            }
        });
        return true;
    });
});
// add category
$(document).ready(function(){
    $("body").on('click','#btn-add-category',function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+"Request Sending...")
        // $("#page-main").load('add-new-question');
        var formData = $("#add-category-form").serializeArray();

        var type = "POST";
        var ajaxurl = 'add-category';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#btn-add-category").html('Save Category');
                if( data.hasOwnProperty('failed')){
                    $("input[name=name]").addClass("is-invalid");
                    if($("input[name=name]").next("span").length == 0){
                        $("input[name=name]").after(
                            '<span class="text-danger">'+data.failed.name[0]+'</span>'
                        );
                    }
                }else{
                    $("input[name=name]").removeClass("is-invalid");
                    $("input[name=name").next().remove();
                    $('.alert').fadeIn();
                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 5000);
                    $(".alert").html(data.success);
                    $("#add-category-form").trigger('reset');
                }
            },
            error:function (data) {
                console.log(data);
            }
        });
        return true;
    });
});
