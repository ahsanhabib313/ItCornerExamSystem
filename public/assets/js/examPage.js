/* warning alert for trying to opening new Tab */

$(window).on('load', function () {

    var originalHeight = window.innerHeight;
    var originalWidth = window.innerWidth;
     var  count = 0;
    $(window).on('mousemove', function (e) {

        let currentWidth = event.clientX;
        let currentHeight = event.clientY;

        var user_id = $('.user_id').val();
        if(window.location.pathname == '/user/exam/'+user_id){
            //check wheater mouse is out or inside in document
            if (currentWidth >= originalWidth || currentWidth <= 0 || currentHeight >= originalHeight || currentHeight <= 0) {
                //increase the count by one
                count += 1;

                //show a sweet alert
                Swal.fire({
                    html: '<h3 style="color:#ffc107"><strong>You are out of window</strong></h3>' +
                        '<h6 style="color:red">If you try more than 10 times your exam will be suspened</h6>',
                    icon: 'warning',

                });

                //call the beep sound function
                playSound();

                //check wheater user tried to get out of window more than 20
                if (count > 10) {
                    var user_id = $('.user_id').val();
                    $.get(userSuspendUrl+'/'+user_id, function (data){
                        $('#main_content').html(data);
                    })

                }
            }
        }

    })
})

$(window).on('load', function () {

    // show the alert dialog at the begining of the page load
    Swal.fire({
        html: '<h3 style="color:#ffc107"><strong>You have to follow below rules:</strong></h3>' +
            '<h6 style="color:red">You can not open any new Tab</h6>' +
            '<h6 style="color:red">You can not search in Google</h6>' +
            '<h6 style="color:red">You can not close the exam Windows</h6>',
        icon: 'warning',
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
    }).then(function () {
        var myTimeInterval;
        myTimeInterval = setInterval(myTimer, 1000);
    })
});


//play the warning sound
function playSound() {
    const audio = new Audio("../../assets/audio/beep.mp3");
    audio.play();
}

//get the question time
var mcq_ques_time = $('#mcq_ques_time').val()
var code_ques_time = $('#code_ques_time').val()

if($('#question_type_id').val() == 1){
    var time = mcq_ques_time;
}else{
    var time = code_ques_time;
}

//call the timer function
function myTimer() {
    $('.timer_value').text(time);
    time--;
    if (time == -1) {

        getNextQuestion();
    }
    if (time >= 10) {
        $('.timer_value').removeClass('light_red');
        $('.timer_value').removeClass('dark_red');
    }
    if (time < 10) {
        $('.timer_value').addClass('light_red');
    }
    if (time <= 5) {
        $('.timer_value').removeClass('light_red');
        $('.timer_value').addClass('dark_red');
    }
}

//if check radio button then validation message hide
function isChecked() {
    document.querySelector('.ans_err').style.display = "none";
}

$('#nextQuestionBtn').on('click', function (e){
    e.preventDefault();

    var question_type_id = $('#question_type_id').val();
   if(question_type_id == 1){
       var examinee_answer = document.querySelector('input[name="examinee_answer"]:checked');
       if (examinee_answer == null) {
           document.querySelector('.ans_err').style.display = "block";
           document.querySelector('.ans_err').style.color = "red";
           document.querySelector('.ans_err').innerHTML = 'If you are unable to answer the question. Please Click Skip Button...!';
       } else {
           //call the function for next question
           getNextQuestion();
       }
   }else{
       getNextQuestion();
   }


})
//skip button function
$('#skipQuestionBtn').on('click', function (e){
    e.preventDefault();
    //call the function for next question
    getNextQuestion();
})
//change the question manually by examinee
function getNextQuestion() {
    //set the time 20 again
    time = 20;

    var user_id = $('#user_id').val();
    var question_id = $('#question_id').val();
    var question_type_id = $('#question_type_id').val();
    if(question_type_id == 1){
        var examinee_answer = $('input[name="examinee_answer"]:checked').val();

    }else{
        var examinee_answer = $('#result').text();
    }

    //convert form data
    var formData = new FormData();
    formData.append('user_id', user_id);
    formData.append('question_id', question_id);
    formData.append('question_type_id', question_type_id);
    formData.append('examinee_answer', examinee_answer);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    formUrl = $('#questionAnswerForm').attr('action');

    $.ajax({
        url: formUrl,
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        dataType: 'json',
        success: function (data) {

            if(data.suspend == 1){
                $.get(userSuspendUrl+'/'+user_id, function (data){
                    $('#main_content').html(data);
                })
            }else{
                $.get(getNextQuestionUrl+'/'+data.user_id, function (data){
                    $('#main_content').html(data);
                });
            }
        },
        error: function (data) { }
    });
};


//skip personal info
function skipPersonalInfo(id) {

    $.get(getExamineeResultUrl+'/'+id,function (data){
        $('#main_content').html(data);
    })
}

// store the personal info after exam
$('#personaInfo').submit(function (event){
    event.preventDefault();

    let user_id = $('input[name="user_id"]').val();
    let fresher = $('select[name="fresher"]').val();
    let experience = $('select[name="experience"]').val();
    let salary = $('input[name="salary"]').val();
    let city = $('input[name="city"]').val();
    let address = $('textarea[name="address"]').val();
    let institute = $('input[name="institute"]').val();
    let cgpa = $('input[name="cgpa"]').val();

    //convert into formData
    let formData = new FormData();
    formData.append('user_id', user_id);
    formData.append('fresher', fresher);
    formData.append('experience', experience);
    formData.append('salary', salary);
    formData.append('city', city);
    formData.append('address', address);
    formData.append('institute', institute);
    formData.append('cgpa', cgpa);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let form = $('#personaInfo');
    let route = form.attr('action');
    let method = form.attr('method');
    //call to ajax
    $.ajax({
        url: route,
        type: method,
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success:function (data){
            $('#main_content').html(data);
        },
        error: function (xhr, status, error) {
            $('#errors').html(' ');
            $('#errors').append("<p class='alert alert-danger'>" +xhr.responseJSON.message+ "</p>");
            $.each(xhr.responseJSON.errors, function (key, item) {
                $("#errors").append("<p class='alert alert-danger'>" + item + "</p>")
            });

        }
    })
});


//get the examinee Result
 /*function getExamineeResult() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //get the user id
    let user_id = $('.user_id').val();
    var formData = new FormData();
    formData.append('user_id', user_id);

    $.ajax({
        url: getExamineeResultRoute,
        type: 'post',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (response) {
          $('#')
            /*var badge;
            if (response.status == 'fail') {
                badge = 'danger';
            } else {
                badge = 'success';
            }

            var html = '';
            html += '<div class="card">'
            html += '<div class="card-body">'
            html += '<h3 class=" p-5 card-title text-center text-info" style="text-decoration:underline">Your Online Exam Result</h3>'
            html += '<table class="table table-bordered" style="text-align:center">'
            html += '<tbody>'
            html += '<tr><td><span class="table-text">Total Question: </span></td><td><label class="badge badge-info">' + response.question_limit + '</label></td></tr>'
            html += '<tr><td><span class="table-text">Correct Answer: </span></td><td><label class="badge badge-info">' + response.correct_answer_no + '</label></td></tr>'
            html += '<tr><td><span class="table-text">Pass Mark: </span></td><td><label class="badge badge-info">' + response.pass_mark + '</label></td> </tr>'
            html += '<tr><td><span class="table-text">Status: </span></td><td><label class="badge badge-' + badge + '">' + response.status.toUpperCase() + '</label></td></tr>'
            html += '<tr><td><span class="table-text">Category: </span></td><td><label class="badge badge-info">' + response.category + '</label></td></tr>'
            html += '</tbody>'
            html += '</table>'
            html += '</div></div>'


            $('.title').html('');
            $('#content_section').html('');
            $('#content_section').append(html);
        },
        error: function (data) {

            console.log(data);

        }
    })

}
*/
